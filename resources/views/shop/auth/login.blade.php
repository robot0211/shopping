<!DOCTYPE html>
<html>

<head>
    <title>Login | NPC-Shop</title>
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
            <h2 class="login-header w3_header">Log in</h2>
            <div class="w3l_grid">
                <form class="login-container" action="{{ route('customer.login') }}" method="post">
                    @csrf
                    <input type="email" placeholder="Email" name="email" required="">
                    <input type="password" placeholder="Password" name="password" required="">
                    <input type="submit" value="Submit">
                </form>
                @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger" style="color: red;">
                    {{ session('error') }}
                </div>
                @endif
                <div class="second-section w3_section">
                    <div class="bottom-header w3_bottom">
                        <h3>OR</h3>
                    </div>
                    <div class="social-links w3_social">
                        <ul>
                            <!-- facebook -->
                            <li> <a class="facebook" href="#" target="blank"><i class="fab fa-facebook"></i></a></li>

                            <!-- twitter -->
                            <li> <a class="twitter" href="#" target="blank"><i class="fab fa-twitter"></i></a></li>

                            <!-- google plus -->
                            <li> <a class="googleplus" href="#" target="blank"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="bottom-text w3_bottom_text">
                    <p>No account yet?<a href="{{ route('customer.register') }}">Signup</a></p>
                    <h4> <a href="#">Forgot your password?</a></h4>
                    <h4> <a href="{{ route('home') }}">Home</a></h4>
                </div>

            </div>
        </div>

    </div>



</body>

</html>