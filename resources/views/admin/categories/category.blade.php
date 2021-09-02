@extends('layouts.admin')

@section('content')

<h4 class="pull-left">{{ ($data['info'] != '') ? $data['info']['title'] : 'Каталог' }}</h4>

@if(!empty($data['child']))
    <a href="/admin/categories/{{ $data['child']['id'] }}/props" class="btn btn-custom btn-bordered pull-right m-l-10"><i class="fa fa-bars"></i>&nbsp;&nbsp;Свойства</a>
    <a href="/admin/products/add/{{ ($data['info'] != '') ? $data['info']['id'] : '0' }}" class="btn btn-custom btn-bordered pull-right m-l-10"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Добавить товара</a>
@else
    <a href="#" class="btn btn-custom btn-bordered pull-right addCat m-l-10" data-id="{{ $data['info']['id'] }}"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Добавить категорию</a>
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
        @if(!empty($data['cats']))
            <div class="table-responsive azimiTable">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>Сортировка</th>
                            <th>Заголовок</th>
                            <th>Алиас</th>
                            <th>Активный</th>
                            <th>ID</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['cats'] as $item)
                            <tr>
                                <td>{{ $item['sort_order'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['slug'] }}</td>
                                <td>
                                    @if($item['is_active'] == 1)
                                        Да
                                    @else
                                        Нет
                                    @endif
                                </td>
                                <td>{{ $item['id'] }}</td>
                                <td class="text-center" width="170">
                                    <a href="{{ url('/admin/categories/' . $item['id']) }}" class="editableIcons" title="Просмотр"><i class="fa fa-bars"></i></a>
                                    <a href="javascript:void(0)" class="editableIcons editCategory" title="Редактировать" data-id="{{ $item['id'] }}" data-parent-id="{{ $data['info']['id'] }}"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/admin/category/delete/' . $item['id']) }}" onclick="return confirm('Удалить?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix m-b-20"></div>
            </div>
        @endif

        @if(!empty($data['child']))
            @if(count($productsList) > 0)
                <div class="table-responsive azimiTable">
                    <table class="table table-hover m-0">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Заголовок</th>
                                <th>Активный</th>
                                <th>ID</th>
                                <th class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($productsList as $item)
                            <tr>
                                <td>
                                    @if(!empty($item->image))
                                        <img style="border: 1px solid #ccc;" src="/public/uploads/products/{{ $item->id }}/thumb_{{ $item->image }}" width="50" alt="">
                                    @else
                                        <img src="/public/uploads/no_image.png" width="50" alt="">
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if($item->is_active == 1)
                                        Да
                                    @else
                                        Нет
                                    @endif
                                </td>
                                <td>{{ $item->id }}</td>
                                <td class="text-center" width="170">
                                    <a href="{{ url('/admin/products/' . $item->id) }}" class="editableIcons" title="Просмотр"><i class="fa fa-search"></i></a>
                                    <a href="{{ url('/admin/products/edit/' . $item->id) }}" class="editableIcons" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/admin/products/delete/' . $item->id) }}" onclick="return confirm('Удалить?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix m-b-20"></div>
                </div>
            @else
                <p>Нет товаров</p>
            @endif
        @endif

    </div>
</div>
@endsection