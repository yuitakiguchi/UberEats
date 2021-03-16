@extends('layouts.shop.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('shop.foods.update', $food->id) }}" method="POST">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <button type="submit" class="btn btn-primary">編集</button>
                <div class="form-group">
                    <input type="text" class="form-control-plaintext" placeholder="商品名" name="name" value="{{ $food->name }}">
                </div>
                <div class="form-group">
                    <label>詳細(任意)</label>
                    <textarea class="form-control" placeholder="詳細を入力" rows="5" name="description">{{ $food->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>この商品の調理時間</label>
                        <div class="input-group has-validation">
                            <input class="form-control" rows="5" name="cooking_time" value="{{ $food->cooking_time }}">
                            <span class="input-group-text" id="inputGroupPrepend">分</span>
                        </div>
                </div>
                {{-- <div class="form-group">
                    <label>商品を単独で販売しますか？</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                        はい
                    </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                        いいえ
                        </label>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                    <label>カテゴリ</label>
                        <input type="checkbox" name="category" id="category1" value="1"><label for="category1">焼肉</label>
                        <input type="checkbox" name="category" id="category2" value="2"><label for="category2">ラーメン</label>
                        <input type="checkbox" name="category" id="category3" value="3"><label for="category3">フレッシュサラダ</label>
                        <input type="checkbox" name="category" id="category4" value="4"><label for="category4">100%オレンジジュース</label>
                    <p>この商品を既存のカテゴリに割り当てます</p>
                </div> --}}
                <h3>注文タイプと料金</h3>
                <h4>配達</h4>
                <div class="form-group">
                    <label>既定の価格</label>
                        <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">￥</span>
                        <input class="form-control" placeholder="設定しない" rows="5" name="price" value="{{ $food->price }}">
                        </div>
                    <p>メニュー固有の料金設定を追加する</p>
                </div>
                <div class="form-group">
                    <label>VAT</label>
                    <div class="input-group has-validation">
                        <input class="form-control" rows="5" name="tax_rate" value="{{ $food->tax_rate }}">
                        <span class="input-group-text" id="inputGroupPrepend">%</span>
                    </div>
                    {{-- 税率、テイクアウトと同様で料理系は8% --}}
                </div>
                {{-- <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            商品が売り切れになった場合
                        </label>
                        ＊仮でチェックボタンにしたけど後でSwitchesに変える
                    </div>
                </div> --}}

                {{-- <div class="form-group">
                    <label>この商品はどのような温度で提供されますか？</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formRadioDefault" id="formRadioDefault1" checked>
                        <label class="form-check-label" for="formRadioDefault1">
                        温めた状態
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formRadioDefault" id="formRadioDefault2">
                        <label class="form-check-label" for="formRadioDefault2">
                        温めていない状態
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formRadioDefault" id="formRadioDefault3">
                        <label class="form-check-label" for="formRadioDefault3">
                        冷めた状態
                        </label>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                    <label>商品をカスタマイズする</label>
                    <p>カスタマイズグループを選択すると、お客様がトッピングやサイドメニューなどを
                        選んで商品をカスタマイズできるようになります。
                    </p>
                </div> --}}
                {{-- <h3>アルコール飲料に関する設定</h3> --}}
                <div class="form-group">
                    {{-- <label>この商品はアルコールが含まれていますか？</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
                        <label class="form-check-label" for="flexRadioDefault3">
                        はい
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                        いいえ
                        </label>
                    </div> --}}
                    {{-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate2">
                        <label class="form-check-label" for="flexCheckIndeterminate2">
                            この商品は、法的に食事とみなすことができます
                        </label>
                    </div> --}}
                </div>
                {{-- <div class="form-group">
                    <label>エネルギー価</label>
                    <input type="text" class="form-control-plaintext" placeholder="この商品のエネルギー量(カロリーとキロジュール)の情報を追加します。" name="energy">
                </div> --}}
                {{-- <div class="form-group">
                    <label>その他の詳細</label>
                    <input type="text" class="form-control-plaintext" placeholder="外部IDや、その他の商品データを編集します。" name="other_details">
                </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection
