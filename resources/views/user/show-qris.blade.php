@extends('user.template')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Payment via Indonesian Rupiah (QRIS)</h1>
        <h3>Please scan this QRIS with your preferred payment applications.</h3>
        <img src="{{ $pg_data->QRIS }}" style="max-height: 70vh; max-width: 100%" alt="">
    </div>
</div>
@endsection