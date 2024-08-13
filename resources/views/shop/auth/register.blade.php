<!DOCTYPE html>
<html>

<head>
    <title>Register | NPC-Shop</title>
    <!-- custom-theme -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- //custom-theme  -->
    <link rel="stylesheet" href="{{ asset('shops/auth/web/css/style.css') }}">
    <!-- font-awesome icons -->
    <link href="{{ asset('shop/auth/web/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
</head>

<body>
    <div class="login-form w3_form">
        <!--  Title-->
        <div class="login-title w3_title">
            <h1>NPC-SHOP</h1>
        </div>
        <div class="login w3_login">
            <h2 class="login-header w3_header">Register</h2>
            <div class="w3l_grid">

                <form class="login-container" action="{{ route('userRegister') }}" method="post">

                    @csrf

                    <input type="text" placeholder="Nhập tên" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror

                    <input type="email" placeholder="Nhập email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror

                    <input type="password" placeholder="Nhập password" name="password" required>
                    @error('password')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror

                    <input type="password" placeholder="Nhập lại password" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror

                    <input type="text" placeholder="Nhập số điện thoại" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror

                    <input type="text" placeholder="Nhập địa chỉ" name="address" value="{{ old('address') }}">
                    @error('address')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Submit">

                </form>
                <div class="bottom-text w3_bottom_text">
                    <a href="{{ route('customer.login') }}">Quay lại đăng nhập</a>
                </div>

                @if ($errors->has('error'))
                <div style="color: red;">
                    {{ $errors->first('error') }}
                </div>
                @endif

                @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
                @endif
            </div>
        </div>

    </div>



</body>

</html>