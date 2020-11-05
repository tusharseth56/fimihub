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
                            <h2>Create account</h2>
                            @if(Session::has('message'))
                            <div class="error" style="text-align:center;">
                                {{ Session::get('message') }}</div>
                            @endif
                        </div>
                        <form role="form" method="POST" action="{{ url('/merchant/register') }}">
                        @csrf
                            <div class="field-wrap">
                                <label>Full Name</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/user.png" alt="user">
                                    </div>
                                    <input type="text" name="name" placeholder="Enter your name"
                                        value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label>Mobile</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/phone.png" alt="phone">
                                    </div>
                                    <input type="text" name="mobile" value="{{ old('mobile') }}"
                                        placeholder="Enter Mobile">
                                    @if($errors->has('mobile'))
                                    <div class="error">{{ $errors->first('mobile') }}</div>
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
                                <div class="checkbox-wrap">
                                    <input type="checkbox" id="terms" name="terms">
                                    <label for="terms">I agree with <a href="#">terms & conditions</a></label>
                                    @if($errors->has('terms'))
                                    <div class="error">{{ $errors->first('terms') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <input type="submit" value="Register" class="btn btn-default">

                            </div>
                            <p>Already have an account? <a href="{{url('merchant/login')}}">Login?</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('merchant.footer')