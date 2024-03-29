@extends('customer.layout.myAccountBase')

@section('title', 'My Account')

@section('content')


<div class="content-col">
    <div class="info-box">
        <div class="form-title">
            <h5>CONTACT US</h5>
        </div>
        <div class="inner-wrap">
            <div class="title-wrap">
                <h4>Have Some Question?</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore</p>
                @if(Session::has('message'))
                <div class="error" style="text-align:center;">
                    <h4 class="error">{{ Session::get('message') }}</h4>
                </div>

                @endif
            </div>
            <form role="form" method="POST" action="{{ url('/contactUs') }}" class="form contact-us">
                @csrf
                <div class="row-wrap">
                    <div class="input-col">
                        <div class="input-wrap">
                            <input type="text" placeholder="Full Name" name="name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="input-col">
                        <div class="input-wrap">

                        </div>
                    </div>
                    <div class="input-col">
                        <div class="input-wrap">
                            <input type="email" placeholder="Email ID" name="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="input-col">
                        <div class="input-wrap">
                            <input type="number" placeholder="Phone No." name="mobile" value="{{ old('mobile') }}">
                            @if($errors->has('mobile'))
                            <div class="error">{{ $errors->first('mobile') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="input-wrap">
                    <textarea cols="100" rows="3" placeholder="Message" name="message"
                        >{{ old('message') }}</textarea>
                    @if($errors->has('message'))
                    <div class="error">{{ $errors->first('message') }}</div>
                    @endif
                </div>
                <div class="btn-wrap">
                    <input type="submit" class="btn btn-purple" value="Send">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection