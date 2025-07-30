<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AlertMailSecurityController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Étape 1 : Affichage du formulaire "Mot de passe oublié"
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request'); //en cliquant sur forgot password

    // Étape 2 : Envoi de l'e-mail contenant le lien de réinitialisation
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email'); //tu demandes au syteme a etre verifie puis apres ajout d'email tu es recois un email

    // Étape 3 : Affichage du formulaire de nouveau mot de passe via le lien reçu par e-mail
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset'); //tu es redirige vers le site ou tu devras rentre des infos avec le new password a confirmer

    // Étape 4 : Soumission du nouveau mot de passe (mise à jour en base)
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store'); //quand tu valides tu es dirige vers la page du site (ici dashboard)
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    //Activate when password confirm will be implemented
    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

});
