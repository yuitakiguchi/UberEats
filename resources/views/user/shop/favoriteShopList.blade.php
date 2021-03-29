@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="col-md-6 col-xl-3 mb-5 text-center mx-auto">
        <h1>お気に入り店舗リスト(仮名)</h1>
        @foreach ($user->shops as $favoriteShop )
        {{-- @dd($favoriteShop); --}}
            <a href="{{ route('user.shops.show',$favoriteShop->id) }}">
                <div class="card">
                    <img src="{{ $favoriteShop->image_path }}" alt="店舗画像">
                    <div class="card-body">
                        <h5 class="card-title">{{ $favoriteShop->name }}</h5>
                    </div>
                    @if($favoriteShop->users()->where('user_id', Auth::id())->exists())
                        <div class="col-md-3">
                        <form action="{{ route('user.dislikes', $favoriteShop) }}" method="POST">
                            @csrf
                            <input type="submit" value="&#xf004;いいね取り消す" class="fas btn btn-danger">
                        </form>
                        </div>
                    @else
                        <div class="col-md-3">
                        <form action="{{ route('user.likes', $favoriteShop) }}" method="POST">
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
