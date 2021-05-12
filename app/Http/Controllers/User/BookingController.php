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
    public function index()
    {
        //
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
        // dd($request);
        //セッションに保存したい変数を定義（商品id,注文個数,メモ）
        //飛んできた$requestの中のname属性をそれぞれ指定
        $SessionProductId = $request->id;
        $SessionProductQuantity = $request->quantity;
        $SessionProductMemo = $request->memo;
        //配列の入れ物を作る（初期化）
        $SessionData = array();

        //作った配列に、compact関数を用いてidと個数の変数をまとめる（”” を使っているが変数の意味）
        $SessionData = compact("SessionProductId", "SessionProductQuantity", "SessionProductMemo");

        //session_dataというキーで、$SessionDataをセッションに登録
        $request->session()->push('session_data', $SessionData);

        return redirect('cartitem');

    }
}
