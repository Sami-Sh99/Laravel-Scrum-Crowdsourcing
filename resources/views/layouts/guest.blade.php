<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

            <!-- 3rd Party Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome-style.css') }}" rel="stylesheet">
    </head>


<body>
    <div id="app">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <header id="header" class="fixed-top">
                        <div>
                    
                          <div class="float-left">
                            <!-- Uncomment below if you prefer to use an image logo -->
                            <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
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

                    @yield('content')
                </div>

            </div>
        </div>
    </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    
    @yield('scripts')
</body>

</html>