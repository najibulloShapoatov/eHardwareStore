@extends('layouts.site')
@section('title', '404')
@section('description', '404')

@section('content')

<div class="site__body">
    <div class="block">
        <div class="container">
            <div class="not-found">
                <div class="not-found__404">Упс! Что-то пошло не так</div>
                <div class="not-found__content">
                    <h1 class="not-found__title">Ошибка 404: Страница не найдена</h1>
                    <p class="not-found__text">Упс! Мы не можем найти страницу, которую вы ищете.
                        <br>Попробуйте воспользуйтесь поиском.</p>
                    <form class="not-found__search">
                        <input type="text" class="not-found__search-input form-control" placeholder="Поиск ...">
                        <button type="submit" class="not-found__search-button btn btn-primary">Искать</button>
                    </form>
                    <p class="not-found__text">или перейдите на главную страницу.</p><a class="btn btn-secondary btn-sm" href="{{ url('/') }}">Главная страница</a></div>
            </div>
        </div>
    </div>
</div>

@endsection
