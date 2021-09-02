@extends('layouts.admin')

@section('content')

<h4>Заказы</h4>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12">
        @if(count($orders) > 0)
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                    <tr>
                        <th>Дата заказа</th>
                        <th>Клиент</th>
                        <th>Статус</th>
                        <th class="text-center">Просмотр</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $item)
                        <tr>
                            <td>{{Carbon\Carbon::parse($item->order_date)->format('d.m.Y H:i')}}</td>
                            <td>
                                {{ !empty($item->user->name) ? $item->user->name : 'Без имени' }}
                                {!!  ($item->user->unregistered == 1) ? ' &mdash; <small>Быстрый заказ</small>' : '' !!}
                            </td>
                            <td>
                                @if($item->order_status == 1)
                                    <span style="background:#d81844; padding: 5px; font-size: 12px; color: #fff;">Новый заказ</span>
                                @elseif($item->order_status == 2)
                                    <span style="background:#458bc4; padding: 5px; font-size: 12px; color: #fff;">Обработан</span>
                                @else
                                    <span style="background:#099400; padding: 5px; font-size: 12px; color: #fff;">Доставлен</span>
                                @endif
                            </td>
                            <td class="text-center" width="170">
                                <a href="{{ url('/admin/orders/show/' . $item->id) }}" class="editableIcons" title="Просмотр"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $orders->render() !!}
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
@endsection
