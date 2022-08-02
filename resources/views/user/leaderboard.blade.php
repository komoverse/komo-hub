@extends('user.template')
@section('content')
<div class="row g-5">
    <div class="col-12 col-md-12">
        <div class="bg-main p-3 mt-5">
            <h2>Leaderboard {{ $type }} {{ $parameter }}</h2>
            <a href="{{ url('leaderboard/lifetime') }}" class="btn btn-outline-success">Lifetime</a>
            <a href="{{ url('leaderboard/monthly') }}" class="btn btn-outline-success">Monthly</a>
            <a href="{{ url('leaderboard/weekly') }}" class="btn btn-outline-success">Weekly</a>
            <a href="{{ url('leaderboard/daily') }}" class="btn btn-outline-success">Daily</a>
            @if ($type != 'Lifetime')
                @if ($type == 'Monthly') 
                <input class="form-control w-25 d-inline param" type="month">
                @elseif ($type == 'Weekly')
                <input class="form-control w-25 d-inline param" type="week">
                @elseif ($type == 'Daily')
                <input class="form-control w-25 d-inline param" type="date">
                @endif
            @endif
            <br>
            <br>
            <div class="table-responsive">
                <table class="table text-light" id="leaderboard_table">
                    <thead>
                      <tr>
                        <td>Rank</td>
                        <td>In-Game Name</td>
                        <td>EXP</td>
                        <td>Total Match</td>
                        <td>#1</td>
                        <td>#2</td>
                        <td>#3</td>
                        <td>#4</td>
                        <td>#5</td>
                        <td>#6</td>
                        <td>#7</td>
                        <td>#8</td>
                      </tr>
                    </thead>
                    <tbody>
                        @if (!isset($lb_data->status))
                        @php $x = 0; @endphp
                        @foreach($lb_data as $row)
                        @php $x++; @endphp
                        @if ($row->in_game_display_name == Session::get('userdata')->in_game_display_name)
                            <tr class="leaderboard_self">
                        @else
                            <tr>
                        @endif
                        <td>{{ $x }}</td>
                        <td>{{ $row->in_game_display_name }}</td>
                        <td>{{ $row->exp }}</td>
                        <td>{{ $row->total_match }}</td>
                        <td>{{ $row->placement_1 }}</td>
                        <td>{{ $row->placement_2 }}</td>
                        <td>{{ $row->placement_3 }}</td>
                        <td>{{ $row->placement_4 }}</td>
                        <td>{{ $row->placement_5 }}</td>
                        <td>{{ $row->placement_6 }}</td>
                        <td>{{ $row->placement_7 }}</td>
                        <td>{{ $row->placement_8 }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#leaderboard_table').DataTable({
            pageLength: 50,
        });
    });
    $('.param').on('change', function() {
        var parameter = $(this).val();
        window.location.href = '{{ url('leaderboard/'.strtolower($type)) }}/'+parameter;
    })
</script>
@endsection