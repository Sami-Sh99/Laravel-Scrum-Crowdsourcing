<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- 3rd Party Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome-style.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div id="app">


        <header id="header" class="fixed-top">
            <div>

                <div class="float-left">
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
                    <a href="/"><img style="width:50px;height:50px;margin-left:15px" src="/img/logo.png" alt=""></a>
                </div>

                <nav class="main-nav float-right">
                    <ul style="margin-right:20px">
                        @if (Route::has('login'))

                        @if (Auth::check())
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        @endif

                        @endif
                    </ul>
                </nav>

            </div>
        </header>


        <div style="margin-top:100px;" class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('login') }}">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control form-control-user"
                                                    name="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." required>
                                            </div>


                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name="password" required id="password" placeholder="Password">
                                            </div>

                                            <div class="form-group{{ $errors->any() ? ' has-error' : '' }}">
                                                @if ($errors->any())
                                                <span class="help-block">
                                                    <strong>{{ $errors->first() }}</strong>
                                                </span>
                                                @endif
                                            </div>



                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary btn-user btn-block">Login</button>
                                            </div>

                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="#">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="/register">Create an Account!</a>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-white">
                <span>Copyright &copy; 25/10 Crowd Sourcing 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</body>

</html>