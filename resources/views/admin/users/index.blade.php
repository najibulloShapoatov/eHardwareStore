@extends('layouts.admin')

@section('content')

<h4 class="pull-left">Пользователи</h4>
<a href="{{ url('admin/users/create')}}" class="btn btn-custom btn-bordered pull-right"><i class="fa fa-plus-circle"></i> Добавить</a>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12">
        @if(count($users) > 0)
            <div class="table-responsive azimiAdminTable">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Имя</th>
                            <th>Номер телефона</th>
                            <th>Роль</th>
                            <th>Активный</th>
                            <th>ID</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">
                                <img src="/public/uploads/users/{{ ($user->image != '') ? $user->image : 'no_image.jpg' }}" alt="" class="thumb-md img-circle" width="50">
                            </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if($user->user_type == 7)
                                    Администратор
                                @elseif($user->user_type == 2)
                                    Контент-менеджер
                                @elseif($user->user_type == 1)
                                    Клиент
                                @endif
                            </td>
                            <td>
                                @if($user->is_active == 1)
                                    Да
                                @else
                                    Нет
                                @endif
                            </td>
                            <td>{{ $user->id }}</td>
                            <td class="text-center" width="170">
                                <a href="{{ url('/admin/users/show/' . $user->id) }}" class="editableIcons" title="Просмотр"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/users/edit/' . $user->id) }}" class="editableIcons" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('/admin/users/delete/' . $user->id) }}" onclick="return confirm('Удалить?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
@endsection
