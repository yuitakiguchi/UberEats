@extends('layouts.user.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @foreach ($shopFoods as $shopFood)
            {{-- <a href="{{ route('user.foods.show',['shop' => $shopFood->shop_id, 'food' => $shopFood->id]) }}"> --}}
            {{-- <a href="{{ action('User\FoodController@show', ['shop' => $shopFood->shop_id, 'food' => $shopFood->id]) }}"> --}}
                <div data-toggle="modal" data-target="#{{  $shopFood->id  }}" data-whatever="{{ $shopFood->name }}">
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
            <div class="modal fade" id="{{  $shopFood->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                            <div>
                                Special Instructions
                            </div>
                            <div>
                                <span>アレルゲン情報などに関するお問い合わせは店舗に直接ご連絡いただけます: 店舗の電話番号：[{{ $shop->phone_number }}]。
                                    注意：今回のご注文に関するお問い合わせはこちらの店舗番号ではなく、Uber Eats サポートまでご連絡ください。</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Add 1 to order ￥{{ $shopFood->price }} </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $('#{{  $shopFood->id  }}').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
            var recipient = button.data('whatever') //data-whatever の値を取得

            //Ajaxの処理はここに

            var modal = $(this)  //モーダルを取得
            modal.find('.modal-title').text(recipient) //モーダルのタイトルに値を表示
            modal.find('.modal-body input#recipient-name').val(recipient) //inputタグにも表示
        })
    </script>
</div>

@endsection
