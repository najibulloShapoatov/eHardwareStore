@extends('layouts.admin')

@section('content')
    <h4 class="pull-left">Пользователь: "{{$data->name}}"</h4>
    <div class="clearfix m-b-20"></div>
    <div class="row">
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table table-hover m-0 azimiAdminTable">
                    <tr>
                        <td>&nbsp;</td>
                        <td><img src="/public/uploads/users/{{ ($data->image != '') ? $data->image : 'no_image.jpg' }}" alt="" class="thumb-md img-circle" width="100"></td>
                    </tr>
                    <tr>
                        <td><strong>Номер телефона</strong></td>
                        <td>{{$data->phone}}</td>
                    </tr>
                    <tr>
                        <td><strong>Имя</strong></td>
                        <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Фамилия</strong></td>
                        <td>{{$data->surname}}</td>
                    </tr>
                    <tr>
                        <td><strong>Эл. почта</strong></td>
                        <td>{{$data->email}}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата последней авторизации</strong></td>
                        <td>{{ ($data->date_auth != '') ? date('d.m.Y H:i', strtotime($data->date_auth)) : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Дата регистрации</strong></td>
                        <td>{{ ($data->date_reg != '') ? date('d.m.Y H:i', strtotime($data->date_reg)) : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Active</strong></td>
                        <td>
                            @if($data->is_active == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="showSubi">
                <a href="{{URL::to('admin/users/')}}" class="btn btn-primary btn-bordered"><i class="fa fa-user"></i>&nbsp;&nbsp;Все пользователи</a>
                <a href="{{ url('/admin/users/edit/' . $data->id) }}" class="btn btn-primary btn-bordered" title="Редактировать"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Редактировать</a>
                <a href="{{ url('/admin/users/delete/' . $data->id) }}" onclick="return confirm('Удалить?');" class="btn btn-primary btn-bordered" title="Удалить"><i class="fa fa-trash"></i>&nbsp;&nbsp;Удалить</a>
            </div>
        </div>
    </div>
@endsection
