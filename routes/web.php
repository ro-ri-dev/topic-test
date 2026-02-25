<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Topic;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\QuestionController;


/*
|--------------------------------------------------------------------------
| RUTAS ADMIN (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    // Topics
    Route::get('/admin/topics', [TopicController::class, 'index'])
        ->name('admin.topics.index');

    Route::get('/admin/topics/create', [TopicController::class, 'create'])
        ->name('admin.topics.create');

    Route::post('/admin/topics', [TopicController::class, 'store'])
        ->name('admin.topics.store');


    // Questions
    Route::get('/admin/topics/{topic}/questions', function (Topic $topic) {
        $questions = $topic->questions()->latest()->get();
        return view('admin.questions.index', compact('topic', 'questions'));
    })->name('admin.questions.index');

    Route::get('/admin/topics/{topic}/questions/create', function (Topic $topic) {
        return view('admin.questions.create', compact('topic'));
    })->name('admin.questions.create');

    Route::post('/admin/topics/{topic}/questions', [QuestionController::class, 'store'])
        ->name('admin.questions.store');
});


/*
|--------------------------------------------------------------------------
| RUTA PÚBLICA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD USUARIO
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| PERFIL USUARIO
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| LOGIN / REGISTER / LOGOUT
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
