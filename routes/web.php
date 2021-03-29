<?php

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

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

        Route::resource('foods', 'FoodController',
            [
                'only' => ['index', 'show']
            ]
        );

        Route::resource('shops', 'ShopController',
            [
                'only' => ['index', 'show']
            ]
        );

        Route::post('shops/{shop}/likes', 'LikeController@store')->name('likes');
        Route::post('shops/{shop}/dislikes', 'LikeController@destroy')->name('dislikes');
        Route::get('{user}/favoriteShopList', 'LikeController@favorite')->name('favoriteShopList');
    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// レストラン
Route::namespace('Shop')->prefix('shop')->name('shop.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:shop')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

        Route::resource('foods', 'FoodController', [
            'only' => ['index', 'edit', 'create', 'show', 'store', 'destroy', 'update']]
        );

        Route::resource('shops','ShopController', [
            'only' => ['edit', 'update']]
        );


    });
});

// デリバー
Route::namespace('Deliver')->prefix('deliver')->name('deliver.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:deliver')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('shops', 'Shop\ShopController');
Route::resource('users', 'User\UserController');
Route::resource('delivers', 'Deliver\DeliverController');
// Route::resource('foods', 'Food\FoodController');
