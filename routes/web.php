<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Topic;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\QuestionController;

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/topics/{topic}/questions', function (\App\Models\Topic $topic) {
        $questions = $topic->questions()->latest()->get();
        return view('admin.questions.index', compact('topic', 'questions'));
    })->name('admin.questions.index');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/topics/create', [TopicController::class, 'create'])->name('admin.topics.create');
    Route::post('/admin/topics', [TopicController::class, 'store'])->name('admin.topics.store');
    Route::get('/admin/topics/{topic}/questions', function (\App\Models\Topic $topic) {
        return view('admin.questions.index', compact('topic'));
    })->name('admin.questions.index');
    Route::get('/admin/topics/{topic}/questions/create', function (Topic $topic) {
        return view('admin.questions.create', compact('topic'));
    })->name('admin.questions.create');

    Route::post('/admin/topics/{topic}/questions', [QuestionController::class, 'store'])
        ->name('admin.questions.store');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
