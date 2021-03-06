<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Food;
use Auth;

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
        $foods = Food::all();
        return view('shop.food.index', compact('foods'));
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

        $food->delete();
        return redirect()->route('shop.foods.index');
    }
}
