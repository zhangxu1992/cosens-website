<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 多语言路由组
Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => '[a-zA-Z_]{2,5}'],
    'middleware' => ['locale'],
], function () {
    
    // 首页
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // 产品中心
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category');
        Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
    });
    
    // 新闻资讯
    Route::prefix('news')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/company', [PostController::class, 'company'])->name('company');
        Route::get('/industry', [PostController::class, 'industry'])->name('industry');
        Route::get('/{slug}', [PostController::class, 'show'])->name('show');
    });
    
    // 案例展示
    Route::prefix('cases')->name('cases.')->group(function () {
        Route::get('/', [CaseController::class, 'index'])->name('index');
        Route::get('/{slug}', [CaseController::class, 'show'])->name('show');
    });
    
    // 关于我们
    Route::get('/about', [PageController::class, 'about'])->name('about');
    
    // 联系我们
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
    
    // 询盘功能
    Route::prefix('inquiry')->name('inquiry.')->group(function () {
        Route::get('/', [InquiryController::class, 'index'])->name('index');
        Route::post('/submit', [InquiryController::class, 'submit'])->name('submit');
        Route::get('/success', [InquiryController::class, 'success'])->name('success');
    });
    
    // 报价功能
    Route::prefix('quotation')->name('quotation.')->group(function () {
        Route::get('/{product}', [InquiryController::class, 'quotation'])->name('index');
        Route::post('/submit', [InquiryController::class, 'quotationSubmit'])->name('submit');
    });
    
    // 单页路由
    Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
});

// 语言切换
Route::get('/switch-language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('languages.available'))) {
        session(['locale' => $locale]);
        cookie()->queue('cosens_locale', $locale, config('languages.cookie_lifetime'));
    }
    return redirect()->back();
})->name('switch.language');

// 搜索
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Sitemap
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

// Robots
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');
