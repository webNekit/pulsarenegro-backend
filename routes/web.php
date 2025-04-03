<?php

use App\Http\Controllers\Calculator\CalculatorController;
use App\Http\Controllers\Faq\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Product\ProductController;

Route::namespace('Main')->name('main.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
});

Route::namespace('Product')->name('product.')->group(function () {
    Route::get('/products/{fuel?}/', [ProductController::class, 'index'])->name('index');
    Route::get('products/{id}/show/', [ProductController::class, 'show'])->name('show');
    Route::get('/product/', [ProductController::class, 'search'])->name('search');
});

Route::namespace('News')->name('news.')->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('index');
    Route::get('news/{id}/show', [NewsController::class, 'show'])->name('show');
});

Route::namespace('Calculator')->name('calculator.')->group(function () {
    Route::get('/calculator', [CalculatorController::class, 'index'])->name('index');
});

Route::namespace('Faq')->name('faq.')->group(function () {
    Route::get('/faq', [FaqController::class, 'index'])->name('index');
});
