@extends('layouts.admin')

@section('content')

<h4 class="pull-left">Бренды</h4>
<a href="#" class="btn btn-custom btn-bordered pull-right addBrand"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Добавить бренд</a>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12">
        @if(count($brands) > 0)
            <div class="table-responsive">
                <table class="table table-hover m-0 azimiTable">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Заголовок</th>
                            <th>Дата</th>
                            <th>Активный</th>
                            <th>ID</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $item)
                            <tr>
                                <td>
                                    @if(!empty($item['image']))
                                        <img style="border: 1px solid #ccc;" src="/public/uploads/brands/{{ $item['image'] }}" width="50" alt="">
                                    @else
                                        <img src="/public/uploads/no_image.png" width="50" alt="">
                                    @endif
                                </td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ date('d.m.Y', strtotime($item['date_add'])) }}</td>
                                <td>
                                    @if($item['is_active'] == 1)
                                        Да
                                    @else
                                        Нет
                                    @endif
                                </td>
                                <td>{{ $item['id'] }}</td>
                                <td class="text-center" width="170">
                                    <a href="javascript:void(0)" class="editableIcons editBrand" title="Редактировать" data-id="{{ $item['id'] }}"  data-parent-id=""><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/admin/brands/delete/' . $item['id']) }}" onclick="return confirm('Удалить?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
@endsection