<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use DB;
use App\Food;
use App\Models\User;
use App\Booking;
use Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookingRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | カート商品リスト
        |--------------------------------------------------------------------------
        */
        //渡されたセッション情報をkey（名前）を用いそれぞれ取得、変数に代入
        $sessionUser = User::find($request->session()->get('users_id'));

        //removeメソッドでの配列削除時の配列連番抜け対策
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        if (!empty($cartData)) {
            $sessionProductsId = array_column($cartData, 'session_product_id');
            $product = Food::with('foods')->find($sessionProductsId);

            foreach ($cartData as $index => &$data) {
                //二次元目の配列を指定している$dataに'product〜'key生成 Modelオブジェクト内の各カラムを代入
                //＆でリファレンス渡し 仮引数($data)の変更で実引数($cartData)を更新する
                $data['product_name'] = $product[$index]->name;
                $data['price']        = $product[$index]->price;
                //商品小計の配列作成し、配列の追加
                $data['itemPrice']    = $data['price'] * $data['session_product_quantity'];
            }
            unset($data);

            return view('products.cartlist', compact('sessionUser', 'cartData', 'totalPrice'));
        } else {

            return view('products.no_cart_list',  ['user' => Auth::user()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request, $shopFood, $food)
    {
        // $booking = new Booking;

        // $booking->food_id  = $food;
        // $booking->user_id  = Auth::id();
        // $booking->quantity = $request->quantity;
        // $booking->memo = $request->memo;
        // $booking->save();

        // return redirect()->route('user.shops.show', $shopFood);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addCart(BookingRequest $request)
    {
        /*
    |--------------------------------------------------------------------------
    | 商品詳細 → カート画面へのSession情報保存
    |--------------------------------------------------------------------------
    */
        //商品詳細画面のhidden属性で送信（Request）された商品ID,注文個数,メモを取得し配列として変数に格納
        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        $cartData = [
            'session_product_id' => $request->product_id,
            'session_product_quantity' => $request->quantity,
            'session_product_memo' => $request->memo,
        ];

        //sessionにcartData配列が「無い」場合、商品情報の配列をcartData(key)という名で$cartDataをSessionに追加
        if (!$request->session()->has('cartData')) {
            $request->session()->push('cartData', $cartData);
        } else {
            // sessionにcartData配列が「有る」場合、情報取得
            $sessionCartData = $request->session()->get('cartData');
            //isSameProductId定義 product_id同一確認フラグ false = 同一ではない状態を指定
            $isSameProductId = false;
            foreach ($sessionCartData as $index => $sessionData) {
                //product_idが同一であれば、フラグをtrueにする → 個数の合算処理、及びセッション情報更新。更新は一度のみ
                if ($sessionData['session_product_id'] === $cartData['session_product_id']) {
                    $isSameProductId = true;
                    $quantity = $sessionData['session_product_quantity'] + $cartData['session_product_quantity'];
                    $memo     = $cartData['session_product_memo'];
                    // cartDataをrootとしたツリー状の多次元連想配列の特定のValueにアクセスし、指定の変数でValueの上書き処理
                    $request->session()->put('cartData.' . $index . '.session_product_quantity', $quantity , '.session_product_memo', $memo);
                    break;
                }
            }

            //product_idが同一ではない状態を指定 その場合であればpushする
            if ($isSameProductId === false) {
                $request->session()->push('cartData', $cartData);
            }
        }
        //POST送信された情報をsessionに保存 'users_id'(key)に$request内の'users_id'をセット
        $request->session()->put('user_id', ($request->user_id));
        return redirect()->route('user.cartlist.index');


    }


    public function remove(BookingRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | カート内商品の削除
        |--------------------------------------------------------------------------
        */
        //session情報の取得（product_idと個数の2次元配列）
        $sessionCartData = $request->session()->get('cartData');

        //削除ボタンから受け取ったproduct_idと個数を2次元配列に
        $removeCartItem = [
            [
                'session_product_id' => $request->product_id,
                'session_quantity'    => $request->product_quantity
            ]
        ];

        //sessionデータと削除対象データを比較、重複部分を削除し残りの配列を抽出
        $removeCompletedCartData = array_udiff($sessionCartData, $removeCartItem, function ($sessionCartData, $removeCartItem) {
            $result1 = $sessionCartData['session_products_id'] - $removeCartItem['session_product_id'];
            $result2 = $sessionCartData['session_product_quantity'] - $removeCartItem['session_product_quantity'];
            return $result1 + $result2;
        });

        //上記の抽出情報でcartDataを上書き処理
        $request->session()->put('cartData', $removeCompletedCartData);
        //上書き後のsession再取得
        $cartData = $request->session()->get('cartData');

        //session情報があればtrue
        if ($request->session()->has('cartData')) {
            return redirect()->route('user.cartlist.index');
        }

        return view('products.no_cart_list', ['user' => Auth::user()]);
    }

}
