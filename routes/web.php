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

        // Route::resource('foods', 'FoodController',
        //     [
        //         'only' => ['index', 'show']
        //     ]
        // );
        Route::resource('shops/{shop}/foods','FoodController',
            [
                'only' => ['show']
            ]
        );

        Route::resource('shops', 'ShopController',
            [
                'only' => ['index', 'show']
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | カート内商品関連
        |--------------------------------------------------------------------------
        */
        // カート内が空
        Route::view('/no-cartList','products/no_cart_list')->name('noCartlist');
        // 購入完了後
        Route::view('/purchaseCompleted', 'products/purchase_completed')->name('purchaseCompleted');
        // カート商品リスト
        Route::resource('cartlist', 'BookingController',['only' => ['index']]);
        // カートから商品削除
        Route::post('productInfo/addCart/cartListRemove', 'BookingController@remove')->name('itemRemove');
        // カートに商品追加
        Route::post('productInfo/addCart', 'BookingController@addCart')->name('addcart.post');
        // 注文確定
        Route::post('productInfo/addCart/orderFinalize', 'BookingController@store')->name('orderFinalize');

        /*
        |--------------------------------------------------------------------------
        | お気に入り店舗リスト関連
        |--------------------------------------------------------------------------
        */
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
