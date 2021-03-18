@extends('layouts.shop.app')
@section('content')

<div class="container">
    <h1>ユーザー登録情報</h1>
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="card text-center py-5">
                    <h2>※入力情報は商品ページ等に掲載されます。</h2>
                    {{-- <div class="card-image form-group mx-auto my-5">
                        <label for="exampleFormControlFile1"></label>
                        <input type="file" class="form-control-file" id="image-name" name="image-name" value="画像を変更する">
                    </div> --}}

                    <div class="row justify-content-center text-center">
                        <div class="card-name col-md-8">
                            <label for="name" class="col-md-4 col-form-label">店舗名</label>
                            <input type="text" name="name" value="{{ $shop->name }}">
                        </div>

                        <div class="card-phone-number col-md-8">
                            <label for="phone-number" class="col-md-4 col-form-label">電話番号</label>
                            <input type="text" name="phone_number" value="{{ $shop->phone_number }}">
                        </div>

                        <div class="card-email col-md-8">
                            <label for="email" class="col-md-4 col-form-label">メールアドレス</label>
                            <input type="text" name="email" value="{{ $shop->email }}">
                        </div>

                        <div class="card-address col-md-8">
                            <label for="address" class="col-md-4 col-form-label">住所</label>
                            <input type="text" name="address" value="{{ $shop->address }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
