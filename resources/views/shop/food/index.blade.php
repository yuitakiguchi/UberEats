@extends('layouts.shop.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-2">
                <a href="{{ route('shop.foods.create') }}" class="btn btn-primary">＋新しい商品</a>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    投稿商品一覧（shop）
                </div>
                @foreach ($foods as $food)
                <div class="card-body">
                    <h5 class="card-title">商品名：{{ $food->name }}</h5>
                    <p class="card-text">内容：{{ $food->description }}</p>
                    <p class="card-text">金額：{{ $food->price }}</p>
                    <form class="dropdown-item" action='{{ route('shop.foods.destroy', $food->id) }}' method='post'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type='submit' value='削除' class="delete" onclick='return confirm("削除しますか？？");'>
                    </form>
                    <a href="{{ route('shop.foods.edit', $food->id) }}" class="btn btn-primary">編集</a>
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
        </div>
    </div>
</div>
@endsection
