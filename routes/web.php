<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function () {
    return redirect('/');
});

Route::post('/subject/notes', [SubjectController::class, 'showNotes'])->name('subject.notes');

Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create')->middleware('auth');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store')->middleware('auth');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('account.dashboard')->middleware('auth');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy')->middleware('auth');
Route::get('/notes/{note}', [NoteController::class, 'describe'])->name('notes.describe')->middleware('auth');
Route::post('/search', [SubjectController::class, 'searchNotes'])->name('search')->middleware('auth');