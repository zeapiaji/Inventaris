<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventaris</title>

    <!-- Scripts -->
    <script src="{{ asset('js-temp/clock.js') }}" defer></script>
    <script src="{{ asset('js-temp/searchbar.js') }}" defer></script>
    <script src="{{ asset('js-temp/searchbar_gudang.js') }}" defer></script>
    <script src="{{ asset('js-temp/chart.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js-temp/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script>$(document).ready(minusIgnore() {this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null});</script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css-temp/app.css')}}" rel="stylesheet">
    <link href="{{asset('css-temp/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
</head>

<body>
    <div class="wrapper">
        @include('sweetalert::alert')

        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="/">
                    <span class="align-middle text-light inventaris fw-bolder">Inventaris</span>
                    <span class="align-middle smk">SMK MAHAPUTRA CERDAS UTAMA</span>
                </a>

                <ul class="sidebar-nav d-flex align-items-start flex-column" id="sidebar">

                    <li class="sidebar-item">
                        <a class="sidebar-link">
                            <div class="align-middle sidebar-brand">
                                <div id="clock" class="text-light" onload="currentTime()"></div>
                            </div>
                        </a>
                    </li>

                    <li class="sidebar-header">Menu</li>

                    <li class="sidebar-item {{ Route::currentRouteNamed( 'dasbor' ) ?  'active' : '' }}">
                        <a class="sidebar-link" href="/">
                            <i class="align-middle" data-feather="sliders"></i>
                            <span class="align-middle">Dasbor</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Aset</li>

                    <li class="sidebar-item {{ Route::currentRouteNamed( 'ruangan' ) ?  'active' : '' }}">
                        <a class="sidebar-link" href="/ruangan">
                            <i class="align-middle" data-feather="square"></i>
                            <span class="align-middle">Ruangan</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Route::currentRouteNamed( 'gudang' ) ?  'active' : '' }}">
                        <a class="sidebar-link" href="/gudang">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Gudang</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Route::currentRouteNamed( 'sampah' ) ?  'active' : '' }}">
                        <a class="sidebar-link" href="/gudang/sampah">
                            <i class="align-middle" data-feather="trash-2"></i>
                            <span class="align-middle">Sampah</span>
                        </a>
                    </li>

                    <li class="sidebar-item mt-auto">
                        <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="align-middle me-2" data-feather="log-out"></i>
                            <span class="align-middle">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>


            </div>
        </nav>


        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item">
                            <div class=""></div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>

                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>


                    </ul>
                </div>
            </nav>

            @yield('content')
            {{-- @include('modal') --}}
        </div>

    </div>

</body>
{{-- @include('gudang.script') --}}
{{-- @yield('script') --}}

</html>
