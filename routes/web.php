<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\SocialProvidersController;


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

Route::middleware('auth')->group(function (){
    Route::get('/account', AccountController::class)
    ->name('account');
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function (){
    Route::get('/', AdminController::class)
        -> name('index');
    Route::get('/parser', ParserController::class)->name('parser');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('users', UserController::class);
});
});


 // news routesfeedback

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->where('id', '\d+')
    ->name('news.show');


 //feedback route

Route::resource('feedback', FeedbackController::class);

//order route
Route::Resource('order', OrderController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


Route::group(['middleware' => 'guest'], function(){
    Route::get('/auth/redirect/{driver}', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '/w+')
        ->name('social.auth.redirect');

    Route::get('/auth/callback/{driver}', [SocialProvidersController::class, 'callback'])
        ->where('driver', '/w+');
});
