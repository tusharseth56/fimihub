@extends('customer.layout.myAccountBase')

@section('title', 'My Account')

@section('content')

<div class="content-col">
    <div class="info-box">
        <div class="form-title">
            <h5>Manage Address</h5>
        </div>
        <div class="inner-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="addrs_box new_addrs_box h-100">
                        <div>
                            <h4>Add New Address</h4>
                            <!-- <p>W End Rd, West End, Jamaica</p> -->
                        </div>
                        <div class="addrs_action_btns">
                            <button type="button" class="btn_purple edit_btn hover_effect1 show-sidepanel"
                                id="addressPanel">Add New</button>
                        </div>
                    </div>
                </div>
                
                @foreach($user_address as $user_add)
                <div class="col-md-6">
                    <div class="addrs_box saved_addrs">
                        <h4>{{$user_data->name}}</h4>
                        <p>{{$user_add->flat_no ?? ''}} {{$user_add->address ?? ''}}</p>
                        <p>{{$user_add->landmark ?? ''}}</p>
                        <br>
                        <!-- <span><img src="{{url('asset/customer/assets/images/watch.svg')}}" alt="watch">20 Min</span> -->
                        <div class="addrs_action_btns">
                            <button type="button" class="btn_purple edit_btn mr-2 hover_effect1">delete</button>
                            <button type="button" class="btn_purple deliver_btn hover_effect1">Edit</button>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection