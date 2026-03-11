<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TestPlayController extends Controller
{
    public function show(Topic $topic)
    {
        $topic->load('questions.answers');

        abort_if($topic->questions->isEmpty(), 404, 'Este topic no tiene preguntas.');

        return view('admin.topics.play', compact('topic'));
    }
    public function check(Request $request, Topic $topic)
    {
        $topic->load('questions.answers');

        $score = 0;
        $results = [];

        foreach ($topic->questions as $question) {

            $selected = $request->input("answers.{$question->id}");

            $correct = $question->answers->firstWhere('is_correct', 1);

            $isCorrect = $selected == $correct->id;

            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'question' => $question,
                'selected' => $selected,
                'correct' => $correct->id,
                'is_correct' => $isCorrect
            ];
        }

        return view('admin.topics.result', [
            'topic' => $topic,
            'results' => $results,
            'score' => $score
        ]);
    }
}
