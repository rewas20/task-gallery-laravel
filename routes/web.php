<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\AlbumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('albums.index');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->prefix('albums')->group(function () {
    Route::get('/', [AlbumController::class, 'index'])->name('albums.index');
    Route::post('/store', [AlbumController::class, 'store'])->name('albums.store');
    Route::post('/{album}/update', [AlbumController::class, 'update'])->name('albums.update');
    Route::get('/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::delete('/{album}', [AlbumController::class, 'destroy'])->name('albums.delete');
    Route::post('/move/{album}', [AlbumController::class, 'move'])->name('albums.move');

});
Route::middleware('auth')->prefix('pictures')->group(function () {
    Route::post('/store/{album}', [PictureController::class, 'store'])->name('pictures.store');
    Route::delete('/delete/{id}', [PictureController::class, 'destroy'])->name('pictures.delete');

});

require __DIR__.'/auth.php';
