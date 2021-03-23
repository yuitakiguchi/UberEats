@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="row mb-5 justify-content-center">
        @foreach ($shopFoods as $shopFood)
            <div class="col-md-6 col-xl-3 mb-5 text-center mx-auto">
                    <a href="#">
                        <div class="card">
                            <div class="col">
                                <img src="{{ $shopFood->image_path }}" alt="商品画像">
                            </div>
                            <h5 class="card-title">{{ $shopFood->name }}</h5>
                            <p class="card-text">{{ $shopFood->description }}</p>
                        </div>
                    </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
