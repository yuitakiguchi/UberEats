@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @foreach ($shopFoods as $shopFood)
            {{-- <a href="{{ route('user.foods.show',['shop' => $shopFood->shop_id, 'food' => $shopFood->id]) }}"> --}}
            {{-- <a href="{{ action('User\FoodController@show', ['shop' => $shopFood->shop_id, 'food' => $shopFood->id]) }}"> --}}
                <div data-toggle="modal" data-target="#exampleModalLong" data-whatever="{{ $shopFood->name }}">
                    <div  class="col-md-6 col-xl-3 mb-5 text-center mx-auto">
                        <div class="card">
                            <img src="{{ $shopFood->image_path }}" alt="商品画像">
                            <h5 class="card-title">{{ $shopFood->name }}</h5>
                            <p class="card-text">{{ $shopFood->description }}</p>
                        </div>
                    </div>
                </div>
            {{-- </a> --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $shopFood->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $shopFood->image_path }}" alt="商品画像">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $shopFood->name }}</h5>
                            <p class="card-text">{{ $shopFood->description }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Add ◯ to order</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>

@endsection
