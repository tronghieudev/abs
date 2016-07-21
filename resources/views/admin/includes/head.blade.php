<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    {!!HTML::style('public/backend/bootstrap/css/bootstrap.min.css')!!}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <!--<link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
    @section('extra-style')

    @show
    {!!HTML::style('public/backend/dist/css/AdminLTE.min.css')!!}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> -->
    {!!HTML::style('public/backend/dist/css/skins/_all-skins.min.css')!!}
    <!-- iCheck -->

    {!!HTML::script('public/backend/ckeditor/ckeditor.js')!!}
    {!!HTML::script('public/backend/ckfinder/ckfinder.js')!!}
    <script type="text/javascript">
        var baseURL = "{!!url('/')!!}";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->