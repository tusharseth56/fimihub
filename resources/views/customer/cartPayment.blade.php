@extends('customer.layout.cartBase')

@section('title', 'My Account')

@section('content')
<div class="col-md-7 padd_rht">
    <div class="card_lft card payment_method_card">
        <h3>Choose payment method</h3>

        <div class="payment_options">
            @if($errors->has('payment'))
            <div class="error" style="text-align:center;">
                <h4 class="error">{{ $errors->first('payment') }}</h4>
            </div>
            @endif
            <form role="form" method="POST" action="{{ url('/addPaymentMethod') }}">
                @csrf
                <input type="radio" name="payment" id="stripe" value="1">
                <label for="stripe">
                    <img src="{{url('asset/customer/assets/images/stripe.svg')}}" alt="stripe">
                </label>

                <input type="radio" name="payment" id="paypal" value="2">
                <label for="paypal">
                    <img src="{{url('asset/customer/assets/images/paypal.svg')}}" alt="paypal">
                </label>

                <input type="radio" name="payment" id="cash" value="3">
                <label for="cash" id="cashondelivery">
                    <img src="{{url('asset/customer/assets/images/cash-delivery.svg')}}" class="mr-2"
                        alt="cash on delivery">
                    CASH ON DELIVERY
                </label>
                <input type="submit" class="btn_purple auth_btn hover_effect1 paynow_btn" value="Pay Now">

            </form>
        </div>
    </div>
</div>
@endsection