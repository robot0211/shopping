<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang web thời trang hàng đầu với những xu hướng mới nhất và sản phẩm chất lượng cao.">
    <meta name="author" content="Nguyễn Tấn Phát">
    <meta name="keywords" content="thời trang, xu hướng, quần áo, phụ kiện, mua sắm, phong cách">
    @yield('title')
    <link href="{{ asset('publicShop/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('publicShop/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('publicShop/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('publicShop/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('publicShop/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('publicShop/css/main.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>

    @include('shopPartials.header')

    @yield('content')

    @include('shopPartials.footer')

    <script src="{{ asset('publicShop/js/jquery.js') }}"></script>
    <script src="{{ asset('publicShop/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('publicShop/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('publicShop/js/price-range.js') }}"></script>
    <script src="{{ asset('publicShop/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('publicShop/js/main.js') }}"></script>
    @yield('js')
</body>

</html>