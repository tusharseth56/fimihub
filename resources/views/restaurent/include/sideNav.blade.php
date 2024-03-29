<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rocker/color-version/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Sep 2018 19:45:16 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Fimihub - Restaurent</title>
    <!--favicon-->
    <link rel="icon" href="{{url('asset/customer/assets/images/logo.png')}}">

    <!-- Vector CSS -->
    <link href="{{url('asset/admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="{{url('asset/admin/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{url('asset/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{url('asset/admin/assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{url('asset/admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{url('asset/admin/assets/css/sidebar-menu.css')}}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{url('asset/admin/assets/css/app-style.css')}}" rel="stylesheet" />

</head>

<body>

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="{{url('Restaurent/dashboard')}}">
                    <img src="{{url('asset/customer/assets/images/logo.png')}}" class="logo-icon" alt="logo icon"
                        height="35px" width="25px">
                    <h5 class="logo-text">Fimihub</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header">MAIN NAVIGATION</li>
                <li>
                    <a href="{{url('Restaurent/dashboard')}}" class="waves-effect">
                        <i class="icon-home"></i> <span>Dashboard</span>

                    </a>
                </li>
                <li>
                    <a href="{{url('Restaurent/customerOrder')}}" class="waves-effect">
                        <i class="icon-list"></i> <span>Orders</span>

                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="fa fa-cutlery"></i> <span>Restaurent </span> <i
                            class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{url('Restaurent/myDetails')}}"><i class="fa fa-circle-o"></i> Details</a></li>
                        <!-- <li><a href="{{url('Restaurent/menuCategory')}}"><i class="fa fa-circle-o"></i> Category</a></li> -->
                        <li><a href="{{url('Restaurent/menuList')}}"><i class="fa fa-circle-o"></i> Menu</a></li>


                    </ul>
                </li>


                <li>
                    <a href="{{url('Restaurent/logout')}}" class="waves-effect">
                        <i class="icon-logout"></i> <span>Logout</span>

                    </a>
                </li>


            </ul>

        </div>
        <!--End sidebar-wrapper-->