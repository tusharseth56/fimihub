<footer class="footer">
    <div class="md_container">
        <div class="row-wrap">
            <div class="col col-content">
                <h4><a href="./index.html">Fimihub</a></h4>
                <div class="content-wrap">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore</p>
                    <p>© 2020—2021, Lorem ipsum dolor sit</p>
                </div>
            </div>
            <div class="col col-links">
                <h5>Navigation</h5>
                <ul class="links">
                    <li>
                        <a href="#">Menu One</a>
                    </li>
                    <li>
                        <a href="#">Menu Two</a>
                    </li>
                    <li>
                        <a href="#">Menu Three</a>
                    </li>
                    <li>
                        <a href="#">Menu Four</a>
                    </li>
                </ul>
            </div>
            <div class="col col-info">
                <h5>Contacts</h5>
                <p>Country, city, street name 44</p>
                <p>+1 (234) 567-89-90</p>
                <p>info@collector.com</p>
            </div>
            <div class="col col-form">
                <h5>Newsletter</h5>
                <form role="form" method="POST" action="{{ url('/subscribeProcess') }}" class="subscribe-form">
                    @csrf
                    <div class="field-group">
                        <input type="email" placeholder="Enter Email ID" name="email">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                        <input type="submit" class="btn btn-purple btn-submit mt-1" value="Subscribe">
                        <!-- <a href="#" class="btn btn-purple btn-submit">Subscribe</a> -->
                    </div>
                </form>
                <ul class="social-links">
                    <li>
                        <a href="#">
                            <img src="{{url('asset/customer/assets/images/twitter.svg')}}" alt="facebook">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('asset/customer/assets/images/facebook.svg')}}" alt="facebook">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('asset/customer/assets/images/instagram.svg')}}" alt="instagram">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="side-panel left" data-panel-id="addressPanel">
    <div class="inner-sidebar">
        <div class="title">
            <div class="icon close-sidepanel">
                <img src="{{url('asset/customer/assets/images/cross.svg')}}" alt="cross">
            </div>
            <h4>Save delivery address</h4>
        </div>
        <div class="map">
            <img src="{{url('asset/customer/assets/images/map.png')}}" alt="map">
        </div>
        <form role="form" method="POST" action="{{ url('/saveAddress') }}" class="form">
            @csrf
            <div class="field-wrap">
                <label>Address</label>
                <input type="text" name="address" placeholder="Address">
                @if($errors->has('address'))
                <div class="error">{{ $errors->first('address') }}</div>
                @endif
            </div>
            <div class="field-wrap">
                <label>Door/ Flat No</label>
                <input type="text" name="flat_no" placeholder="Door/ Flat No">
                @if($errors->has('flat_no'))
                <div class="error">{{ $errors->first('flat_no') }}</div>
                @endif
            </div>
            <div class="field-wrap">
                <label>Landmark</label>
                <input type="text" name="landmark" placeholder="Landmark">
                @if($errors->has('landmark'))
                <div class="error">{{ $errors->first('landmark') }}</div>
                @endif
            </div>
            <input type="submit" class="btn btn-purple" value="Save Address">
            <!-- <button type="submit" class="btn btn-purple">Save Address</button> -->
        </form>
    </div>
</div>
<script type="text/javascript" src="{{url('asset/customer/assets/scripts/plugins/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('asset/customer/assets/scripts/plugins/slick.min.js')}}"></script>
<script type="text/javascript" src="{{url('asset/customer/assets/scripts/plugins/wow.js')}}"></script>
<script type="text/javascript" src="{{url('asset/customer/assets/scripts/main.js')}}"></script>
</body>

</html>
<!-- Subscribe Success MODAL -->
<div class="modal fade auth_modals successfull_mdl" id="forgot_psw">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal_body_head text-center">
                    <h3>
                        @if(Session::has('modal_message'))
                        {{ Session::get('modal_message') }}
                        @endif
                    </h3>
                </div>
                <div class="modal_body_content modal_body_content2 successfull_mdl_bdy text-center">
                    <img src="{{url('asset/customer/assets/images/check.png')}}" alt="checkmark">
                    <div class="forgot_psw_btn">
                        <button type="button" class="btn_purple hover_effect1 auth_btn"
                            data-dismiss="modal">BACK</button>
                    </div>

                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="side-panel right" data-panel-id="filterPanel">
    <div class="inner-sidebar">
        <div class="title">
            <div class="icon close-sidepanel">
                <img src="{{url('asset/customer/assets/images/cross.svg')}}" alt="cross">
            </div>
            <h4>Filters</h4>
        </div>
        <form action="#" class="form">
            <div class="radio-btn-block">
                <h5>Sort by</h5>
                <div class="radio-btn-wrap">
                    <input type="radio" id="fromAtoZ" name="sort" value="fromAtoZ">
                    <label for="fromAtoZ">A-Z</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="fromZtoA" name="sort" value="fromZtoA">
                    <label for="fromZtoA">Z-A</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="minOrderAmt" name="sort" value="minOrderAmt">
                    <label for="minOrderAmt">Minimum Order Amount</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="fastDelivery" name="sort" value="fastDelivery">
                    <label for="fastDelivery">Fastest Delivery</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="highToLow" name="sort" value="highToLow">
                    <label for="highToLow">Ratings: High to Low</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="lowToHigh" name="sort" value="lowToHigh">
                    <label for="lowToHigh">Ratings: Low to High</label>
                </div>
            </div>
            <div class="radio-btn-block">
                <h5>Filter By</h5>
                <div class="radio-btn-wrap">
                    <input type="radio" id="freeDelivery" name="filter" value="freeDelivery">
                    <label for="freeDelivery">Free Delivery</label>
                </div>
                <div class="radio-btn-wrap">
                    <input type="radio" id="newlyAdded" name="filter" value="newlyAdded">
                    <label for="newlyAdded">Newly Added</label>
                </div>
            </div>
            <div class="btn-grp">
                <button type="button" class="btn btn-purple close-sidepanel">Cancel</button>
                <button type="submit" class="btn btn-purple">Save Address</button>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@if(Session::has('modal_check_subscribe'))
<script>
$(window).on('load', function() {
    $('#forgot_psw').modal('show');
})
</script>
@endif