@extends('user.template')
@section('content')
<?php var_dump($pg_data); ?>
<div class="row">
    <div class="col-12">
        <h1>Payment via Indonesian Rupiah (Virtual Account)</h1>
    </div>
    <div class="col-12 col-md-4">
        <h3>Please make payment to:</h3>
        <table class="table table-dark">
            <tr>
                <td>Bank</td>
                <td>{{ strtoupper($pg_data->bankId) }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $pg_data->addressName }}</td>
            </tr>
            <tr>
                <td>No VA</td>
                {{-- <td><span id="noVA">{{ $pg_data->address }}</span> --}}
                    <button class="btn btn-sm ms-3 btn-info" onclick="copyToClipboard('noVA')"><i class="fas fa-copy"></i></button>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{{ number_format($pg_data->amount) }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('script')
<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('#'+element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>   
@endsection