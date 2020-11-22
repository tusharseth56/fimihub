@include('customer.include.header')
<section class="banner restaurant-detail food-banner no-padding">
    <div class="slider-wrap">
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/restaurant_detail_banner.png')}}" alt="banner">
            </div>
        </div>
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/restaurant_detail_banner.png')}}" alt="banner">
            </div>
        </div>
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/restaurant_detail_banner.png')}}" alt="banner">
            </div>
        </div>
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/restaurant_detail_banner.png')}}" alt="banner">
            </div>
        </div>
    </div>
</section>
<section class="order-block">
    <div class="container">
        <div class="restaurant-info">
            <div class="info-wrap">
                <h3>{{$resto_data->name ?? ''}}</h3>
                <h5>Cuisine 1, Cuisine 2, etc.</h5>
                <span class="location">{{$resto_data->address ?? ''}}</span>
            </div>
            <div class="rating-wrap">
                <div class="col-wrap">
                    <h5>80 rating</h5>
                    <div class="img-wrap">
                        <img src="{{url('asset/customer/assets/images/rating-star.svg')}}" alt="rating star">
                    </div>
                </div>
                <div class="col-wrap">
                    <h5>Minimum Order Value</h5>
                    <h4>{{$user_data->currency ?? ''}} {{$resto_data->avg_cost ?? ''}}</h4>
                </div>
                <div class="col-wrap">
                    <h5>Delivery Time</h5>
                    <h4 class="eta">{{$resto_data->avg_time ?? ''}} Min</h4>
                </div>
            </div>
            <div class="about-wrap">
                <div class="col-wrap">
                    <h4>About</h4>
                    <p>{{$resto_data->about ?? ''}}</p>
                </div>
                <div class="col-wrap">
                    <h4>Other Details</h4>
                    <p>{{$resto_data->other_details ?? ''}}</p>
                </div>
            </div>
        </div>
        <div class="order-menu-row">
            <div class="col-menu">
                <div class="menu-block">
                    <h3>Our Menus</h3>
                    <ul>
                        @foreach($menu_cat as $m_cat)
                        <li>
                            <a href="#{{$m_cat->cat_name}}">{{$m_cat->cat_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-order">
                <div class="filter-row">
                    <div class="btn-grp">
                        <a href="#" class="btn btn-purple"><img src="{{url('asset/customer/assets/images/check.svg')}}"
                                alt=""> Veg Only</a>
                        <a href="#" class="btn btn-purple"><img src="{{url('asset/customer/assets/images/check.svg')}}"
                                alt=""> NonVeg Only</a>
                    </div>
                    <span class="filter-btn show-sidepanel" id="filterPanel">Filter</span>
                </div>

                @foreach($menu_cat as $m_cat)
                <div class="category-block" id="{{$m_cat->cat_name}}">
                    <h5>{{$m_cat->cat_name}}</h5>
                    @foreach($menu_data as $m_data)
                    @if($m_data->cat_name == $m_cat->cat_name)
                    <div class="card-wrap">
                        <div class="img-wrap">
                            <img src="{{$m_data->picture ?? url('asset/customer/assets/images/food_thumb2.png')}}"
                                alt="food1">
                        </div>
                        <div class="text-wrap">
                            <h6> {{$user_data->currency ?? ''}} {{$m_data->price ?? ''}}</h6>
                            <h5>{{$m_data->name ?? ''}}</h5>
                            <p>{{$m_data->about ?? ''}}</p>
                        </div>
                        <ul class="add-to-cart">
                            <div onClick="decrement_quantity('{{base64_encode($m_data->id)}}')">
                                <li>-</li>
                            </div>
                            <li id="input-quantity-{{$m_data->id}}">{{$m_data->quantity ?? '0'}}</li>
                            <div onClick="increment_quantity('{{base64_encode($m_data->id)}}')">
                                <li>+</li>
                            </div>
                        </ul>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
                <input type="hidden" class="input-quantity" id="input-quantity"
                    value="{{base64_encode($resto_data->id)}}">


                <div class="cart-block" @if($total_amount !=0) style="display:flex;" @endif>
                    <div class="col-left">
                        <h4>
                            <span class="totalItems" id="item_count">{{$item ?? '0'}}</span> Items
                            <span class="sep">|</span>
                            {{$user_data->currency ?? ''}} <span class="totalPrice" id="total_amount">{{$total_amount ?? '0'}}</span>
                        </h4>
                        <p>{{$resto_data->name ?? ''}}</p>
                    </div>
                    <div class="col-right">
                        <h4><a href="#">View Cart <img src="{{url('asset/customer/assets/images/cart_white.svg')}}"
                                    alt="cart white"></a></h4>
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
            $(inputQuantityElement).html(response.quantity);
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
            $(inputQuantityElement).html(response.quantity);
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