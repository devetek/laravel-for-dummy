<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

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

require __DIR__ . '/auth.php';
