<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Панель управления</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Gravity Studio, info@gravity.tj" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/public/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="/public/admin_assets/plugins/morris/morris.css">

    <link href="/public/admin_assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="/public/admin_assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="/public/admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/public/admin_assets/css/metisMenu.min.css" rel="stylesheet">
    <!-- Icons CSS -->
    <link href="/public/admin_assets/css/icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/admin_assets/css/style.css" rel="stylesheet">
    <link href="/public/admin_assets/css/custom.css" rel="stylesheet">

    @yield('styles')

</head>

<body>

<div id="page-wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="">
                <a href="/admin" class="logo">
                    <img src="/public/images/logo.png" alt="logo" class="logo-lg" />
                </a>
            </div>
        </div>

        <!-- Top navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">

                    <!-- Mobile menu button -->
                    <div class="pull-left">
                        <button type="button" class="button-menu-mobile visible-xs visible-sm">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true">
                                <img src="/public/uploads/users/{{ ($userInfo->image != '') ? $userInfo->image : 'no_image.jpg' }}" alt="user-img" class="img-circle">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/" target="_blank"><i class="fa fa-globe m-r-10"></i> Сайт</a></li>
                                <li><a href="{{ url('/admin/users/profile') }}"><i class="fa fa-user m-r-10"></i> Мой профиль</a></li>
                                <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-power-off m-r-10"></i> Выход</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="pull-right">
                        <div style="padding: 15px 0 0 0;" >
                            <a href="{{ url('/admin/users/profile') }}" class="menu-right-item">{{ $userInfo->name }} {{ $userInfo->surname }}</a>
                        </div>
                    </div>

                </div>
            </div> <!-- end container -->
        </div> <!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- Page content start -->
    <div class="page-contentbar">

        <!--left navigation start-->
        <aside class="sidebar-navigation">
            <div class="scrollbar-wrapper">
                <div>
                    <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                        <i class="mdi mdi-close"></i>
                    </button>

                    <!-- User Detail box -->
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="/public/uploads/users/{{ ($userInfo->image != '') ? $userInfo->image : 'no_image.jpg' }}" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <a href="/admin/users/profile">{{ $userInfo->name }}</a>
                            <p class="text-muted m-0">
                                @if($userInfo->user_type == 7)
                                    Администратор
                                @elseif($userInfo->user_type == 2)
                                    Контент-менеджер
                                @endif
                            </p>
                        </div>
                    </div>
                    <!--- End User Detail box -->

                    <!-- Left Menu Start -->
                    <ul class="metisMenu nav" id="side-menu">
                        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Панель управления </a></li>
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-folder"></i> Каталог <span class="fa arrow"></span></a>
                            <ul class="azimiMenu">
                                @if(!empty($categories))
                                    <li style="padding: 0;">
                                        <a href="{{ url('/admin/categories') }}">Все категории</a>
                                    </li>
                                    @foreach($categories as $item)
                                        <li>
                                            <span class="caretSub caret_{{ $item['id'] }}" data-id="{{ $item['id'] }}" data-sts="0">
                                                <i class="fa fa-caret-right"></i>
                                            </span>
                                            <a href="{{ url('/admin/categories/' . $item['id']) }}">
                                                {{ $item['title'] }}
                                            </a>
                                            <div class="clearfix"></div>
                                            @if(!empty($item['child']))
                                                <div class="childMenu childMenu_{{ $item['id'] }}">
                                                    @foreach($item['child'] as $sub)
                                                        <span class="caretSub caret_{{ $sub['id'] }}" data-id="{{ $sub['id'] }}" data-sts="0">
                                                            <i class="fa fa-caret-right"></i>
                                                        </span>
                                                        <a href="{{ url('/admin/categories/' . $sub['id']) }}">
                                                            {{ $sub['title'] }}
                                                        </a>
                                                        <div class="clearfix"></div>
                                                        @if(!empty($sub['child']))
                                                            <div class="childMenu childMenu_{{ $sub['id'] }}" style="display: none;">
                                                                @foreach($sub['child'] as $subsub)
                                                                    <p>
                                                                        <a href="{{ url('/admin/categories/' . $subsub['id']) }}">
                                                                            &mdash; {{ $subsub['title'] }}
                                                                        </a>
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li><a href="{{ url('/admin/brands') }}"><i class="fa fa-bookmark-o"></i> Бренды </a></li>

                        {{--<li>
                            <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-shopping-cart"></i> Магазин <span class="fa arrow"></span></a>
                            <ul class="nav-second-level nav" aria-expanded="true">
                                <li><a href="{{ url('/admin/categories') }}">Категории</a></li>
                                <li><a href="{{ url('/admin/products') }}">Товары</a></li>
                                <li><a href="{{ url('/admin/customers') }}">Клиенты</a></li>
                                <li><a href="{{ url('/admin/brands') }}">Марки</a></li>
                                <li><a href="{{ url('/admin/manufactures') }}">Производители</a></li>
                                <li><a href="{{ url('/admin/orders') }}">Заказы</a></li>
                                <li><a href="{{ url('/admin/reviews') }}">Отзывы</a></li>
                            </ul>
                        </li>--}}

                        <li>
                            <a href="{{ url('/admin/orders') }}">
                                <span class="label label-custom pull-right">{{ $ordersCount }}</span>
                                <i class="fa fa-shopping-basket"></i> Заказы
                            </a>
                        </li>
                        <li><a href="{{ url('/admin/advices') }}"><i class="fa fa-newspaper-o"></i> Советы </a></li>
                        <li><a href="{{ url('/admin/reviews') }}"><i class="fa fa-star"></i> Отзывы </a></li>
                        {{--<li><a href="{{ url('/admin/banners') }}"><i class="fa fa-image"></i> Баннеры </a></li>--}}
                        <li><a href="{{ url('/admin/slideshow') }}"><i class="fa fa-image"></i> Слайдшоу </a></li>
                        {{--<li><a href="{{ url('/admin/services') }}"><i class="fa fa-bullhorn"></i> Услуги </a></li>--}}
                        <li><a href="{{ url('/admin/users') }}"><i class="fa fa-users"></i> Пользователи </a></li>
                        <li><a href="{{ url('/admin/config') }}"><i class="fa fa-cogs"></i> Конфигурации </a></li>
                        <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out"></i> Выход </a></li>
                    </ul>
                </div>
            </div><!--Scrollbar wrapper-->
        </aside>
        <!--left navigation end-->

        <!-- START PAGE CONTENT -->
        <div id="page-right-content">

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                </div>
                <!--end row -->

            </div>
            <!-- end container -->

        </div>
        <!-- End #page-right-content -->

    </div>
    <!-- end .page-contentbar -->
</div>
<!-- End #page-wrapper -->

<div id="custom-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary waves-effect waves-light customSubmit"></button>
            </div>
        </div>
    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/public/admin_assets/js/jquery-2.1.4.min.js"></script>
<script src="/public/admin_assets/js/bootstrap.min.js"></script>
<script src="/public/admin_assets/js/metisMenu.min.js"></script>
<script src="/public/admin_assets/js/jquery.slimscroll.min.js"></script>

<script src="/public/admin_assets/plugins/select2/js/select2.min.js"></script>
<script src="/public/admin_assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- App Js -->
<script src="/public/admin_assets/js/jquery.app.js"></script>
<script src="/public/admin_assets/js/custom.js"></script>

@yield('scripts')

</body>
</html>
