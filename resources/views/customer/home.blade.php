@include('customer.include.header')

<section class="banner food-banner no-padding">
    <div class="slider-wrap">
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/food_banner.png')}}" alt="food banner">
            </div>
            <div class="content-wrap">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="text-wrap">
                            <h1>Discover Restaurant & Delicious Food</h1>
                            <p>It's very easy to create stylish and beautiful prototypes for your future projects, both
                                graphical and dynamic.</p>
                            <a href="#" class="btn btn-lg btn-white">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/food_banner.png')}}" alt="food banner">
            </div>
            <div class="content-wrap">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="text-wrap">
                            <h1>Discover Restaurant & Delicious Food</h1>
                            <p>It's very easy to create stylish and beautiful prototypes for your future projects, both
                                graphical and dynamic.</p>
                            <a href="#" class="btn btn-lg btn-white">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item">
            <div class="bg-img">
                <img src="{{url('asset/customer/assets/images/food_banner.png')}}" alt="food banner">
            </div>
            <div class="content-wrap">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="text-wrap">
                            <h1>Discover Restaurant & Delicious Food</h1>
                            <p>It's very easy to create stylish and beautiful prototypes for your future projects, both
                                graphical and dynamic.</p>
                            <a href="#" class="btn btn-lg btn-white">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="card-grid">
    <div class="container">
        <div class="grid-container">
            <div class="intro-row">
                <div class="intro-wrap">
                    <h3>Our Most Popular Restaurant</h3>
                    <h5>Fresh Food Gurantee</h5>
                </div>
                <!-- <span class="filter-btn show-sidepanel" id="filterPanel">Filter</span> -->
            </div>
            <div class="row-wrap">
                @foreach($resto_data as $r_data)
                <div class="col-wrap">
                    <div class="card-wrap">
                        <a href="{{url('restaurentDetails')}}{{'?resto_id='}}{{base64_encode($r_data->id)}}">
                            <div class="img-wrap">
                                <img src="{{$r_data->picture ?? url('asset/customer/assets/images/resto_thumbnail.png')}}"
                                    alt="restaurant">
                                <div class="img-cutout"></div>
                                <span class="rating">4.1 (60+)</span>
                            </div>
                            <div class="text-wrap">
                                <h6>{{$r_data->name ?? ''}}</h6>
                                <span class="eta">{{$r_data->avg_time ?? '--'}}</span>
                                <p>{{$r_data->about ?? ''}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

                <div class="btn-wrap">
                    <a href="#" class="btn btn-transparent btn-lg">See All</a>
                </div>
            </div>
            <div class="grid-container">
                <div class="intro-row">
                    <div class="intro-wrap">
                        <h3>Vegetarian Options</h3>
                        <h5>Fresh Food Gurantee</h5>
                    </div>
                    <span class="filter-btn">Filter</span>
                </div>
                <div class="row-wrap">
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg1.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegetarian Stew</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg2.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegan Feast</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg3.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Tofu With Chickpeas</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg3.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Tofu With Chickpeas</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg1.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegetarian Stew</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg2.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegan Feast</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a href="#" class="btn btn-transparent btn-lg">See All</a>
                </div>
            </div>
            <div class="grid-container">
                <div class="intro-row">
                    <div class="intro-wrap">
                        <h3>Offers Near You</h3>
                        <h5>Fresh Food Gurantee</h5>
                    </div>
                    <span class="filter-btn">Filter</span>
                </div>
                <div class="row-wrap">
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/offer5.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Curry goat/mutton/chicken</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg2.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegan Feast</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg3.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Tofu With Chickpeas</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg2.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegan Feast</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg3.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Tofu With Chickpeas</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-wrap">
                        <div class="card-wrap">
                            <a href="#">
                                <div class="img-wrap">
                                    <img src="{{url('asset/customer/assets/images/veg1.png')}}" alt="veg">
                                    <div class="img-cutout"></div>
                                    <span class="rating">4.1 (60+)</span>
                                </div>
                                <div class="text-wrap">
                                    <h6>Vegetarian Stew</h6>
                                    <span class="eta">20 Min</span>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a href="#" class="btn btn-transparent btn-lg">See All</a>
                </div>
            </div>
        </div>
</section>
@include('customer.include.footer')