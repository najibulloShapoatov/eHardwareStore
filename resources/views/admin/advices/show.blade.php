@extends('layouts.admin')

@section('content')
    <h4 class="pull-left">{{$advice->title}}</h4>
    <div class="clearfix m-b-20"></div>
    <div class="row">
        <div class="col-sm-12 azimiAdminTable">
            <div class="table-responsive">
                <table class="table table-bordered table-hover m-0">
                    <tr>
                        <td width="200"><strong>ID</strong></td>
                        <td>{{$advice->id}}</td>
                    </tr>
                    <tr>
                        <td><strong>Категория</strong></td>
                        <td>{{$advice->category->title}}</td>
                    </tr>
                    <tr>
                        <td><strong>Тип совета</strong></td>
                        <td>{{$advice->type->title}}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата начало активности</strong></td>
                        <td>{{Carbon\Carbon::parse($advice->date_add)->format('d.m.Y')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата окончания активности</strong></td>
                        <td>{{Carbon\Carbon::parse($advice->date_end)->format('d.m.Y')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Заголовок</strong></td>
                        <td>{{ $advice->title }}</td>
                    </tr>
                    <tr>
                        <td><strong>Алиас</strong></td>
                        <td>{{$advice->slug}}</td>
                    </tr>
                    <tr>
                        <td><strong>Текст аннонса</strong></td>
                        <td>{!! $advice->preview_text !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Описание</strong></td>
                        <td>{!! $advice->description !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Картинка</strong></td>
                        <td>
                            @if(!empty($advice->image))
                                <img style="border: 1px solid #ccc;" src="/public/uploads/advices/{{ $advice->image }}" width="150" alt="">
                            @else
                                No image
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Активный</strong></td>
                        <td>
                            @if($advice->is_active == 1)
                                Да
                            @else
                                Нет
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="showSubi">
                <a href="{{ url('admin/advices/')}}" class="btn btn-primary btn-bordered"><i class="fa fa-list"></i> Все советы</a>
                <a href="{{ url('/admin/advices/edit/' . $advice->id) }}" class="btn btn-primary btn-bordered" title="Редактировать"><i class="fa fa-pencil"></i> Редактировать</a>
                <a href="{{ url('/admin/advices/delete/' . $advice->id) }}" onclick="return confirm('Вы уверены?');" class="btn btn-primary btn-bordered" title="Удалить"><i class="fa fa-trash"></i> Удалить</a>
            </div>
        </div>
    </div>
@endsection
