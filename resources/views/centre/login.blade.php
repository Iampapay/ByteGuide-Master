<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>



    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"> -->

    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link href="{{ asset('public/css/login-style.css') }}" rel="stylesheet">

    <style>
        .form-sec>.centre-login {
            background: rgb(161 103 208 / 96%) !important;
            padding: 0 55px 30px 55px;
            border-radius: 20px 20px 20px 20px;
        }
    </style>

</head>

<body>

    <div class="body-wrapper">

        <div class="login-sec">
            <div class="form-sec">

                <div class="centre-login">
                    <a class="logo" href="#" title="STS"><img src="{{ asset('public/img/img_logo.png') }}" alt="STS" style="width: 118px;"></a>
                    <h2 class="title1">login to your account</h2>
                    @if (session()->has('msg'))
                    <div class="alert alert-{{ session('msg')['status'] }}">
                        {!! session('msg')['msgs'] !!}
                    </div>
                    @endif

                    <!-- Bsckend error message dialouge-->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <!-- end -->

                    <form method="post" action="{{ url('centre-login') }}">
                        @csrf
                        <div class="form-group">

                            <input class="form-control user" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required />

                        </div>

                        <div class="form-group">

                            <input class="form-control pass" type="password" name="password" value="" placeholder="Password" required>

                        </div>

                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                        </div>

                        <div class="form-group">

                            <input class="form-control" type="submit" value="login" />

                        </div>

                        <a class="btn btn-link" href="">forgot your password?</a>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="{{ asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>



</body>

</html>