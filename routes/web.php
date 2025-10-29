<?php

use App\Livewire\Quiz\QuizList;
use App\Livewire\Quiz\ShowQuiz;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name(
        'settings.appearance'
    );

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication() &&
                    Features::optionEnabled(
                        Features::twoFactorAuthentication(),
                        'confirmPassword'
                    ),
                ['password.confirm'],
                []
            )
        )
        ->name('two-factor.show');

    Route::get('/dashboard', function () {
        return redirect(route('quiz.list'));
    })->name('dashboard');
    Route::get('/quizzes', QuizList::class)->name('quiz.list');
    Route::get('/quizzes/{quiz}', ShowQuiz::class)->name('quiz.show');
});

require __DIR__ . '/auth.php';
