<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Вход</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Вход в систему, Азимистрой" name="description" />
    <meta content="Gravity Studio, info@gravity.tj" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/public/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="/public/admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/public/admin_assets/css/metisMenu.min.css" rel="stylesheet">
    <!-- Icons CSS -->
    <link href="/public/admin_assets/css/icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/admin_assets/css/style.css" rel="stylesheet">
    <link href="/public/admin_assets/css/custom.css" rel="stylesheet">

</head>

<body>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper-page">
                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                <a href="/" class="text-success">
                                    <span><img src="/public/images/logo.png" alt=""></span>
                                </a>
                            </h2>
                        </div>
                        <div class="account-content">
                            @include('includes.form-errors')
                            {!! Form::open(['method' => 'POST', 'action' => 'Admin\UsersController@signIn', 'class' => 'form-horizontal']) !!}
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="phone" class="col-form-label text-md-right">Имя пользователь:</label>
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"  autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="password" class="col-form-label text-md-right">Пароль:</label>
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group m-b-30">
                                    <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                            <input id="remember" type="checkbox" name="remember" value="0">
                                            <label for="remember">
                                                Запомнить меня
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn btn-lg btn-primary btn-block loginSub" type="submit">Вход в систему</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- end card-box-->
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>
<!-- END HOME -->

<!-- js placed at the end of the document so the pages load faster -->
<script src="/public/admin_assets/js/jquery-2.1.4.min.js"></script>
<script src="/public/admin_assets/js/bootstrap.min.js"></script>
<script src="/public/admin_assets/js/metisMenu.min.js"></script>
<script src="/public/admin_assets/js/jquery.slimscroll.min.js"></script>

<!-- App Js -->
<script src="/public/admin_assets/js/jquery.app.js"></script>

<script>
    // on click remember me
    $(document).on('change', '#remember', function() {
        if(this.checked) {
            $(this).val(1);
        }
        else{
            $(this).val(0);
        }
    });
</script>

</body>
</html>
