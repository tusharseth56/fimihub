@extends('customer.layout.myAccountBase')

@section('title', 'My Account')

@section('content')


<div class="content-col">
    <div class="info-box">
        <div class="form-title">
            <h5>CHANGE PASSWORD</h5>
        </div>
        <div class="inner-wrap">
            <div class="title-wrap">
                <p>Kindly reset your password</p>
            </div>
            <form role="form" method="POST" action="{{ url('/updateProfile') }}" class="form change-pwd">
                @csrf
                <div class="input-wrap">
                    <input type="password" placeholder="Current Password" name="current_password">
                </div>
                <div class="input-wrap">
                    <input type="password" placeholder="New Password" name="password">
                </div>
                <div class="input-wrap">
                    <input type="password" placeholder="Confirm New Password" name="password_confirmation">
                </div>
                <div class="btn-wrap">
                    <input type="supmit" class="btn btn-purple" value="Change Password">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection