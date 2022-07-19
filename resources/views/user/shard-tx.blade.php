@extends('user.template')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>SHARD Transaction History</h1>
        <h3>Sandbox Environment. QRIS is not available for transaction. Use VA and Paypal only for topup.</h3>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Source</th>
                    <th>Description</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($shard_tx as $row)
                <tr>
                    <td>{{ $row->tx_time }}</td>
                    <td>{{ $row->source }}</td>
                    <td>{{ $row->description }}</td>
                    <td>
                        @if ($row->debit_credit == 'debit')
                        <b class="text-success">+{{ $row->amount_shard }}</b>
                        @else
                        <b class="text-danger">-{{ $row->amount_shard }}</b>
                        @endif
                    </td>
                    <td>{{ $row->tx_status }}</td>
                    <td>
                        @if ($row->tx_status == 'pending')
                            @if (str_contains($row->description, 'QRIS'))
                            <a href="{{ url('topup/view/qris/'.$row->komo_tx_id) }}">
                                <i class="fas fa-qrcode"></i>
                            </a>
                            @elseif (str_contains($row->description, 'Virtual Account'))
                            <a href="{{ url('topup/view/va/'.$row->komo_tx_id) }}">
                                <i class="fas fa-money-bill-wave"></i>
                            </a>
                            @elseif (str_contains($row->description, 'Paypal'))
                            <a href="{{ url('topup/paypal/link/'.$row->komo_tx_id) }}">
                                <i class="fab fa-paypal"></i>
                            </a>
                            @endif
                        @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection