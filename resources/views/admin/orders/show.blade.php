@extends('layouts.admin')

@section('content')
    <h4 class="pull-left">Заказ: {{Carbon\Carbon::parse($order->order_date)->format('d.m.Y H:i')}}</h4>
    <div class="clearfix m-b-20"></div>
    <div class="row">
        {!! Form::model($order, ['method' => 'POST', 'action' => ['Admin\OrdersController@update', $order->id], 'class' => 'form-horizontal']) !!}
        <div class="col-sm-12">
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <tr>
                        <td><strong>Дата заказа</strong></td>
                        <td>{{Carbon\Carbon::parse($order->order_date)->format('d.m.Y H:i')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Статус</strong></td>
                        <td>
                            {!! Form::select('order_status', [  1 => 'Новый заказ (В ожидании)', 2 => 'Обработан', 3 => 'Доставлен' ], $order->order_status, ['class'=>'form-control', 'style' => 'width:250px']); !!}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Клиент</strong></td>
                        <td>
                            {{ !empty($order->user->name) ? $order->user->name : 'Без имени' }}
                            {!!  ($order->user->unregistered == 1) ? ' &mdash; <small>Быстрый заказ</small>' : '' !!}
                            <br>
                            {{ $order->user->phone }}
                            <br>
                            город {{$order->user->city}}, {{$order->user->address}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Сумма заказа</strong></td>
                        <td>{{$order->order_sum}} сом.</td>
                    </tr>
                    <tr>
                        <td><strong>Способ оплаты</strong></td>
                        <td>
                            @if($order->payment_type == 1)
                                Оплата при доставки
                            @else
                                Другой
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Содержание заказа</strong></td>
                        <td>
                            @if(count($order->content) > 0)
                                <table class="table table-bordered table-hover m-0">
                                    <tr>
                                        <td>#</td>
                                        <td>Артикул</td>
                                        <td>Название</td>
                                        <td>Цена</td>
                                        <td>Количество</td>
                                        <td>Всего</td>
                                    </tr>
                                    @php
                                        $sum = 0;
                                    @endphp
                                    @foreach($order->content as $item)
                                        <tr>
                                            <td>
                                                @if(!empty($item->product->image))
                                                    <img src="/public/uploads/products/{{ $item->product->id }}/thumb_{{ $item->product->image }}" alt="{{ $item->product->title }}" width="50">
                                                @else
                                                    <img src="/public/uploads/no_image.png" alt="{{ $item->product->title }}">
                                                @endif
                                            </td>
                                            <td>{{ $item->product->articul }}</td>
                                            <td>{{ $item->product->title }}</td>
                                            <td>
                                                <nobr>{{ $item->price }} сом.</nobr>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><nobr>{{ (float)$item->price * $item->quantity }} сом.</nobr></td>
                                        </tr>
                                        @php
                                            $sum = $sum + ((float)$item->price * $item->quantity);
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="6" align="right">
                                            <strong>Всего:</strong> {{ $sum }} сом.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="right">
                                            <strong>Стоимость доставки:</strong> {{ ($sum >= 1000) ? 'Бесплатно' : '50 сом.' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="right">
                                            <strong>Итого:</strong> {{ ($sum >= 1000) ? $sum : ($sum + 50) }} сом.
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="showSubi">
                <a href="{{ url('admin/orders/')}}" class="btn btn-primary btn-bordered">Все заказы</a>
                {!! Form::submit('Применить', ['class'=>'btn btn-custom btn-bordered']); !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
