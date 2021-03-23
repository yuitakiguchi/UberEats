@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="gp gq gr gs gt gu">
                @foreach ($shops as $shop)
                <div class="gv gw gx">
                    <div class="af al">
                        <a href=""></a>
                        <img src="{{ $shop->image_path }}" alt="商品画像">
                        <h3 class="card-title">{{ $shop->name }}</h3>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
