
<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title>@lang($page)  | {{env('PAGENAME')}}</title>

    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="{{URL::to('public/assets/admin')}}/plugins/pace-master/themes/blue/pace-theme-flash.css"
          rel="stylesheet"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/fontawesome/css/font-awesome.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/line-icons/simple-line-icons.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/switchery/switchery.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/3d-bold-navigation/css/style.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/slidepushmenus/css/component.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/weather-icons-master/css/weather-icons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/plugins/product-preview-slider/css/style.css" rel="stylesheet"
          type="text/css">
    <link href="{{URL::to('public/assets/admin')}}/plugins/select2/css/select2.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Theme Styles -->
    <link href="{{URL::to('public/assets/admin')}}/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{URL::to('public/assets/admin')}}/css/custom.css" rel="stylesheet" type="text/css"/>

    <script src="{{URL::to('public/assets/admin')}}/plugins/3d-bold-navigation/js/modernizr.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-header-fixed compact-menu page-horizontal-bar">
<div class="overlay"></div>
<main class="page-content content-wrap">
    <div class="navbar">
        <div class="navbar-inner container">
            <div class="sidebar-pusher">
                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="logo-box">
                <a href="{{URL::to('dashboard')}}" class="logo-text"><span>{{env('PAGENAME')}}</span></a>
            </div><!-- Logo Box -->
            <div class="topmenu-outer">
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-bars"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i>
                            <?php
                                    $notifications = DB::table('notifications')->where('user', Auth::user()->id)->where('read', 0)->orderBy('id', 'desc')->get();

                            ?>
                                @if(count($notifications)>0)
                                <span class="badge badge-success pull-right" id="notification-counter">{{count($notifications)}}</span>
                                @endif

                            </a>
                            <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                @if(count($notifications)<1)
                                    <li><p class="drop-title" style="text-align: center;">@lang('notification.none')</p>
                                    </li>
                                @endif
                                <li class="dropdown-menu-list slimscroll tasks">
                                    <ul class="list-unstyled">
                                        @foreach($notifications as $notification)
                                        <li class="notification">
                                            <a href="#">
                                                <div class="task-icon badge badge-{{$notification->type}}"><i class="icon-user"></i></div>
                                                <span class="badge badge-roundless badge-default pull-right">{{date('H:i', $notification->time)}}</span>
                                                <p class="task-details">@lang($notification->content)</p>
                                            </a>
                                        </li>
                                        @endforeach
                                        <li class="drop-all"><a href="#" class="text-center"
                                                                id="mark-all">@lang('notification.read')</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <li>
                                <a href="{{URL::to('cart')}}"><i class="glyphicon glyphicon-shopping-cart"></i></a>
                            </li>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                <span class="user-name">{{Auth::user()->name}}<i class="fa fa-angle-down"></i></span>
                                <img class="img-circle avatar" src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}/?s=40" width="40" height="40" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                            </ul>
                        </li>
                    </ul><!-- Nav -->
                </div><!-- Top Menu -->
            </div>
        </div>
    </div><!-- Navbar -->
    @if(empty($sub))
        @include('dashboard.navigations.secondary.home')
    @else
        @include('dashboard.navigations.secondary.'.$sub)
    @endif
    <div class="page-inner">
        @include('dashboard.navigations.breadcrumbs')
        <div class="panel panel-white">
            <div class="panel-body">
                    <div class="container">
                        <h3>@lang($page)</h3>
                    </div>
            </div>
        </div>
        <div id="main-wrapper" class="container">
            @yield('content')
        </div><!-- Main Wrapper -->
        <div class="page-footer">
            <div class="container">
                <p class="no-s">{{date('Y')}} &copy; {{env('PAGENAME')}}.</p>
            </div>
        </div>
    </div><!-- Page Inner -->
</main><!-- Page Content -->
<nav class="cd-nav-container" id="cd-nav">
    <header>
        <h3>Navigation</h3>
        <a href="#0" class="cd-close-nav">Close</a>
    </header>
    <ul class="cd-nav list-unstyled">
        <li class="cd-selected" data-menu="index">
            <a href="{{URL::to('dashboard')}}">
                        <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                <p>@lang('navigation.dashboard')</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="{{URL::to('virtual')}}">
                        <span>
                            <i class="glyphicon glyphicon-hdd"></i>
                        </span>
                <p>@lang('navigation.vps')</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="{{URL::to('dedicated')}}">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                <p>@lang('navigation.dedicated')</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="{{URL::to('shop')}}">
                        <span>
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                        </span>
                <p>@lang('navigation.shop')</p>
            </a>
        </li>
        <li data-menu="profile">
            <a href="{{URL::to('profile')}}">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                <p>@lang('navigation.profile')</p>
            </a>
        </li>
        <li data-menu="inbox">
            <a href="{{URL::to('support')}}">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                <p>@lang('navigation.support')</p>
            </a>
        </li>

        <li data-menu="#">
            <a href="{{URL::to('settings')}}">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                <p>@lang('navigation.settings')</p>
            </a>
        </li>

    </ul>
</nav>
<div class="cd-overlay"></div>


<!-- Javascripts -->
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/pace-master/pace.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/switchery/switchery.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/uniform/jquery.uniform.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/classie/classie.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/waves/waves.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/3d-bold-navigation/js/main.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery-counterup/jquery.counterup.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/toastr/toastr.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/flot/jquery.flot.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/flot/jquery.flot.time.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/curvedlines/curvedLines.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/metrojs/MetroJs.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/js/modern.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/js/pages/global.js"></script>
<script src="{{URL::to('public/assets/admin')}}/js/pages/dashboard.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/gridgallery/js/imagesloaded.pkgd.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/gridgallery/js/masonry.pkgd.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/gridgallery/js/classie.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/gridgallery/js/cbpgridgallery.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/product-preview-slider/js/jquery.mobile.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/product-preview-slider/js/main.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/select2/js/select2.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{URL::to('public/assets/admin')}}/js/pages/form-wizard.js"></script>
<script src="{{URL::to('public/assets/admin')}}/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
@if(!empty(session('success')))

    <script>
        $( document ).ready(function() {
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut',
                        timeOut: 5000
                    };
                    toastr.success('{{session("head")}}', '{{session("body")}}');
                }, 1800);
        });
    </script>

@elseif(!empty(session('fail')))
    <script>
        $( document ).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                toastr.error('{{session("head")}}', '{{session("body")}}');
            }, 1800);
        });
    </script>
@endif

</body>
</html>