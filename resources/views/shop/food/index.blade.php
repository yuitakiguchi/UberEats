@extends('layouts.shop.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    商品投稿画面（shop）
                </div>
                @foreach ($foods as $food)
                <div class="card-body">
                    <h5 class="card-title">商品名：{{ $food->name }}</h5>
                    <p class="card-text">内容：{{ $food->description }}</p>
                    <p class="card-text">金額：{{ $food->price }}</p>
                    <a href="#" class="btn btn-primary">詳細へ</a>
                </div>
                <div class="card-footer text-muted">
                    投稿日時：{{ $food->created_at }}
                </div>
                @endforeach
                {{-- <div class="card-body">
                    <p class="card-text">写真を追加</p>
                    <p class="card-text">メニュー提供時間</p>
                    <p class="card-text">新規メニュー作成</p>
                    <p class="card-text">メニュー編集</p>
                </div> --}}
            </div>
            <div class="col-md-2">
                <a href="{{ route('shop.foods.create') }}" class="btn btn-primary">新規投稿</a>
            </div>
        </div>
    </div>
</div>
@endsection