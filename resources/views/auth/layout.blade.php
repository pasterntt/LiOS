
<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title>{{env('PAGENAME')}} | Login - Sign up</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="{{URL::to('assets/admin')}}/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
    <link href="{{URL::to('assets/admin')}}/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="{{URL::to('assets/admin')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="{{URL::to('assets/admin')}}/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('assets/admin')}}/css/custom.css" rel="stylesheet" type="text/css"/>

    <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-register login-alt">
<main class="page-content">
    <div class="page-inner">
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-6 center">
                    <div class="login-box panel panel-white">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{URL::to('')}}" class="logo-name text-lg">{{env('PAGENAME')}}</a>
                                    <p class="m-t-md">@lang('auth.login.description')</p>
                                    <p class="m-t-xs text-sm">{{date('Y')}} &copy; {{env('PAGENAME')}}.</p>
                                </div>
                                <div class="col-md-6">
                                    @include('partials.errors.basic')
                                    @yield('form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
    </div><!-- Page Inner -->
</main><!-- Page Content -->


<!-- Javascripts -->
<script src="{{URL::to('assets/admin')}}/plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/pace-master/pace.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/switchery/switchery.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/uniform/jquery.uniform.min.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/classie/classie.js"></script>
<script src="{{URL::to('assets/admin')}}/plugins/waves/waves.min.js"></script>
<script src="{{URL::to('assets/admin')}}/js/modern.min.js"></script>

</body>
</html>