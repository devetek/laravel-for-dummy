<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\WebVideoController;
use App\Http\Controllers\WebUsersController;
use App\Http\Controllers\WebMenusController;
use App\Http\Controllers\WebProfilesController;
use App\Http\Controllers\WebAccessController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Vide Web
Route::get('video', [WebVideoController::class, 'index'])
    ->name('video')
    ->middleware('auth');

Route::get('video/create', [WebVideoController::class, 'create'])
    ->name('video.create')
    ->middleware('auth');

Route::post('video', [WebVideoController::class, 'store'])
    ->name('video.store')
    ->middleware('auth');

Route::get('video/{video}/edit', [WebVideoController::class, 'edit'])
    ->name('video.edit')
    ->middleware('auth');

Route::put('video/{video}', [WebVideoController::class, 'update'])
    ->name('video.update')
    ->middleware('auth');

Route::delete('video/{video}', [WebVideoController::class, 'destroy'])
    ->name('video.destroy')
    ->middleware('auth');


// User Web
Route::get('user', [WebUsersController::class, 'index'])
->name('user')
->middleware('auth');

Route::get('user/create', [WebUsersController::class, 'create'])
->name('user.create')
->middleware('auth');

Route::post('user', [WebUsersController::class, 'store'])
->name('user.store')
->middleware('auth');

Route::get('user/{user}/edit', [WebUsersController::class, 'edit'])
->name('user.edit')
->middleware('auth');

Route::put('user/{user}', [WebUsersController::class, 'update'])
->name('user.update')
->middleware('auth');

Route::delete('user/{user}', [WebUsersController::class, 'destroy'])
->name('user.destroy')
->middleware('auth');


// Menu Web
Route::get('menu', [WebMenusController::class, 'index'])
->name('menu')
->middleware('auth');

Route::get('menu/create', [WebMenusController::class, 'create'])
->name('menu.create')
->middleware('auth');

Route::post('menu', [WebMenusController::class, 'store'])
->name('menu.store')
->middleware('auth');

Route::get('menu/{menu}/edit', [WebMenusController::class, 'edit'])
->name('menu.edit')
->middleware('auth');

Route::put('menu/{menu}', [WebMenusController::class, 'update'])
->name('menu.update')
->middleware('auth');

Route::delete('menu/{menu}', [WebMenusController::class, 'destroy'])
->name('menu.destroy')
->middleware('auth');


// Profile Web
Route::get('profile', [WebProfilesController::class, 'index'])
->name('profile')
->middleware('auth');

Route::get('profile/create', [WebProfilesController::class, 'create'])
->name('profile.create')
->middleware('auth');

Route::post('profile', [WebProfilesController::class, 'store'])
->name('profile.store')
->middleware('auth');

Route::get('profile/{profile}/edit', [WebProfilesController::class, 'edit'])
->name('profile.edit')
->middleware('auth');

Route::put('profile/{profile}', [WebProfilesController::class, 'update'])
->name('profile.update')
->middleware('auth');

Route::delete('profile/{profile}', [WebProfilesController::class, 'destroy'])
->name('profile.destroy')
->middleware('auth');


// Access Web
Route::get('access', [WebAccessController::class, 'index'])
->name('access')
->middleware('auth');

Route::get('access/create', [WebAccessController::class, 'create'])
->name('access.create')
->middleware('auth');

Route::post('access', [WebAccessController::class, 'store'])
->name('access.store')
->middleware('auth');

Route::get('access/{access}/edit', [WebAccessController::class, 'edit'])
->name('access.edit')
->middleware('auth');

Route::put('access/{access}', [WebAccessController::class, 'update'])
->name('access.update')
->middleware('auth');

Route::delete('access/{access}', [WebAccessController::class, 'destroy'])
->name('access.destroy')
->middleware('auth');



// Products
Route::get('products', [ProductController::class, 'index'])
    ->name('products')
    ->middleware('auth');

Route::get('products/create', [ProductController::class, 'create'])
    ->name('products.create')
    ->middleware('auth');

Route::post('products', [ProductController::class, 'store'])
    ->name('products.store')
    ->middleware('auth');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit')
    ->middleware('auth');

Route::put('products/{product}', [ProductController::class, 'update'])
    ->name('products.update')
    ->middleware('auth');

Route::delete('products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy')
    ->middleware('auth');

// Mahasiswa
Route::get('mahasiswa', [MahasiswaController::class, 'index'])
    ->name('mahasiswa')
    ->middleware('auth');

Route::get('mahasiswa/create', [MahasiswaController::class, 'create'])
    ->name('mahasiswa.create')
    ->middleware('auth');

Route::post('mahasiswa', [MahasiswaController::class, 'store'])
    ->name('mahasiswa.store')
    ->middleware('auth');

Route::get('mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])
    ->name('mahasiswa.edit')
    ->middleware('auth');

Route::put('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])
    ->name('mahasiswa.update')
    ->middleware('auth');

Route::delete('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
    ->name('mahasiswa.destroy')
    ->middleware('auth');

Route::get('mahasiswa/export/pdf', [MahasiswaController::class, 'createPDF'])
    ->name('mahasiswa.createPDF')
    ->middleware('auth');

require __DIR__ . '/auth.php';
