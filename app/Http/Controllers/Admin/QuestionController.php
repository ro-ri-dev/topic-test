<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Answer;

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
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'answer'   => ['nullable', 'string', 'max:1000'],
        ]);

        $question->update($data);

        return redirect()
            ->route('admin.questions.index', $question->topic_id)
            ->with('success', 'Esta pregunta se ha modificado correctamente');
    }

    public function destroy(Question $question)
    {
        $topicId = $question->topic_id;
        $question->delete();

        return redirect()
            ->route('admin.questions.index', $topicId)
            ->with('success', 'Esta pregunta se ha eliminado correctamente');
    }
}
