<div class="col-sidebar">
    <div class="sidebar">
        <h6>Hello! {{$data->name}}</h6>
        <ul class="nav">

            <li class="{{ request()->is('merchant/dashboard') ? 'active' : ''}}"><a
                    href="{{url('merchant/dashboard')}}">Dashboard</a></li>
            <li class="{{ request()->is('merchant/qr') ? 'active' : ''}}"><a href="{{url('merchant/qr')}}">QR Code</a>
            </li>
            <li class="{{ request()->is('merchant/businessDetails') ? 'active' : ''}}"><a
                    href="{{url('merchant/businessDetails')}}">Business Details</a></li>
            <li><a href="{{url('merchant/logout')}}">Logout</a></li>
        </ul>
    </div>
</div>