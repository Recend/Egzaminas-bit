<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::post('books/find',[BookController::class, 'findBook'])->name('books.find');
    Route::resources([
        'categories' => CategoryController::class,
        'books' => BookController::class,
        'favorites' => FavoriteController::class,
    ]);

    Route::get('/images/{name}', [BookController::class, 'display'])
        ->name('images.books');

    Route::put('order/{add}', [BookController::class, 'placeOrder'])->name('book.order');
    Route::put('favorite/{add}', [BookController::class, 'placeFavorite'])->name('book.favorite');

    Route::get('/setLang/{lang}', [LangController::class, 'setLanguage'])->name('setLang');

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
