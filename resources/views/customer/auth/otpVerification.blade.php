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
                            <h2>Please verify your account</h2>
                        </div>
                        @if(Session::has('message'))
                        <div class="error" style="text-align:center;font-size:21px;">
                            {{ Session::get('message') }}</div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/merchant/passwordVerification') }}">
                        @csrf
                            <div class="field-wrap">
                                <label>User-Id : <b>{{session()->get('user_id_temp')}}</b></label>

                            </div>
                            <div class="field-wrap">
                                <label>Verification Code</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/user.png" alt="user">
                                    </div>
                                    <input type="text" name="verification_code" placeholder="Enter Verification Code"
                                        value="{{ old('verification_code') }}">
                                    @if($errors->has('verification_code'))
                                    <div class=" error">{{ $errors->first('verification_code') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label>New Password</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/lock.png" alt="lock">
                                    </div>
                                    <input type="password" name="password" placeholder="Enter New-Password"
                                        value="{{ old('password') }} ">
                                    @if($errors->has('password'))
                                    <div class=" error">{{ $errors->first('password') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label>Confirm New-Password</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/lock.png" alt="lock">
                                    </div>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Enter Confirm New-Password">
                                    @if($errors->has('password_confirmation'))
                                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="btn-wrap">
                                <input type="submit" value="Change Password" class="btn btn-default">
                            </div>
                        </form>
                        <p>Not You ? <a href="{{url('merchant/forgetPassword')}}">Change User-Id</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('merchant.footer')