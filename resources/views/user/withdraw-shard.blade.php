@extends('user.template')
@section('content')
@if ($restriction->status == 'error')
<div class="row">
    <div class="col-12">
        <h1>Withdraw SHARD</h1>
        <div class="alert alert-danger">
            
        <h4>
        Your account restricted to withdraw SHARD for following reason:
        </h4>
        <ul>
        @foreach ($restriction->restriction as $row)
            <li>{{ $row }}</li>
        @endforeach
        </ul>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <h1>Withdraw SHARD</h1>
        <form action="withdraw" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-md-3">
                    Amount SHARD to Withdraw
                </div>
                <div class="col-12 col-md-4">
                    <input type="number" name="amount" class="form-control mb-1">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    Withdraw To
                </div>
                <div class="col-12 col-md-4">
                    <select name="wd_to" id="" class="form-select mb-1">
                        <option value="USDT">USDT</option>
                        <option value="USDC">USDC</option>
                        <option value="IDR_ovo">OVO (IDR)</option>
                        <option value="IDR_gopay">Gopay (IDR)</option>
                        <option value="IDR_dana">Dana (IDR)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    Wallet Address
                </div>
                <div class="col-12 col-md-4">
                    <input type="text" name="wd_wallet" class="form-control mb-1">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    Phone Number
                </div>
                <div class="col-12 col-md-4">
                    <input type="text" name="wd_phone" class="form-control mb-1 number_only">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-4">
                    * <i>Withdrawal request may take up to 24 hours</i>
                    <button type="submit" class="btn btn-warning">Request Withdrawal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
@section('script')
  <script>
  $('.number_only').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
  </script>
@endsection