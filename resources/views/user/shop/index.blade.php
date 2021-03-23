@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-xl-3 mb-5 text-center mx-auto">
        @foreach ($shops as $shop)
            <a href="{{ route('user.shops.show',$shop->id) }}">
                <div class="card">
                    <img src="{{ $shop->image_path }}" alt="商品画像">
                    <div class="card-body">
                        <h5 class="card-title">{{ $shop->name }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
