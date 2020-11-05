<div class="wallet-balance">
    <div class="row-wrap">
        <div class="text-wrap">
            <h3>Total Wallet Balance</h3>
            <p>As on <span class="date">{{date('d F Y')}}</span></p>
        </div>
        <div class="amount-wrap">
            <h3><span class="currency"></span>{{$data->currency}}<span class="amt">{{number_format((float)$wallet_data->open_balance, 2, '.', '')}}</span></h3>
        </div>
    </div>
</div>