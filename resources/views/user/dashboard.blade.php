@extends('user.template')
@section('content')
<h1>Welcome to Komoverse Game Hub</h1>
<div class="row g-5">
    <div class="col-12 col-md-5">
        <div class="bg-main p-3">
            <h2>Account</h2>
            <hr>
                KOMO Username: <b>
                {{ Session::get('userdata')->komo_username }}
                </b>
                <br>
                Game Display Name:
            <span class="game-display-name">
                {{ Session::get('userdata')->in_game_display_name }}
            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-edit"></i> Change
            </button>
            </span>
            <span class="shard-amount">
                <img src="{{ url('assets/img/shard.png') }}" alt=""> {{ Session::get('userdata')->shard }} <span class="text-shard">SHARD</span>
                <a href="{{ url('topup') }}" class="ms-3 btn btn-sm btn-outline-info"><i class="fas fa-plus"></i> Topup</a>
            </span>

            <div class="pp-wrapper mt-3">
                <img src="{{ (Session::get('userdata')->profile_picture_url) ? Session::get('userdata')->profile_picture_url : url('assets/img/nopic.webp') }}" style="width: 100px" alt="">
                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#ppChangeModal"><i class="fas fa-image"></i> Change Profile Picture</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="bg-main p-3">
            <h2>Komoverse Auto-Chess Match History (dummy)</h2>
            <hr>
            <div class="history-wrapper history-p1">
                <div class="row">
                    <div class="col-2">
                        <span class="placement">#1</span>
                    </div>
                    <div class="col-7">
                        <span class="lineup">LINEUP</span>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/wolverine.png') }}" alt="">
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/ironman.png') }}" alt="">
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/thor.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/hawkeye.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/hulk.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                    </div>
                    <div class="col-3">
                        <span class="kd_ratio">
                            K / D
                        </span>
                            <span class="kill">30</span>
                            <span class="death">18</span>
                    </div>
                </div>
            </div>
            <div class="history-wrapper history-p4">
                <div class="row">
                    <div class="col-2">
                        <span class="placement">#4</span>
                    </div>
                    <div class="col-7">
                        <span class="lineup">LINEUP</span>

                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/widow.png') }}" alt="">
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/capt.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/deadpool.png') }}" alt="">
                            <img src="{{ url('assets/img/1-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/thor.png') }}" alt="">
                            <img src="{{ url('assets/img/1-star.png') }}" class="star">
                        </div>
                    </div>
                    <div class="col-3">
                        <span class="kd_ratio">
                            K / D
                        </span>
                            <span class="kill">25</span>
                            <span class="death">22</span>
                    </div>
                </div>
            </div>
            <div class="history-wrapper history-p8">
                <div class="row">
                    <div class="col-2">
                        <span class="placement">#8</span>
                    </div>
                    <div class="col-7">
                        <span class="lineup">LINEUP</span>

                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/daredevil.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/fury.png') }}" alt="">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/spiderman.png') }}" alt="">
                            <img src="{{ url('assets/img/1-star.png') }}" class="star">
                        </div>
                    </div>
                    <div class="col-3">
                        <span class="kd_ratio">
                            K / D
                        </span>
                            <span class="kill">14</span>
                            <span class="death">28</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-main p-3 mt-5">
            <h2>SHARD Transaction History</h2>
            <table class="table table-sm text-light">
                @foreach ($shard_tx as $row)
                @if ($row->tx_status != 'success')
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
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Game Display Name</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input maxlength="50" type="text" name="game-display-name" value="{{ Session::get('userdata')->in_game_display_name }}" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        <button type="button" id="submitDisplayName" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ppChangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ url('change-pp') }}" method="POST" enctype="multipart/form-data">
        @csrf

  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Please upload square image 1:1 ratio. Otherwise, your image will be stretched. <br>Support jpg, jpeg, png, bmp
        <input type="file" accept="image/png, image/jpg, image/jpeg, image/bmp" name="profile_picture" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
      </div>
    </div>
  </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $("#submitDisplayName").on('click', function() {
        var display_name = $("input[name=game-display-name]").val();
        $.ajax({
            url: '{{ url('change-display-name') }}',
            type: 'POST',
            dataType: 'text',
            data: {
                display_name: display_name,
                _token: "{{ csrf_token() }}",
            },
        })
        .always(function(result) {
            console.log(result);
            if (result == 'ok') {
                window.location.reload();
            }
        });
    });
</script>
@endsection