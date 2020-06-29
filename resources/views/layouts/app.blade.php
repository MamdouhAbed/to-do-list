<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8">
    <title>{{'To-do-list',Config('APP_NAME')}}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="" type="image/x-icon">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/open-sans/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/dinnext/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/store/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/tether/css/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/jscrollpane/jquery.jscrollpane.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/common1.min.css')}}">

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/themes/primary2.min.css')}}">
    <link class="sidebar-dark-style" rel="stylesheet" type="text/css" href="{{ asset('assets/styles/themes/sidebar-black.min.css')}}">
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/kosmo/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/izi-modal/css/iziModal.min.css')}}"> <!-- Original -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/izi-modal/izi-modal.min.css')}}">
    <!-- Original -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/c3js/c3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/noty/noty.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/widgets/panels.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/touchspin/touchspin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/flatpickr/flatpickr.min.css')}}"> <!-- original -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/flatpickr/flatpickr.min.css')}}"> <!-- customization -->
    <script src="{{ asset('libs/jquery/jquery.min.js')}}"></script>

    @yield('css')
    <style>
        #noty_layout__topLeft {
            top: 56px;
            left: 30px;
        }
        .form-control {
            height: 43px;
        }
        select.form-control:not([size]):not([multiple]) {
            height: 43px;

        }
        .noty_theme__mint.noty_bar .noty_body {
            height: 58px;
        }
        .content-nav > .nav-body {
            background: #f4f4f4;
        }
    </style>
</head>
<!-- END HEAD -->

<body class="navbar-fixed sidebar-sections sidebar-position-fixed page-header-fixed theme-primary page-loading">
<!-- remove page-header-fixed to unfix header -->

<!-- BEGIN HEADER -->
<nav class="navbar navbar">
    <!-- BEGIN HEADER INNER -->
    <!-- BEGIN LOGO -->
    <div href="index.html" class="navbar-brand">
        <!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
        <a href="#" class="sidebar-toggle"><i class="icon la la-bars" aria-hidden="true"></i></a>
        <a href="#" class="sidebar-mobile-toggle"><i class="icon la la-bars" aria-hidden="true"></i></a>
        <!-- END RESPONSIVE SIDEBAR TOGGLER -->

        <div class="navbar-logo">
            <a href="{{route('home')}}" class="logo">To-Do-List</a>



            <!-- END GRID NAVIGATION -->
        </div>
    </div>
    <!-- END LOGO -->

    <!-- BEGIN MENUS -->
    <div class="wrapper">
        <nav class="nav navbar-nav">
            <!-- BEGIN NAVBAR MENU -->

            <div class="navbar-menu">
                <a class="nav-item nav-link " href="{{route('tasks.index')}}">قائمة كافة المهام</a>
            </div>

            <!-- END NAVBAR MENU -->

            <!-- BEGIN NAVBAR ACTIONS -->
            <div class="navbar-actions">
                <!-- BEGIN NAVBAR ACTION BUTTON -->

                <!-- BEGIN NAVBAR USER -->

                <!-- END NAVBAR USER -->
            </div>
            <!-- END NAVBAR ACTIONS -->
        </nav>
        <div class="nav-item dropdown user">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar" style="margin-left: 10px">
                            <img src="{{asset('assets/img/admin.jpg')}}" height="36px" width="36px">
                        </span>
                <span class="info">
                            <span class="name"> {{Auth::user()->name}}</span>
                            <span class="description">مدير </span>
                        </span>
            </a>

            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="Preview">
                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span class="la la-sign-out icon" aria-hidden="true"></span>
                    <span> تسجيل الخروج
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form></span>
                </a>
            </div>
        </div>
        <!-- BEGIN NAVBAR ACTIONS TOGGLER -->
        <nav class="nav navbar-nav navbar-actions-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-ellipsis-h icon open"></span>
                <span class="la la-close icon close"></span>
            </a>
        </nav>
        <!-- END NAVBAR ACTIONS TOGGLER -->

        <!-- BEGIN NAVBAR MENU TOGGLER -->
        <nav class="nav navbar-nav navbar-menu-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-th icon open"></span>
                <span class="la la-close icon close"></span>
            </a>
        </nav>
        <!-- END NAVBAR MENU TOGGLER -->
    </div>
    <!-- END MENUS -->
    <!-- END HEADER INNER -->
</nav>
<!-- END HEADER -->

<div class="page-container dashboard-tabbed-sidebar-fixed-tabs">

    <!-- BEGIN DEFAULT SIDEBAR -->
    <div class="column sidebar info">
        <div class="wrapper">
            <section>
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <span class="icon la la-home"></span>
                            <span>الرئيسية</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="icon la la-cog"></span>
                            <span>المهام</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" style="border-bottom:1px solid #434950 !important;" href="{{route('tasks.index')}}">قائمة كافة المهام</a>
                            <a class="dropdown-item" style="border-bottom:1px solid #434950 !important;" href="{{route('completed')}}">المهام المكتملة</a>
                            <a class="dropdown-item" style="border-bottom:1px solid #434950 !important;" href="{{route('uncompleted')}}">المهام الغير المكتملة</a>

                        </div>
                    </li>



                </ul>
            </section>

        </div>
    </div>
    <!-- END DEFAULT SIDEBAR -->

    @yield('content')


</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('libs/responsejs/response.min.js')}}"></script>
<script src="{{ asset('libs/loading-overlay/loadingoverlay.min.js')}}"></script>
<script src="{{ asset('libs/tether/js/tether.min.js')}}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('libs/jscrollpane/jquery.jscrollpane.min.js')}}"></script>
<script src="{{ asset('libs/jscrollpane/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('libs/flexibility/flexibility.js')}}"></script>
<script src="{{ asset('libs/noty/noty.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/scripts/common.min.js')}}"></script>
<script src="{{ asset('libs/sweetalert/sweetalert.min.js')}}"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="{{ asset('libs/noty/noty.min.js')}}"></script>
<script src="{{ asset('libs/izi-modal/js/iziModal.min.js')}}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js')}}"></script>
<script type="application/javascript">
    (function ($) {
        $(document).ready(function() {
            $('.flatpickr').flatpickr();
        });
    })(jQuery);
</script>

@yield('js')

<div class="mobile-overlay"></div>
</body>
</html>
</div>
<!-- / main menu-->


<!-- ////////////////////////////////////////////////////////////////////////////-->
