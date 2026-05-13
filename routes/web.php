<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Products
Route::get('/products', function () {
    return view('products.index');
})->name('products');

Route::get('/products/{slug}', function ($slug) {
    return view('products.show', ['slug' => $slug]);
})->name('product.show');

// About
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/about/factory', function () {
    return view('factory');
})->name('factory');

// News
Route::get('/news', function () {
    return view('news.index');
})->name('news');

Route::get('/news/{slug}', function ($slug) {
    return view('news.show', ['slug' => $slug]);
})->name('news.show');

// Cases
Route::get('/cases', function () {
    return view('cases');
})->name('cases');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Quote
Route::get('/quote', function () {
    return view('quote');
})->name('quote');

Route::post('/quote', function () {
    // Handle quote form submission
    return redirect()->back()->with('success', 'Quote request submitted successfully!');
})->name('quote.submit');

// Language Switch
Route::get('/lang/{locale}', function ($locale) {
    $supported = ['en', 'zh', 'es', 'ar', 'fr', 'ru', 'pt', 'de', 'ja', 'ko'];
    if (in_array($locale, $supported)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');
