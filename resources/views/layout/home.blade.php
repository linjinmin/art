<!DOCTYPE html>
<html>
<head>
    <title>园丁鸟</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>

    <link rel="icon" href="/images/logo.png" type="image/png">
    <meta name="_token" content="{{ csrf_token() }}"/>
    @yield("header")

</head>
<body>
@include('layout.nav')

@yield('body')



@yield('footer')



</body>
</html>