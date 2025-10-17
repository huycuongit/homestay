<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CommitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomestayController;
// Admin Routers new
use App\Http\Controllers\Admin\System\SystemController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\Province\ProvinceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Artisan
Route::get('reset-systems-cache-admin', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "<h1>All Config Cache Clear Successfully.</h1>";
});

// Routers for Auth Admin
$finalString = 'iIT9DQ89BRUOyvMSEyUJGLSmT4tlVj';
Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get($finalString . 'login' . $finalString, [LoginController::class, 'login'])->name('admin.login');
Route::post($finalString . 'login' . $finalString, [LoginController::class, 'postlogin'])->name('admin.save.login');

// Routers for authadmin
Route::group(['middleware' => 'authadmin'], function () {

    $project = 'homestay-project';

    Route::middleware(['check.permissions'])->group(function () use ($project) {

        Route::get($project, [DashboardController::class, 'index'])->name('admin.dashboard.index');

        Route::prefix("{$project}/")->group(function () {



            Route::get('users/all', [UserController::class, 'getAll'])->name('admin.users.all');
            Route::get('users/datatables', [UserController::class, 'datatables'])->name('admin.users.datatables');
            Route::resource('users', UserController::class)
                ->names('admin.users')
                ->parameters([
                    'users' => 'id',
                ]);

            Route::get('roles/all', [RoleController::class, 'getAll'])->name('admin.roles.all');
            Route::get('roles/permissions', [RoleController::class, 'permissions'])->name('admin.roles.permissions');
            Route::get('roles/datatables', [RoleController::class, 'datatables'])->name('admin.roles.datatables');
            Route::resource('roles', RoleController::class)
                ->names('admin.roles')
                ->parameters([
                    'roles' => 'id',
                ]);

            Route::get('news/datatables', [NewsController::class, 'datatables'])->name('admin.news.datatables');
            Route::resource('news', NewsController::class)
                ->names('admin.news')
                ->parameters([
                    'news' => 'id',
                ]);

            Route::get('services/datatables', [ServiceController::class, 'datatables'])->name('admin.services.datatables');
            Route::resource('services', ServiceController::class)
                ->names('admin.services')
                ->parameters([
                    'services' => 'id',
                ]);
            Route::get('commits/datatables', [CommitController::class, 'datatables'])->name('admin.commits.datatables');
            Route::resource('commits', CommitController::class)
                ->names('admin.commits')
                ->parameters([
                    'commits' => 'id',
                ]);

            Route::get('galleries/datatables', [GalleryController::class, 'datatables'])->name('admin.galleries.datatables');
            Route::resource('galleries', GalleryController::class)
                ->names('admin.galleries')
                ->parameters([
                    'galleries' => 'id',
                ]);

            Route::get('pages/datatables', [PageController::class, 'datatables'])->name('admin.pages.datatables');
            Route::resource('pages', PageController::class)
                ->names('admin.pages')
                ->parameters([
                    'pages' => 'id',
                ]);
            Route::get('images/datatables', [ImageController::class, 'datatables'])->name('admin.images.datatables');
            Route::resource('images', ImageController::class)
                ->names('admin.images')
                ->parameters([
                    'images' => 'id',
                ]);
            Route::get('homestays/datatables', [HomestayController::class, 'datatables'])->name('admin.homestays.datatables');
            Route::resource('homestays', HomestayController::class)
                ->names('admin.homestays')
                ->parameters([
                    'homestays' => 'id',
                ]);

            Route::get('branches/datatables', [BranchController::class, 'datatables'])->name('admin.branches.datatables');
            Route::resource('branches', BranchController::class)
                ->names('admin.branches')
                ->parameters([
                    'branches' => 'id',
                ]);
                Route::get('/provinces/{id}', [ProvinceController::class, 'show'])
                ->name('admin.provinces.show');
            Route::controller(SystemController::class)->prefix('/systems')->as('admin.systems.')->group(function () {
                Route::get('/generals', 'general')->name('generals');
                Route::get('/apis', 'apis')->name('apis');
                Route::get('/services', 'services')->name('services');
                Route::get('/socials', 'socials')->name('socials');
                Route::get('/config-shareholders', 'configshareholders')->name('config-shareholders');
                Route::get('/otps', 'otps')->name('otps');
                Route::get('/notifications', 'notifications')->name('notifications');

                Route::post('/consoles', 'runConsoles')->name('run');
                Route::put('/update', 'update')->name('update');
            });
        });
    });
});
