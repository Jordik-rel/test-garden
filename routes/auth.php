<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\auth\RegisterByPhoneController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\RegisterCompleteController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route::post('register-phone',[RegisterByPhoneController::class, 'store'])
    //     ->name('registerPhone');
    
    // Route::get('otp/verification-notification',[RegisterByPhoneController::class,'otp'])
    //     ->name('otp.verify');
    
    // Route::post('otp/verification-notification',[RegisterByPhoneController::class,'verifyOtp']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    
    /**
     * Ceci c'est la route qui se charge de la redirection en fonction du status email vérifié ou non
     */
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    /**
     * Ceci c'est la route de vérification du mail 
     */
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    /**
     * Ceci c'est la route qui envoie le mail de vérification
     */
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    
    
    // Route::get('/what', [WhatsappController::class, 'index']);
    // Route::post('whatsapp', [WhatsAppController::class, 'store']);
    
    /**
     * Route pour l'envoie de l'otp
     */

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::put('password',[AccountController::class, 'password'])->name('account.password');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout')->middleware('verified');
});


// Route::get('register',[RegisterByEmailController::class,'create'])
//     ->name('register');

//     Route::post('register',[RegisterByEmailController::class, 'store'])
//     ->name('emailRegister');
