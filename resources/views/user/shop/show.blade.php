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
            <form action="{{ route('user.reservations', ['shop' => $shopFood['shop_id'], 'food' => $shopFood['id']]) }}" method="POST">
            {{-- <form action="{{ route('user.reservations', $shopFood->id) }}" method="POST">
            <form action="{{ route('user.reservations', $shopFood->shop_id) }}" method="POST"> --}}
                @csrf
                <div class="modal" id="{{  $shopFood->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                <div class="spinner_area">
                                    <input type="button" value="－" class="btnspinner" data-cal="-1" data-target=".counter1" >
                                    <input type="hidden" value="1" class="counter1" data-max="300" data-min="1" name="quantity">
                                    <input type="text" value="1" class="counter1" data-max="300" data-min="1" name="quantity" disabled>
                                    <input type="button" value="＋" class="btnspinner" data-cal="1" data-target=".counter1" >
                                </div>
                                <div class="spacer"></div>
                                <button type="submit" class="btn btn-primary">
                                    <div class=btn-text>Add
                                        <input type="text" value="1" class="counter1 count" disabled>
                                        to order</div>
                                    <div class="price">
                                        ￥{{ $shopFood->price }}
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
    <script>
        $('#{{  $shopFood->id  }}').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
            var recipient = button.data('whatever') //data-whatever の値を取得

            var modal = $(this)  //モーダルを取得
            modal.find('.modal-title').text(recipient) //モーダルのタイトルに値を表示
            modal.find('.modal-body input#recipient-name').val(recipient) //inputタグにも表示
        })
    </script>
    {{-- <script>

            // オブジェクトと変数の準備
            var count_disp = document.getElementById("disp_count");
            var count_up_btn = document.getElementById("up_btn");
            var count_down_btn = document.getElementById("down_btn");
            var count_value = 1;

            // カウントアップボタンクリック処理
            count_up_btn.onclick = function (){
                count_value ++;
                count_disp.innerHTML = count_value;
            };
            // カウントダウンボタンクリック処理
            count_down_btn.onclick = function (){
                count_value --;
                count_disp.innerHTML = count_value;
            };

    </script> --}}
    <script>


        $(function(){

            var arySpinnerCtrl = [];
            var spin_speed = 20; //変動スピード

            //長押し押下時
            $('.btnspinner').on('touchstart mousedown click', function(e){
                if(arySpinnerCtrl['interval']) return false;
                var target = $(this).data('target');
                arySpinnerCtrl['target'] = target;
                arySpinnerCtrl['timestamp'] = e.timeStamp;
                arySpinnerCtrl['cal'] = Number($(this).data('cal'));
                //クリックは単一の処理に留める
                if(e.type == 'click'){
                    spinnerCal();
                    arySpinnerCtrl = [];
                    return false;
                }
                //長押し時の処理
                setTimeout(function(){
                    //インターバル未実行中 + 長押しのイベントタイプスタンプ一致時に計算処理
                    if(!arySpinnerCtrl['interval'] && arySpinnerCtrl['timestamp'] == e.timeStamp){
                        arySpinnerCtrl['interval'] = setInterval(spinnerCal, spin_speed);
                    }
                }, 500);
            });

            //長押し解除時 画面スクロールも解除に含む
            $(document).on('touchend mouseup scroll', function(e){
                if(arySpinnerCtrl['interval']){
                    clearInterval(arySpinnerCtrl['interval']);
                    arySpinnerCtrl = [];
                }
            });

            //変動計算関数
            function spinnerCal(){
                var target = $(arySpinnerCtrl['target']);
                var num = Number(target.val());
                num = num + arySpinnerCtrl['cal'];
                if(num > Number(target.data('max'))){
                    target.val(Number(target.data('max')));
                }else if(Number(target.data('min')) > num){
                    target.val(Number(target.data('min')));
                }else{
                    target.val(num);
                }
            }

        });
    </script>
</div>

@endsection
