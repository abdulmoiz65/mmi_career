<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerJobController;
use App\Http\Controllers\UserJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ManageAdminController; 
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// ===== User Authentication =====
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {return redirect()->route('login.form');});

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password', [PasswordResetController::class, 'sendOtp'])->name('password.sendOtp');

Route::get('/verify-otp', [PasswordResetController::class, 'showOtpForm'])->name('password.otpForm');
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('password.verifyOtp');

Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.resetForm');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.reset');

Route::get('/email/verify', [AuthController::class, 'showVerifyForm'])
    ->middleware('auth')->name('verification.notice');

Route::post('/email/verify', [AuthController::class, 'verifyOtp'])
    ->middleware('auth')->name('verification.verify');

Route::post('/email/resend-otp', [AuthController::class, 'resendOtp'])
    ->middleware('auth')->name('verification.resend');



Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
// Career Job Routes
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::middleware('super.admin')->group(function () {
        Route::get('/View-admins', [ManageAdminController::class, 'index'])->name('admin.pages.view_admin');
        Route::get('/create-admin', [ManageAdminController::class, 'create'])->name('admin.pages.create_admin');
        Route::post('/store-admin', [ManageAdminController::class, 'store'])->name('admin.pages.store_admin');
        Route::get('/edit-admin/{id}', [ManageAdminController::class, 'edit'])->name('admin.pages.edit_admin');
        Route::put('/update-admin/{id}', [ManageAdminController::class, 'update'])->name('admin.pages.update_admin');
        Route::delete('/delete/{id}', [ManageAdminController::class, 'destroy'])->name('admins.destroy');
    });

    Route::get('/create-job', [CareerJobController::class, 'create'])->name('jobs.create');
    Route::post('/store-job', [CareerJobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs', [CareerJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{id}/edit', [CareerJobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [CareerJobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [CareerJobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/applications/archived', [ApplicationController::class, 'archived'])->name('admin.pages.archived');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('admin.pages.view_applications');
    Route::get('/applications/shortlisted', [ApplicationController::class, 'shortlisted'])->name('admin.pages.shortlisted');
    Route::get('/applications/rejected',[ApplicationController::class, 'rejected'])->name('admin.pages.rejected');
    Route::get('/applications/{id}', [ApplicationController::class,'show'])->name('admin.pages.view_application_show');
    Route::post('/applications/{id}/shortlist',[ApplicationController::class, 'shortlist'])->name('admin.applications.shortlist');
    Route::post('/applications/{id}/unshortlist', [ApplicationController::class, 'unshortlist'])->name('admin.applications.unshortlist');
    Route::post('/applications/{id}/reject',[ApplicationController::class, 'reject'])->name('admin.applications.reject');
    Route::post('/applications/{id}/unreject',[ApplicationController::class, 'unreject'])->name('admin.applications.unreject');
    Route::post('/applications/download-resumes', [ApplicationController::class, 'downloadResumes'])->name('admin.applications.downloadResumes');

});


Route::get('/', [UserJobController::class, 'index'])->name('user.index');
// Applications

// Route::get('/admin/applications/{id}', [ApplicationController::class,'show'])
//      ->name('admin.applications.show');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/apply/{job}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
});


Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');