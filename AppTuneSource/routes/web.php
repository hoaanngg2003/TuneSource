<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ArtistsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\SongsController;
use App\Models\songs;

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
Route::post('/artist-image-upload', 'ArtistImageUploadController@artistImageUploadPost');
Route::post('/song-image-upload', 'SongImageUploadController@songImageUploadPost');
Route::post('/song-audio-upload', 'SongAudioUploadController@songAudioUploadPost');
Route::post('/album-image-upload', 'AlbumImageUploadController@albumImageUploadPost');


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
 
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
 
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::controller(AlbumsController::class)->prefix('albums')->group(function () {
        Route::get('', 'index')->name('albums');
        Route::get('add', 'add')->name('albums.add');
        Route::post('save', 'save')->name('albums.save');
        Route::get('edit/{id}', 'edit')->name('albums.edit');
        Route::post('edit/{id}', 'update')->name('albums.update');
        Route::get('delete/{id}', 'delete')->name('albums.delete');
    });

    Route::controller(SongsController::class)->prefix('songs')->group(function () {
        Route::get('', 'index')->name('songs');
        Route::get('add', 'add')->name('songs.add');
        Route::post('save', 'save')->name('songs.save');
        Route::get('edit/{id}', 'edit')->name('songs.edit');
        Route::post('edit/{id}', 'update')->name('songs.update');
        Route::get('delete/{id}', 'delete')->name('songs.delete');
    });
    
    Route::controller(ArtistsController::class)->prefix('artists')->group(function () {
        Route::get('', 'index')->name('artists');
        Route::get('add', 'add')->name('artists.add');
        Route::post('save', 'save')->name('artists.save');
        Route::get('edit/{id}', 'edit')->name('artists.edit');
        Route::post('edit/{id}', 'update')->name('artists.update');
        Route::get('delete/{id}', 'delete')->name('artists.delete');
    });
    
    Route::controller(GenresController::class)->prefix('genres')->group(function () {
        Route::get('', 'index')->name('genres');
        Route::get('add', 'add')->name('genres.add');
        Route::post('save', 'save')->name('genres.save');
        Route::get('edit/{id}', 'edit')->name('genres.edit');
        Route::post('edit/{id}', 'update')->name('genres.update');
        Route::get('delete/{id}', 'delete')->name('genres.delete');
    });

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('add', 'add')->name('products.add');
        Route::post('add', 'save')->name('products.save');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::post('edit/{id}', 'update')->name('products.update');
        Route::get('delete/{id}', 'delete')->name('products.delete');
    });
 
    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('save', 'save')->name('category.save');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::get('delete/{id}', 'delete')->name('category.delete');
    });


});