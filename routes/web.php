<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\ContactController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// web routes
Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [ContactController::class, 'contact'])->name('contact');
// admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => AuthCheck::class], function () {
        Route::get('/', function () {
            return view('admin.home');
        })->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::put('/pages', [\App\Http\Controllers\Admin\PageController::class, 'update'])->name('admin.pages.update');
        Route::post('/pages', [\App\Http\Controllers\Admin\PageController::class, 'store'])->name('admin.pages.store');
        Route::delete('/pages/{id}', [\App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
        Route::delete('/inquiries/{id}', [\App\Http\Controllers\Admin\InquiryController::class, 'destroy'])->name('admin.inquiries.destroy');
        Route::get('/works', [\App\Http\Controllers\Admin\WorkController::class, 'getAllWorks'])->name('admin.works');
        Route::post('/works', [\App\Http\Controllers\Admin\WorkController::class, 'storeWork'])->name('admin.works.store');
        Route::put('/works/{id}', [\App\Http\Controllers\Admin\WorkController::class, 'updateWork'])->name('admin.works.update');
        Route::delete('/works/{id}', [\App\Http\Controllers\Admin\WorkController::class, 'deleteWork'])->name('admin.works.destroy');

        // Skills & Proficiencies Routes
        Route::post('/skills', [\App\Http\Controllers\Admin\SkillController::class, 'store'])->name('admin.skills.store');
        Route::put('/skills/{id}', [\App\Http\Controllers\Admin\SkillController::class, 'update'])->name('admin.skills.update');
        Route::delete('/skills/{id}', [\App\Http\Controllers\Admin\SkillController::class, 'destroy'])->name('admin.skills.destroy');
        Route::get('/skills/{skillId}/contents', [\App\Http\Controllers\Admin\SkillController::class, 'getContents'])->name('admin.skills.contents');
        Route::post('/skills/contents', [\App\Http\Controllers\Admin\SkillController::class, 'storeContent'])->name('admin.skills.contents.store');
        Route::put('/skills/contents/{id}', [\App\Http\Controllers\Admin\SkillController::class, 'updateContent'])->name('admin.skills.contents.update');
        Route::delete('/skills/contents/{id}', [\App\Http\Controllers\Admin\SkillController::class, 'destroyContent'])->name('admin.skills.contents.destroy');
    });
    // Auth routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login-send', [AuthController::class, 'login'])->name('admin.login.post');
});
