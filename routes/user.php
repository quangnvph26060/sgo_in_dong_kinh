<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IntroduceController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'HtmlMinifier'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('gioi-thieu', [IntroduceController::class, 'introduce'])->name('introduce');

    Route::get('lien-he', [ContactController::class, 'contact'])->name('contact');
    Route::post('contacts', [ContactController::class, 'postContact'])->name('post.contact');

    Route::get('tin-tuc/{slug?}', [NewsController::class, 'news'])->name('news');

    Route::get('shop', [ProductController::class, 'list'])->name('products.list');
    Route::get('danh-muc/{slug}', [ProductController::class, 'categoryProduct'])->name('category.product');
    Route::get('tu-khoa/{slug}', [ProductController::class, 'tagProduct'])->name('tag.product');
    Route::post('quote-request', [ProductController::class, 'quoteRequest'])->name('quote.request');

    Route::get('{categorySlug}/{productSlug}', [ProductController::class, 'detail'])->name('products.detail');
});
