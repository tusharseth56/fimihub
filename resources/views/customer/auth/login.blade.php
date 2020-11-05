@include('merchant.header')
<section class="banner-with-form">
    <div class="inner-wrapper">
        <div class="container">
            <div class="row-wrap">
                <div class="content-col">
                    <div class="content-wrap">
                        <h1>Get All Your Payment Done In One Place</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut
                            labore et.</p>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-container">
                        <div class="form-title">
                            <h2>Login to your account</h2>
                        </div>
                        @if(Session::has('message'))
                        <div class="error" style="text-align:center;font-size:21px;">
                            {{ Session::get('message') }}</div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/merchant/login') }}">
                        @csrf
                            <div class="field-wrap">
                                <label>Mobile or Email Id</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/user.png" alt="user">
                                    </div>
                                    <input type="text" name="user_id" value="{{ old('user_id') }}"
                                        placeholder="Enter mobile or Email-Id">
                                    @if($errors->has('user_id'))
                                    <div class="error">{{ $errors->first('user_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label>Password</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/lock.png" alt="lock">
                                    </div>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        placeholder="Enter password">
                                    @if($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="link-wrap">
                                <a href="{{url('merchant/forgetPassword')}}">Forgot Password?</a>
                            </div>
                            <div class="btn-wrap">
                                <input type="submit" value="Login" class="btn btn-default">
                            </div>
                        </form>
                        <p>Don’t have an account? <a href="{{url('merchant/register')}}">Create One</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('merchant.footer')