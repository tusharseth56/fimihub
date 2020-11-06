<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('asset/customer/dist/main.css')}}">
    <link rel="icon" href="{{url('asset/customer/assets/images/logo.png')}}">
    <title>Fimihub</title>
</head>

<body>
    <header class="header">
        <div class="md_container">
            <div class="inner-wrap">
                <div class="left-block">
                    <ul>
                        <li>
                            <div class="logo-wrap">
                                <a href="{{url('/')}}">
                                    <img src="{{url('asset/customer/assets/images/logo.png')}}" alt="logo">
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="location-link show-sidepanel" id="addressPanel"><img
                                    src="{{url('asset/customer/assets/images/location.svg')}}" alt="location">
                                <span>Location</span></a>
                        </li>
                    </ul>
                </div>
                <nav class="nav-menu">
                    <ul>
                        @if(Session::has('user'))
                        <li>
                            <a href="#" class="icon-link">
                                <img src="{{url('asset/customer/assets/images/search_purple.svg')}}" alt="search">
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/cart')}}" class="icon-link">
                                <img src="{{url('asset/customer/assets/images/cart.svg')}}" alt="cart">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="icon-link">
                                <img src="{{url('asset/customer/assets/images/notification.svg')}}" alt="notification">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="icon-link user">
                                <img src="{{$user_data->picture ?? url('asset/customer/assets/images/user_icon2.png')}}"
                                    alt="user">
                                {{$user_data->name ?? ''}}
                            </a>
                        </li>
                        <li>
                            <a href="{{url('logout')}}"><img src="{{url('asset/customer/assets/images/user.svg')}}"
                                    alt="user"> Logout</a>
                        </li>
                        <li>
                            <a href="{{url('myAccount')}}"><img src="{{url('asset/customer/assets/images/user.svg')}}"
                                    alt="user"> My Account</a>
                        </li>
                        @else
                        <li>
                            <a href="#">Partner with us</a>
                        </li>
                        <li>
                            <a href="#">Ride with us</a>
                        </li>
                        <li>
                            <a href="{{url('cart')}}" class="icon-link">
                                <img src="{{url('asset/customer/assets/images/cart.svg')}}" alt="cart">
                            </a>
                        </li>
                        <li>
                            <a href="{{url('login')}}"><img src="{{url('asset/customer/assets/images/user.svg')}}"
                                    alt="user"> SIGN IN</a>
                        </li>
                        <li>
                            <a href="{{url('register')}}"> <img src="{{url('asset/customer/assets/images/logout.svg')}}"
                                    alt="sign up"> SIGN UP</a>
                        </li>
                        @endif

                    </ul>
                </nav>
                <div class="toggle-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
    </header>