<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\Shop;
use Auth;
use JD\Cloudder\Facades\Cloudder;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 自分が投稿した物だけを表示
        $shopFoods = Food::with('shops')->where('shop_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('shop.food.index', compact('shopFoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $food = new Food;

        $food->name         = $request->name;
        $food->price        = $request->price;
        $food->cooking_time = $request->cooking_time;
        $food->description  = $request->description;
        $food->tax_rate     = $request->tax_rate;
        $food->shop_id      = Auth::id();

        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 200,
                'height'    => 200
            ]);
            $food->image_path = $logoUrl;
            $food->public_id  = $publicId;
        }

        $food->save();

        return redirect()->route('shop.foods.index');
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
        $food = Food::find($id);

        if (Auth::id() !== $food->shop_id) {
            return abort(404);
        }

        return view('shop.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        $food = Food::find($id);

        if (Auth::id() !== $food->shop_id) {
            return abort(404);
        }

        $food -> name        = $request -> name;
        $food -> price       = $request -> price;
        $food ->cooking_time = $request -> cooking_time;
        $food ->description  = $request -> description;
        $food ->tax_rate     = $request -> tax_rate;

        $food -> save();
        // return view('shop.food.index', compact('food'));
        return redirect()->route('shop.foods.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        if (Auth::id() !== $food->shop_id) {
            return abort(404);
        }

        if (isset($food->public_id)) {
            Cloudder::destroyImage($food->public_id);
        }

        $food->delete();
        return redirect()->route('shop.foods.index');
    }
}
