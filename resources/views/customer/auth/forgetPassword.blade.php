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
                            <h2>Forget Password</h2>
                        </div>
                        @if(Session::has('message'))
                        <div class="error" style="text-align:center;font-size:21px;">
                            {{ Session::get('message') }}</div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/merchant/forgetPasswordProcess') }}">
                        @csrf
                            <div class="field-wrap">
                                <label>Mobile or Email Id</label>
                                <div class="input-wrap">
                                    <div class="icon"><img src="../asset/merchant/assets/images/user.png" alt="user">
                                    </div>
                                    <input type="text" name="userid" placeholder="Enter mobile or Email-Id"
                                        value="{{ old('userid') }}">
                                    @if($errors->has('userid'))
                                    <div class="error">{{ $errors->first('userid') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <input type="submit" value="Next" class="btn btn-default">
                            </div>
                        </form>
                        <p>Return back ? <a href="{{url('merchant/login')}}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('merchant.footer')