<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Question;
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
}
