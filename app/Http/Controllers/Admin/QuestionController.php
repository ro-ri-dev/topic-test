<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function store(Topic $topic)
    {
        request()->validate([
            'question' => 'required|string',
            'answers' => 'required|array|min:2',
            'correct' => 'required|integer',
        ]);

        $question = Question::create([
            'topic_id' => $topic->id,
            'type' => 'mc',
            'text' => request('question'),
        ]);

        foreach (request('answers') as $index => $text) {
            Answer::create([
                'question_id' => $question->id,
                'text' => $text,
                'is_correct' => $index == request('correct'),
            ]);
        }

        return redirect()->route('admin.questions.index', $topic);
    }
    public function edit(Question $question)
    {
        $question->load('answers', 'topic');

        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $question->load('answers', 'topic');

        $data = $request->validate([
            'question' => ['required', 'string', 'max:2000'],

            'answers_existing' => ['nullable', 'array'],
            'answers_existing.*.text' => ['nullable', 'string', 'max:1000'],

            'answers_new' => ['nullable', 'array'],
            'answers_new.*.text' => ['nullable', 'string', 'max:1000'],

            'answers_delete' => ['nullable', 'array'],
            'answers_delete.*' => ['integer'],

            'correct' => ['required', 'string'], // "a:ID" o "n:INDEX"
        ]);
        $deleteIds = $request->input('answers_delete', []);

        if (!empty($deleteIds)) {
            $question->answers()
                ->whereIn('id', $deleteIds)
                ->delete();
        }

        return DB::transaction(function () use ($question, $data) {

            // 1) Update question text
            $question->update(['text' => $data['question']]);

            $deleteIds = collect($data['answers_delete'] ?? [])
                ->map(fn($v) => (int)$v)
                ->all();

            // 2) Update existing answers text (except those marked for deletion)
            $existingPayload = $data['answers_existing'] ?? [];
            foreach ($question->answers as $answer) {
                if (in_array((int)$answer->id, $deleteIds, true)) {
                    continue;
                }
                if (isset($existingPayload[$answer->id]['text'])) {
                    $text = trim((string)$existingPayload[$answer->id]['text']);
                    // si está vacío, lo trataremos como error de validación lógica más abajo
                    $answer->update(['text' => $text]);
                }
            }

            // 3) Delete marked answers
            if (!empty($deleteIds)) {
                // seguridad: solo borrar answers de esta pregunta
                $question->answers()->whereIn('id', $deleteIds)->delete();
            }

            // recargar answers tras borrado
            $question->load('answers');

            // 4) Create new answers (si vienen con texto)
            $newCreatedMap = []; // index -> answer_id
            $newPayload = $data['answers_new'] ?? [];
            foreach ($newPayload as $idx => $row) {
                $text = trim((string)($row['text'] ?? ''));
                if ($text === '') {
                    continue; // permitir filas nuevas vacías (si el usuario añadió y luego no escribió)
                }
                $new = $question->answers()->create([
                    'text' => $text,
                    'is_correct' => false,
                ]);
                $newCreatedMap[(int)$idx] = $new->id;
            }

            // 5) Validación lógica: mínimo 2 answers y ninguna vacía
            $answersNow = $question->answers()->get();
            if ($answersNow->count() < 2) {
                return back()
                    ->withErrors(['answers_min' => 'Debe haber al menos 2 respuestas.'])
                    ->withInput();
            }

            if ($answersNow->contains(fn($a) => trim((string)$a->text) === '')) {
                return back()
                    ->withErrors(['answers_min' => 'No puede haber respuestas vacías. Elimina la fila o escribe texto.'])
                    ->withInput();
            }

            // 6) Resolver "correct" a un answer_id real
            $correct = $data['correct'];
            $correctAnswerId = null;

            if (str_starts_with($correct, 'a:')) {
                $correctAnswerId = (int)substr($correct, 2);
            } elseif (str_starts_with($correct, 'n:')) {
                $idx = (int)substr($correct, 2);
                $correctAnswerId = $newCreatedMap[$idx] ?? null;
            }

            if (!$correctAnswerId) {
                return back()
                    ->withErrors(['correct' => 'La respuesta correcta no es válida.'])
                    ->withInput();
            }

            // seguridad: comprobar que el correct pertenece a esta pregunta
            $validIds = $question->answers()->pluck('id')->all();
            if (!in_array($correctAnswerId, $validIds, true)) {
                return back()
                    ->withErrors(['correct' => 'La respuesta correcta no pertenece a esta pregunta.'])
                    ->withInput();
            }

            // 7) Aplicar is_correct (solo 1 true)
            $question->answers()->update(['is_correct' => false]);
            $question->answers()->where('id', $correctAnswerId)->update(['is_correct' => true]);

            return redirect()
                ->route('admin.questions.index', $question->topic)
                ->with('success', 'Esta pregunta se ha modificado correctamente');
        });
    }

    public function destroy(Question $question)
    {
        $topic = $question->topic;

        $question->answers()->delete();
        $question->delete();

        return redirect()
            ->route('admin.questions.index', $topic)
            ->with('success', 'Esta pregunta se ha eliminado correctamente');
    }
}
