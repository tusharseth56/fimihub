@extends('customer.layout.cartBase')

@section('title', 'My Account')

@section('content')
<div class="col-md-7 padd_rht">
    <div class="card_lft card card_track">
        <div class="track_map">
            <img src="{{url('asset/customer/assets/images/trackmap.png')}}" class="w-100" alt="map">
        </div>
        <div class="track_addrs_strip d-flex">
            <div>
                <p>{{$resto_data->name ?? ''}}</p>
                <p>Order ID- {{$order_data->order_id ?? ''}}</p>
            </div>
            <p>Arriving Today at 5:20</p>
        </div>
        <div class="order_progress">
            <div class="row">
                <div class="col-md-9">
                    <ul class="order_track_step">
                        <li class="{{ $order_data->order_status >=5 ? 'active' : ''}}"><span></span> Order placed</li>
                        <li class="{{ $order_data->order_status >=6 ? 'active' : ''}}"><span></span> Order packed</li>
                        <li class="{{ $order_data->order_status >=7 ? 'active' : ''}}"><span></span> Order has been picked by Brushe soe</li>
                        <li class="{{ $order_data->order_status >=9 ? 'active' : ''}} m-0"><span></span> Order recieved</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <img src="{{url('asset/customer/assets/images/burger_image.png')}}" class="w-100" alt="burger">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection