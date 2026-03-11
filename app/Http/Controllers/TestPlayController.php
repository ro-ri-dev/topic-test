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
}
