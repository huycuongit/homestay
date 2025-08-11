<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\SitemapController;

// Clear cache artisan
Route::get('reset-systems-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "<h1>All Config Cache Clear Successfully.</h1>";
});

// Model Contacts
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');


Route::post('/activity-logs', [PageController::class, 'saveLogs'])->name('page.activity.logs');
Route::post('/submit-login', [AuthController::class, 'submitLogin'])->name('auth.submitLogin');
Route::get('/dang-nhap', [AuthController::class, 'login'])->name('auth.login');

// Careers
// Ckfinder connects  
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

//news
// 404
Route::get('/he-thong-dang-bao-tri', function () {
    abort(404);
})->name('link.404');

//Site map
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::middleware(['authUser'])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('page.index');
    
    // Model News
    Route::get('/dich-vu/{slug}', [NewsController::class, 'detail'])->name('service.detail');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/{slug}', [PageController::class, 'bySlug'])->name('page.slug');
});
// Route::get('/{slug}', [PageController::class, 'bySlug'])->name('page.slug');
 