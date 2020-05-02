<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Reset Password') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"/> 
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/main.min.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            /*background-image: url('assets/img/blog/17.jpg');*/
        }

        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(138, 136, 152, 0.18);
        }

        .login-content {
            max-width: 400px;
            margin: 100px auto 50px;
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="cover"></div>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><i class="la la-key"></i></span>
        </div>
        <form class="ibox-body" id="login-form" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <h4 class="font-strong text-center mb-5">{{ __('RESET PASSWORD') }}</h4>
            <div class="form-group mb-4">
                <input class="form-control form-control-line @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" readonly="readonly" >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <input class="form-control form-control-line @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="New Password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <input class="form-control form-control-line" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            </div>
            <div class="text-center mb-4">
                <button class="btn  btn-primary btn-rounded btn-block" type="submit">{{ __('SUBMIT') }}</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <!--<div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>-->
    <!-- CORE PLUGINS-->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/js/app.min.js')}}"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>
</html>