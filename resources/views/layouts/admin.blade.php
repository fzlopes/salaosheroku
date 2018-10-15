<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Salão de Beleza </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/simple-line-icons/simple-line-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')

    <link href="{{ asset('vendor/global/css/components-rounded.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('vendor/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('vendor/layouts/layout/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/layouts/layout/css/themes/darkblue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/layouts/layout/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <script>
        window.Laravel = <?= json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

    <div class="page-wrapper">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{ url('/') }}">
                    </a>
                    {{--<img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>--}}
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">

                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                @if (!Auth::user()->picture)
                                    <img alt="" class="img-circle" src="{{ asset('assets/pages/media/profile/guest_user.jpg') }}" />
                                @else
                                    <img src="{{  asset('/uploads/users/img/' . Auth::user()->picture) }}" class="img-circle" />
                                @endif


                                <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ route('profile.profile') }}">
                                        <i class="icon-user"></i> Meu perfil </a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> Sair </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="{{ url('/logout') }}" class="dropdown-toggle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-logout"></i>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>

    <div class="page-container">

        @include('sidebar.menu')

        <div class="page-content-wrapper">
            <div class="page-content">

                @yield('pagebar')

                @yield('title')

                @yield('content')

            </div>
        </div>

        <div class="page-footer">
            <div class="page-footer-inner"> Salão de Beleza
               
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

    </div>

    <!--[if lt IE 9]>
    <script src="{{ asset('vendor/global/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('vendor/global/plugins/excanvas.min.js') }}"></script>
    <script src="{{ asset('vendor/global/plugins/ie8.fix.min.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('vendor/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/typeahead/handlebars.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/jquery-cookiebar/jquery.cookieBar.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/scripts/all.js') }}" type="text/javascript"></script>

    @yield('scripts')

    <script src="{{ asset('vendor/pages/scripts/components-typeahead.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/layouts/layout/scripts/all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/layouts/global/scripts/all.js') }}" type="text/javascript"></script>

</body>
</html>
