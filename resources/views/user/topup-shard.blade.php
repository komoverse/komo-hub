@extends('user.template')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Topup SHARD</h1>
    </div>
</div>
    <div class="row g-3">
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>1,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="1000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 1,000 via QRIS
                </button>
                <button data-amount="1000" disabled="disabled" class="w-100 mb-2 btn btn-outline-secondary btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> VA Not Available
                </button>
                <button data-amount="0.1" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 0.1 via Paypal
                </button>
                <button data-amount="1000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 0.1)
                </button>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>5,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="5000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 5,000 via QRIS
                </button>
                <button data-amount="5000" disabled="disabled" class="w-100 mb-2 btn btn-outline-secondary btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> VA Not Available
                </button>
                <button data-amount="0.5" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 0.5 via Paypal
                </button>
                <button data-amount="5000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 0.5)
                </button>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>10,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="10000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 10,000 via QRIS
                </button>
                <button data-amount="10000" class="w-100 mb-2 btn btn-outline-success btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> IDR 10,000 via VA
                </button>
                <button data-amount="1" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 1 via Paypal
                </button>
                <button data-amount="10000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 1)
                </button>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>25,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="25000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 25,000 via QRIS
                </button>
                <button data-amount="25000" class="w-100 mb-2 btn btn-outline-success btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> IDR 25,000 via VA
                </button>
                <button data-amount="2.5" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 2.5 via Paypal
                </button>
                <button data-amount="25000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 2.5)
                </button>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>50,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="50000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 50,000 via QRIS
                </button>
                <button data-amount="50000" class="w-100 mb-2 btn btn-outline-success btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> IDR 50,000 via VA
                </button>
                <button data-amount="5" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 5 via Paypal
                </button>
                <button data-amount="50000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 5)
                </button>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-main p-3 text-center">
                <h3>100,000 SHARD</h3>
                <img src="{{ url('assets/img/topup-shard/10.png') }}" alt="">
                <button data-amount="100000" class="w-100 mb-2 btn btn-outline-success btn-topup-idr">
                    <i class="fas fa-qrcode"></i> IDR 100,000 via QRIS
                </button>
                <button data-amount="100000" class="w-100 mb-2 btn btn-outline-success btn-topup-idrva">
                    <i class="fas fa-money-bill-wave"></i> IDR 100,000 via VA
                </button>
                <button data-amount="10" class="w-100 mb-2 btn btn-outline-warning btn-topup-paypal">
                    <i class="fab fa-paypal"></i> USD 10 via Paypal
                </button>
                <button data-amount="100000" class="w-100 mb-2 btn btn-outline-primary btn-topup-coinpayments">
                    <i class="fas fa-coins"></i> SOL via Coin Payments (equivalent USD 10)
                </button>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $('.btn-topup-idr').on('click', function(){
        var amount = $(this).data('amount');
        window.location.replace('{{ url('topup/qris').'/' }}'+amount);
    });
    $('.btn-topup-idrva').on('click', function(){
        var amount = $(this).data('amount');
        window.location.replace('{{ url('topup/idr-va').'/' }}'+amount);
    });
    $('.btn-topup-paypal').on('click', function(){
        var amount = $(this).data('amount');
        window.location.replace('{{ url('topup/paypal').'/' }}'+amount);
    });
    $('.btn-topup-paypal').on('click', function(){
        var amount = $(this).data('amount');
        window.location.replace('{{ url('topup/paypal').'/' }}'+amount);
    });
    $('.btn-topup-coinpayments').on('click', function(){
        var amount = $(this).data('amount');
        window.location.replace('{{ url('topup/coinpayments').'/' }}'+amount);
    });
</script>
@endsection