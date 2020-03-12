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



</head>


<body class="bg-light">
    <div id="app">
        @if ( Auth::user()->is_verified  == 0 && Auth::user()->role !='A')

        <div class="blocked"></div>
        <div class="blocked-msg">
            <i class="fa fa-lock"> </i>
            <p> Account not verified, please contact an Administrator to verify your account </p>
        </div>

        

        @else


        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <div>
                            <a href="/">  <img style="width:50px;height:50px;margin-left:10px" src="/img/logo.png" /> </a>
                        </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span id="notification_count" class="badge badge-danger badge-counter"></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div id="notification_div" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Notifications
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div id="no_new_notifications">
                                            <span class="font-weight-bold">No new notifications</span>
                                        </div>
                                    </a>

                                </div>
                            </li>



                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->Fname }}
                                    </span>
                                    @php $photo = Auth::user()->photo_link @endphp
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('images/'.$photo.'') }}"  onerror="this.src='http://ssl.gstatic.com/accounts/ui/avatar_2x.png'" >
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    @if (Auth::user()->role == 'P')
                                    <a href="/participant/home" class="dropdown-item" >
                                        <i class="fa fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Dashboard
                                    </a>
                                    <a href="/participant/view" class="dropdown-item" >
                                        <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    @endif
                                    @if (Auth::user()->role == 'F')
                                    <a href="/facilitator/home" class="dropdown-item" >
                                        <i class="fa fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Dashboard
                                    </a>
                                    <a href="/facilitator/view" class="dropdown-item" >
                                        <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @endif

                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item" >
                                        <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </div>
                            </li>
                            @endguest
                        </ul>

                    </nav>

                    @yield('content')
                </div>

            </div>
        </div>

        @endif
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

    <!-- Scripts -->

    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    
    @yield('scripts')
</body>

</html>