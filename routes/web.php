<?php

use App\Http\Controllers\Calculator\CalculatorController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Faq\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Wiki\WikiController;

Route::namespace('Main')->name('main.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
});

Route::namespace('Product')->name('product.')->group(function () {
    Route::get('/products/{fuel?}/', [ProductController::class, 'index'])->name('index');
    Route::get('products/{id}/show/', [ProductController::class, 'show'])->name('show');
    Route::get('/product/', [ProductController::class, 'search'])->name('search');
});

Route::namespace('Company')->name('company.')->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('index');
});

Route::namespace('Service')->name('service.')->group(function () {
    Route::get('/service/{id}/show', [ServiceController::class, 'show'])->name('show');
});

Route::namespace('News')->name('news.')->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('index');
    Route::get('news/{id}/show', [NewsController::class, 'show'])->name('show');
});

Route::namespace('Calculator')->name('calculator.')->group(function () {
    Route::get('/calculator', [CalculatorController::class, 'index'])->name('index');
});

Route::namespace('Wiki')->name('wiki.')->group(function () {
    Route::get('/wiki', [WikiController::class, 'index'])->name('index');
    Route::get('/wiki/{id}/show', [WikiController::class, 'show'])->name('show');
    Route::get('/wiki/search/', [WikiController::class, 'search'])->name('search');
});

Route::namespace('Faq')->name('faq.')->group(function () {
    Route::get('/faq', [FaqController::class, 'index'])->name('index');
});
