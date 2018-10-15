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
    <link href="{{ asset('vendor/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/css/components-rounded.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('vendor/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/pages/css/login.css') }}" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}

    <!-- Scripts -->
    <script>
        window.Laravel = <?= json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>
<body class="login">

    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="{{ url('/') }}">
            
        </a>
    </div>
    <!-- END LOGO -->

    <div class="content">

        @yield('content')

    </div>

    <div class="copyright">  </div>

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

    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/scripts/all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/login.js') }}" type="text/javascript"></script>

</body>
</html>
