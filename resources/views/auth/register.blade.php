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
                <a href="/" ><img style="width:50px;height:50px;margin-left:15px" src="/img/logo.png" alt="" ></a>
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

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form method="POST" action="{{ route('register') }}" class="user">
                                    {{ csrf_field() }}
                                    <div class="form-group row">

                                        <div
                                            class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="Fname"
                                                name="Fname" value="{{ old('Fname') }}" placeholder="First Name"
                                                required>
                                            @if ($errors->has('Fname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Fname') }}</strong>
                                            </span>
                                            @endif
                                        </div>


                                        <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }} col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="Lname"
                                                name="Lname" value="{{ old('Lname') }}" placeholder="Last Name"
                                                required>
                                            @if ($errors->has('Lname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Lname') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                        <input name="email" type="email" class="form-control form-control-user"
                                            id="email" value="{{ old('email') }}" required placeholder="Email Address">

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif

                                    </div>

                                    <div class="form-group row">
                                        <div
                                            class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Password" name="password" required>

                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>


                                        <div class="form-group col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="password-confirm" type="password" placeholder="Repeat Password"
                                                name="password_confirmation" required>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label for="Role">Choose Role</label>
                                        <div>
                                            Participant <input id="role" type="radio" name="role" value="P" checked
                                                required>
                                            Facilitator <input id="role" type="radio" name="role" value="F" required>
                                        </div>
                                    </div>


                                    <div class="form-group col-6 offset-3">
                                        <button type="submit" class="btn btn-primary btn-user btn-lg btn-block">Sign
                                            Up</button>
                                    </div>



                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="/login">Already have an account? Login!</a>
                                </div>
                                <hr>
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