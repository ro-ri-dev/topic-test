<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

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
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $topic->update($data);

        return redirect()
            ->route('admin.topics.index')
            ->with('success', 'Este topic se ha modificado correctamente');
    }

    public function destroy(Topic $topic)
    {
        // Eliminación directa + cascada manual
        $topic->questions()->delete();
        $topic->delete();

        return redirect()
            ->route('admin.topics.index')
            ->with('success', 'Este topic y todas sus preguntas se han eliminado correctamente');
    }
}
