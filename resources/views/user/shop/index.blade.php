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
                    @if($shop->likes()->where('shop_id', Auth::id())->exists())
                        <div class="col-md-3">
                        <form action="{{ route('user.dislikes', $shop) }}" method="POST">
                            @csrf
                            <input type="submit" value="&#xf004;いいね取り消す" class="fas btn btn-danger">
                        </form>
                        </div>
                    @else
                        <div class="col-md-3">
                        <form action="{{ route('user.likes', $shop) }}" method="POST">
                            @csrf
                            <input type="submit" value="&#xf004;いいね" class="fas btn btn-success">
                        </form>
                        </div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
