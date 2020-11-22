@include('customer.include.header')
<section class="cart_login">
    <div class="container sm_container">
        <div class="cart_login_inr">
            <div class="progress_box">
                <ul class="steps">
                    <li class="step2 active"><span></span>
                        <p>Address</p>
                    </li>
                    <li class="step3 {{ request()->is('checkoutPage') ? 'active' : ''}}"><span></span>
                        <p>Payment</p>
                    </li>
                </ul>
            </div>
            <div class="row">

                @yield('content')

                <div class="col-md-5 padd_lft">
                    <div class="card_rht card h-100 pb-0">
                        <div class="card_rht_top">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{url('asset/customer/assets/images/food.png')}}" alt="image"
                                        class="w-100">
                                </div>
                                <div class="col-md-8">
                                    <h4>{{$resto_data->name ?? ''}}</h4>
                                    <p>{{$resto_data->address ?? ''}}</p>
                                </div>
                            </div>
                        </div>

                        @foreach($menu_data as $m_data)
                        <div class="food_detials_strip nonveg_food_strip">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="food_strip_lft">
                                        <h5>{{$user_data->currency ?? ''}} {{$m_data->price ?? ''}}</h5>
                                        <span class="red_dots"></span>
                                        <h4>{{$m_data->name ?? ''}}</h4>
                                        <p>{{$m_data->about ?? ''}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="food_strip_rht">
                                        <button type="button" class="minus_btn"
                                            onClick="decrement_quantity('{{base64_encode($m_data->id)}}')">-</button>
                                        <input type="text" value="{{$m_data->quantity ?? '0'}}"
                                            id="input-quantity-{{$m_data->id}}" readonly>
                                        <button type="button" class="pluse_btn"
                                            onClick="increment_quantity('{{base64_encode($m_data->id)}}')">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                        <div class="aply_cupon ">
                            <a href="#" class="d-flex">
                                <span><img src="{{url('asset/customer/assets/images/cuppon_icon.svg')}}" alt="icon">
                                    APPLY COUPON</span>
                                <img src="{{url('asset/customer/assets/images/arrow_right.svg')}}" alt="arrow">
                            </a>
                        </div>

                        <div class="bill_details">
                            <h4>Bill Details</h4>
                            <div class="total_item pb-1">
                                <span>Item Total</span>
                                <span>{{$user_data->currency ?? ''}} <span
                                        id="item_count">{{$item ?? '0'}}</span></span>
                            </div>
                            @if($resto_data->discount != 0 || $resto_data->discount != Null)

                            <div class="partner_fee">
                                <span>Restaurent Discount <img
                                        src="{{url('asset/customer/assets/images/info_icon.svg')}}" alt="info"></span>
                                <span>{{$user_data->currency ?? ''}} {{$resto_data->discount ?? '0'}}</span>
                            </div>
                            @endif

                            @if($resto_data->tax != 0 || $resto_data->tax != Null)
                            <div class="partner_fee">
                                <span>Taxes and Charges &nbsp;&nbsp;<img
                                        src="{{url('asset/customer/assets/images/info_icon.svg')}}" alt="info"></span>
                                <span>{{$user_data->currency ?? ''}} {{$resto_data->tax ?? '0'}}</span>
                            </div>
                            @endif
                            <div class="charges_tax">
                                <span>Delivery partner fee <img
                                        src="{{url('asset/customer/assets/images/info_icon.svg')}}" alt="info"></span>
                                <span>{{$user_data->currency ?? ''}} {{$resto_data->delivery_charge ?? '0'}}</span>
                            </div>
                        </div>
                        <input type="hidden" class="input-quantity" id="input-quantity"
                            value="{{base64_encode($resto_data->id)}}">

                        <a href="{{url('checkoutPage')}}">
                            <div class="to_pay_box d-flex align-items-center">
                                <span>To pay</span>
                                <span>{{$user_data->currency ?? ''}} <span
                                        id="total_amount">{{$total_amount ?? '0'}}</span></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('customer.include.footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function increment_quantity(menu_id) {
    var resto_id = $("#input-quantity").val();
    var menu_decode_id = atob(menu_id);
    var inputQuantityElement = $("#input-quantity-" + menu_decode_id);
    var item_count = $("#item_count");
    var total_amount = $("#total_amount");

    $.ajax({
        url: "addMenuItem",
        data: "menu_id=" + menu_id + "&resto_id=" + resto_id,
        type: 'get',
        beforeSend: function() {
            $("#loading-overlay").show();
        },
        success: function(response) {
            $(inputQuantityElement).val(response.quantity);
            $(item_count).html(response.items);
            $(total_amount).html(response.total_amount);
            $("#loading-overlay").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#loading-overlay").hide();
            alert("something went wrong");
        }
    });
}

function decrement_quantity(menu_id) {
    var resto_id = $("#input-quantity").val();
    var menu_decode_id = atob(menu_id);
    var inputQuantityElement = $("#input-quantity-" + menu_decode_id);
    var item_count = $("#item_count");
    var total_amount = $("#total_amount");

    $.ajax({
        url: "subtractMenuItem",
        data: "menu_id=" + menu_id + "&resto_id=" + resto_id,
        type: 'get',
        beforeSend: function() {
            $("#loading-overlay").show();
        },
        success: function(response) {
            $(inputQuantityElement).val(response.quantity);
            $(item_count).html(response.items);
            $(total_amount).html(response.total_amount);
            $("#loading-overlay").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#loading-overlay").hide();
            alert("something went wrong");
        }
    });
}
</script>