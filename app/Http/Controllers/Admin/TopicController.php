<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();

        return view('admin.topics.index', compact('topics'));
    }
    public function create()
    {
        return view('admin.topics.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
        ]);

        Topic::create([
            'name' => request('name'),
        ]);

        return redirect()->route('admin.topics.index');
    }
}
