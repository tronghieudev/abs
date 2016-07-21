<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from htmldemo.magikcommerce.com/ecommerce/aspire-html-template/home1/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Mar 2016 09:52:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons Icon -->
    <link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>Aspire premium HTML5 &amp; CSS3 template</title>

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    @section('header')
        @include('public.includes.header')
    @show
</head>

<body class="cms-index-index cms-home-page">
<div id="page"> 
  <!-- Header -->
    @section('content-header')
        @include('public.includes.content-header')
    @show
  <!-- end header --> 
  
  <!-- Navigation -->
  
    @section('nav')
        @include('public.includes.nav')
    @show
  <!-- end nav --> 
  
  <!-- features box -->
    
    @yield('content')
    
  <!-- End Latest Blog --> 
  
  <!-- Footer -->
    @section('footer')
        @include('public.includes.footer')
    @show
  <!-- End Footer --> 
</div>

<!-- mobile menu -->

@section('mobile-menu')
    @include('public.includes.mobile-menu')
@show

@section('script')
    @include('public.includes.script')
@show
<!-- JavaScript -->       
</body>
    
<!-- Mirrored from htmldemo.magikcommerce.com/ecommerce/aspire-html-template/home1/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Mar 2016 09:55:41 GMT -->
</html>