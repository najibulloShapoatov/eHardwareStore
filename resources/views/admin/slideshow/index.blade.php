@extends('layouts.admin')

@section('content')

<h4 class="pull-left">Слайдшоу</h4>
<a href="{{URL::to('admin/slideshow/create')}}" class="btn btn-custom btn-bordered pull-right"><i class="fa fa-plus-circle"></i> Добавить</a>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12">
        @if(count($slides) > 0)
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата</th>
                        <th>Заголовок</th>
                        <th>Активность</th>
                        <th class="text-center">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slides as $item)
                        <tr>
                            <th scope="row">
                                @if(!empty($item->image))
                                    <img style="border: 1px solid #ccc;" src="/public/uploads/slideshow/{{ $item->image }}" width="150" alt="">
                                @else
                                    <img style="border: 1px solid #ccc;" src="/public/uploads/no_image.png" width="150" alt="">
                                @endif
                            </th>
                            <td>{{Carbon\Carbon::parse($item->date_add)->format('d.m.Y')}}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if($item->is_active == 1)
                                    Да
                                @else
                                    Нет
                                @endif
                            </td>
                            <td class="text-center" width="170">
                                <a href="{{ url('/admin/slideshow/show/' . $item->id) }}" class="editableIcons" title="Просмотр"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/slideshow/edit/' . $item->id) }}" class="editableIcons" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('/admin/slideshow/delete/' . $item->id) }}" onclick="return confirm('Вы уверены?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $slides->render() !!}
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
@endsection
