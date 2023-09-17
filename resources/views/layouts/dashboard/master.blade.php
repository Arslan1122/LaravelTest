<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body>
<div class="container-scroller">

    <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
            <div class="container-fluid">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo" href="/">Furniture</a>
                        <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('images/logo-mini.svg') }}" alt="logo"/></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                <span class="nav-profile-name">@if(Auth::check()) {{ Auth::user()->name }} @endif</span>
                                <span class="online-status"></span>
                                <img src="{{ asset('images/faces/face28.png') }}" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </div>
        </nav>
        <nav class="bottom-navbar">
            <div class="container">
                <ul class="nav page-navigation" style="justify-content: flex-start">
                    <li class="nav-item @if(Route::currentRouteName() == "dashboard") active @endif">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-file-document-box menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if(Auth::user()->hasRole(\App\Models\User::ADMIN_ROLE))
                            <li class="nav-item @if(Route::currentRouteName() == "users") active @endif">
                                <a class="nav-link" href="{{ route('users') }}">
                                    <i class="mdi mdi-file-document-box menu-icon"></i>
                                    <span class="menu-title">Users</span>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <div class="d-lg-flex align-items-center">
                            <div>
                                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>

                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
    </div>

</div>


<script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>

<script src="{{ asset('js/template.js') }}"></script>

<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
<script src="{{ asset('vendors/justgage/justgage.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

</body>
</html>