<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shop | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    {!! HTML::style('public/backend/bootstrap/css/bootstrap.min.css') !!}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    {!! HTML::style('public/backend/plugins/ionicons/2.0.1/css/ionicons.min.css') !!}
    <!-- Theme style -->
    {!! HTML::style('public/backend/dist/css/AdminLTE.min.css') !!}
    <!-- iCheck -->
    {!! HTML::style('public/backend/plugins/iCheck/square/blue.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! HTML::script('public/backend/plugins/html5shiv/3.7.3/html5shiv.min.js') !!}
    {!! HTML::script('public/backend/plugins/respond/1.4.2/respond.min.js') !!}
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        {!! HTML::decode('<b>Shop</b>') !!}
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Đăng nhập hệ thống quản trị</p>
        @if(session()->has('error'))
            <p class="login-box-msg" style="color:red">{!! Session::get('error') !!}</p>
        @endif
        {!! Form::open(['url' => route('admin.login.postLogin'), 'method' => 'POST']) !!}
        <div class="form-group has-feedback">
            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Tài khoản', 'required' => 'required']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu', 'required' => 'required']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('remember', 1, null, []) !!} Ghi nhớ đăng nhập
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit('Đăng nhập', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']) !!}
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}
        <div class="social-auth-links text-center">
        </div>
        <!-- /.social-auth-links -->
        <a href="#">Quên mật khẩu</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
{!! HTML::script('public/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}
        <!-- Bootstrap 3.3.5 -->
{!! HTML::script('public/backend/bootstrap/js/bootstrap.min.js') !!}
        <!-- iCheck -->
{!! HTML::script('public/backend/plugins/iCheck/icheck.min.js') !!}

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>