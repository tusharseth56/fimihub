@extends('customer.layout.myAccountBase')

@section('title', 'My Account')

@section('content')
<div class="content-col">
    <h5>My Orders</h5>
    <ul class="tabs">
        <li class="active" id="past-order">Past Order</li>
        <li id="ongoing">On Going</li>
    </ul>
    <div class="tab-content" data-tab-id="past-order">
        <div class="card-wrap">
            <div class="col-left">
                <div class="text-with-img">
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/order1.png')}}" alt="order1">
                    </div>
                    <div class="text-wrap">
                        <h6>Mixed Pulses</h6>
                        <span class="cat">Cuisine 1, Cuisine 2, etc.</span>
                        <span class="order-id">ORDER #59908365721 | Fri, Dec 20, 2019, 02:42 PM</span>
                        <span class="qty">Curry goat/mutton/chicken x 2</span>
                    </div>
                </div>
                <div class="btn-grp">
                    <a href="#" class="btn btn-purple">Reorder</a>
                    <a href="#" class="btn btn-purple">Help</a>
                </div>
            </div>
            <div class="col-right">
                <span class="status">Delivered on Fri, Dec 20, 2019, 03:19 PM <img src="{{url('asset/customer/assets/images/delivered.svg')}}"
                        alt="delivered"></span>
                <a href="#" class="show-sidepanel" id="orderPanel">View Details</a>
                <span class="amt">Total Paid: $3,503.30</span>
            </div>
        </div>
        <div class="card-wrap">
            <div class="col-left">
                <div class="text-with-img">
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/order2.png')}}" alt="order2">
                    </div>
                    <div class="text-wrap">
                        <h6>Big Ben Meats and Groceries</h6>
                        <span class="cat">Meats and Groceries, etc.</span>
                        <span class="order-id">ORDER #59908365721 | Fri, Dec 20, 2019, 02:42 PM</span>
                        <span class="qty">Castor Oil Beard Oil x 2</span>
                    </div>
                </div>
                <div class="btn-grp">
                    <a href="#" class="btn btn-purple">Reorder</a>
                    <a href="#" class="btn btn-purple">Help</a>
                </div>
            </div>
            <div class="col-right">
                <span class="status">Delivered on Fri, Dec 20, 2019, 03:19 PM <img src="{{url('asset/customer/assets/images/delivered.svg')}}"
                        alt="delivered"></span>
                <a href="#" class="show-sidepanel" id="orderPanel">View Details</a>
                <span class="amt">Total Paid: $3,503.30</span>
            </div>
        </div>
        <div class="card-wrap">
            <div class="col-left">
                <div class="text-with-img">
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/order1.png')}}" alt="order1">
                    </div>
                    <div class="text-wrap">
                        <h6>Mixed Pulses</h6>
                        <span class="cat">Cuisine 1, Cuisine 2, etc.</span>
                        <span class="order-id">ORDER #59908365721 | Fri, Dec 20, 2019, 02:42 PM</span>
                        <span class="qty">Curry goat/mutton/chicken x 2</span>
                    </div>
                </div>
                <div class="btn-grp">
                    <a href="#" class="btn btn-purple">Reorder</a>
                    <a href="#" class="btn btn-purple">Help</a>
                </div>
            </div>
            <div class="col-right">
                <span class="status">Delivered on Fri, Dec 20, 2019, 03:19 PM <img src="{{url('asset/customer/assets/images/delivered.svg')}}"
                        alt="delivered"></span>
                <a href="#" class="show-sidepanel" id="orderPanel">View Details</a>
                <span class="amt">Total Paid: $3,503.30</span>
            </div>
        </div>
    </div>
    <div class="tab-content" data-tab-id="ongoing">
        <div class="card-wrap">
            <div class="col-left">
                <div class="text-with-img">
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/order2.png')}}" alt="order2">
                    </div>
                    <div class="text-wrap">
                        <h6>Big Ben Meats and Groceries</h6>
                        <span class="cat">Meats and Groceries, etc.</span>
                        <span class="order-id">ORDER #59908365721 | Fri, Dec 20, 2019, 02:42 PM</span>
                        <span class="qty">Castor Oil Beard Oil x 2</span>
                    </div>
                </div>
                <div class="btn-grp">
                    <a href="#" class="btn btn-purple">Reorder</a>
                    <a href="#" class="btn btn-purple">Help</a>
                </div>
            </div>
            <div class="col-right">
                <span class="status on-way">ETA: 10 Mins <img src="{{url('asset/customer/assets/images/delivered.svg')}}"
                        alt="delivered"></span>
                <a href="#" class="show-sidepanel" id="orderPanel">View Details</a>
                <span class="amt">Total Paid: $3,503.30</span>
            </div>
        </div>
        <div class="card-wrap">
            <div class="col-left">
                <div class="text-with-img">
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/order1.png')}}" alt="order1">
                    </div>
                    <div class="text-wrap">
                        <h6>Mixed Pulses</h6>
                        <span class="cat">Cuisine 1, Cuisine 2, etc.</span>
                        <span class="order-id">ORDER #59908365721 | Fri, Dec 20, 2019, 02:42 PM</span>
                        <span class="qty">Curry goat/mutton/chicken x 2</span>
                    </div>
                </div>
                <div class="btn-grp">
                    <a href="#" class="btn btn-purple">Reorder</a>
                    <a href="#" class="btn btn-purple">Help</a>
                </div>
            </div>
            <div class="col-right">
                <span class="status on-way">ETA: 10 Mins <img src="{{url('asset/customer/assets/images/delivered.svg')}}"
                        alt="delivered"></span>
                <a href="#" class="show-sidepanel" id="orderPanel">View Details</a>
                <span class="amt">Total Paid: $3,503.30</span>
            </div>
        </div>
    </div>
</div>
<div class="side-panel right" data-panel-id="orderPanel">
        <div class="inner-sidebar">
            <div class="title">
                <div class="icon close-sidepanel">
                    <img src="{{url('asset/customer/assets/images/cross.svg')}}" alt="cross">
                </div>
                <h4>Order #59908365721</h4>
            </div>
            <ul class="order-info">
                <li>
                    <div class="order-route">
                        <div class="route-info">
                            <h6>Kungawo</h6>
                            <span>A,70, 3rd Floor W End Rd, Jamaica</span>
                        </div>
                        <div class="route-info">
                            <h6>W End Rd, West End, Jamaica</h6>
                            <span>A,70, 3rd Floor</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="text-row">
                        <div class="left">
                            <span class="info">Delivered on Fri, Dec 20, 2019, 03:19 PM by Brushe soe</span>
                        </div>
                        <div class="right">
                            <span class="badge-icon">On time</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="text-row">
                        <div class="left">
                            <span class="text-gray">1 Item</span>
                            <span class="info nonveg">Curry goat/mutton/chicken x 2</span>
                            <span class="text-gray">Full</span>
                        </div>
                        <div class="right">
                            <h6>$20.00</h6>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="text-row">
                        <div class="left">
                            <h6>Item Total</h6>
                            <span class="text-gray">Delivery Fee</span>
                        </div>
                        <div class="right">
                            <h6>$20.00</h6>
                            <span class="text-gray">$5.00</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="text-row">
                        <div class="left">
                            <h6>Bill Total</h6>
                            <span class="text-gray">Paid via Credit/Debit card</span>
                        </div>
                        <div class="right">
                            <h6>$25.00</h6>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="btn-grp">
                <button type="button" class="btn btn-purple">Rate and Review</button>
                <button type="button" class="btn btn-purple">Tip for Driver</button>
            </div>
        </div>
    </div>
@endsection

