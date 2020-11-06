@include('customer.include.header')
<section class="dashboard">
    <div class="intro">
        <div class="md_container">
            <h4>My Account</h4>
        </div>
    </div>
    <div class="md_container">
        <div class="row-wrap">
            <div class="side-menu-col">
                <div class="user-info">
                    <div class="img-wrap">
                        <img src="{{$user_data->picture ?? url('asset/customer/assets/images/user_icon2.png')}}"
                            alt="user">
                    </div>
                    <div class="info-wrap">
                        <h6>{{$user_data->name ?? ''}}</h6>
                        <p>{{$user_data->email ?? ''}}</p>
                        <p>{{$user_data->mobile ?? ''}}</p>
                    </div>
                    <div class="toggle-menu">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <a href="./my-account.html" class="active">Account Information</a>
                        </li>
                        <li>
                            <a href="./my-orders.html">My Orders</a>
                        </li>
                        <li>
                            <a href="./change-password.html">Change Password</a>
                        </li>
                        <li>
                            <a href="./terms-and-condition.html">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="./faq.html">FAQ's</a>
                        </li>
                        <li>
                            <a href="./manage-address.html">Manage Saved Addresses</a>
                        </li>
                        <li>
                            <a href="./contact-us.html">Contact Us</a>
                        </li>
                        <li>
                            <a href="./legal-information.html">Legal Information</a>
                        </li>
                        <li>
                            <a href="./about-us.html">About Us</a>
                        </li>
                        <li>
                            <a href="{{url('logout')}}"><img
                                    src="{{url('asset/customer/assets/images/logout_icon.svg')}}" alt="logout">
                                Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            @yield('content')

        </div>
    </div>
</section>
@include('customer.include.footer')