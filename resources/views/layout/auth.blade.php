<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    　　<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>园丁鸟</title>

    <!--STYLESHEETS-->
    <link rel="stylesheet" href="/css/style.css">
    <link href="/login/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/toastr.min.css">
    <!--SCRIPTS-->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/toastr.min.js"></script>

</head>
<body>

    @include('layout.nav')


    @yield('body')


    @include('layout.footer')

</body>
</html>