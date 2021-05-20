@extends('layouts.user.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table mt-5 ml-3 border-dark">
                <thead>
                    <tr class="text-center">
                        <th class="border-bottom border-dark" style="width:13%;">No</th>
                        <th class="border-bottom border-dark" style="width:18%;">商品名</th>
                        <th class="border-bottom border-dark" style="width:15%;">値段</th>
                        <th class="border-bottom border-dark" style="width:15%;">個数</th>
                        <th class="border-bottom border-dark" style="width:15%;">小計</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($cartData as $key => $data)
                            <tr class="text-center">
                                <th class="align-middle">{{ $key += 1 }}</th>
                                <td class="align-middle">
                                    {{ $data['product_name'] }}
                                </td>
                                <td class="align-middle">
                                    ¥{{ number_format($data['price']) }} 円
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-outline-dark">
                                        {{ $data['session_product_quantity'] }}
                                    </button>
                                    個
                                </td>
                                <td class="align-middle">
                                    ¥{{ number_format($data['session_product_quantity'] * $data['price']) }}
                                </td>
                                <td class="border-0 align-middle">
                                    {!! Form::open(['route' => ['itemRemove', 'method' => 'post', $data['session_products_id']]]) !!}
                                        {{ Form::submit('削除', ['name' => 'delete_products_id', 'class' => 'btn btn-danger']) }}
                                        {{ Form::hidden('product_id', $data['session_product_id']) }}
                                        {{ Form::hidden('product_quantity', $data['session_product_quantity']) }}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                        <tr class="text-center">
                            <th class="border-bottom-0 align-middle"></th>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle"></td>
                            <td class="border-bottom-0 align-middle">合計</td>
                            @php
                                $totalPrice = number_format(array_sum(array_column($cartData, 'itemPrice')))
                            @endphp
                                <td class="border-bottom-0 align-middle">
                                    ¥{{ $totalPrice }}円
                                </td>
                        </tr>


                    <tr class="text-right">
                        <th class="border-0"></th>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0">
                            {!! Form::open(['route' => ['orderFinalize', 'method' => 'post', $data['session_products_id']]]) !!}
                                {{ Form::submit('注文を確定する', ['name' => 'orderFinalize', 'class' => 'btn btn-primary']) }}
                            {!! Form::close() !!}
                        </td>
                        <td class="border-0 align-middle"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection


