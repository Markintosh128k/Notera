<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function () {
    return redirect('/');
});

Route::post('/subject/notes', [SubjectController::class, 'showNotes'])->name('subject.notes');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store')->middleware('auth');
Route::post('/search', [SubjectController::class, 'searchNotes'])->name('search')->middleware('auth');
Route::post('/notes/{note}/reviews', [ReviewController::class, 'store'])->name('notes.reviews.store')->middleware('auth');

Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create')->middleware('auth');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('account.dashboard')->middleware('auth');
Route::get('/notes/{note}', [NoteController::class, 'describe'])->name('notes.describe')->middleware('auth');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy')->middleware('auth');

Route::put('/notes/{note}/reviews/{review}', [ReviewController::class, 'update'])->name('notes.reviews.update')->middleware('auth');


Route::post('/password/email', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Schedule::command('auth:clear-resets')->everyFifteenMinutes();