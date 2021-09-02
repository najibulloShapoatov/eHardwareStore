@extends('layouts.admin')

@section('content')

<h4 class="pull-left">Свойство: "{{ $data['child']['title'] }}"</h4>

@if(!empty($data['child']))
    <a href="javascript:void(0);" class="btn btn-custom btn-bordered pull-right addPropertyForm m-l-10" data-id="{{ $data['info']['id'] }}"><i class="fa fa-bars"></i>&nbsp;&nbsp;Добавить свойства</a>
@endif

<div class="clearfix m-b-20"></div>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Каталог</a></li>
        @if(!empty($data['parent']))
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $data['parent']['id']) }}">{{ $data['parent']['title'] }}</a></li>
        @endif
        @if(!empty($data['section']))
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $data['section']['id']) }}">{{ $data['section']['title'] }}</a></li>
        @endif
        @if(!empty($data['child']))
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories/' . $data['child']['id']) }}">{{ $data['child']['title'] }}</a></li>
        @endif
    </ol>
</nav>

@include('includes.alert')

<div class="row">
    <div class="col-sm-12">
        @if(!empty($data['child']))
            <div class="table-responsive azimiTable">
                <table class="table table-hover m-0 ">
                    <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Сортировка</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody id="propTable">
                        @if(count($props) > 0)
                            @foreach($props as $item)
                                <tr id="row_{{ $item->id }}">
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sort_order }}</td>
                                    <td class="text-center" width="170">
                                        <a href="javascript:void(0);" class="editableIcons showAttrValues" data-id="{{ $item->id }}" title="Свойства"><i class="fa fa-bars"></i></a>
                                        <a href="javascript:void(0);" class="editableIcons editAttr" data-id="{{ $item->id }}" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" class="editableIcons deleteAttr" data-id="{{ $item->id }}" title="Удалить"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr id="no_props">
                                <td colspan="3">Нет свойств</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="clearfix m-b-20"></div>
            </div>
        @endif
    </div>
</div>
@endsection