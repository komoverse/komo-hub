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


                <br>
                Email: <b>
                {{ Session::get('userdata')->email }}
                </b>
                <br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="switchNotification" {{ (Session::get('userdata')->game_newsletter_subscribe == 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switchNotification">Send Game Update Notification via Email</label>
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
                            <img src="{{ url('assets/img/heroes-icon/kuli.webp') }}" alt="" class="heroes-icon">
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/banshee.webp') }}" alt="" class="heroes-icon">
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/raven.webp') }}" alt="" class="heroes-icon">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/shi_wudu.webp') }}" alt="" class="heroes-icon">
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/baby_dragon.webp') }}" alt="" class="heroes-icon">
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
                            <img src="{{ url('assets/img/heroes-icon/lucifer.webp') }}" alt="" class="heroes-icon"> 
                            <img src="{{ url('assets/img/3-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/kunoichi.webp') }}" alt="" class="heroes-icon"> 
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/rasputin.webp') }}" alt="" class="heroes-icon"> 
                            <img src="{{ url('assets/img/1-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/raphael.webp') }}" alt="" class="heroes-icon"> 
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
                            <img src="{{ url('assets/img/heroes-icon/butcher.webp') }}" alt="" class="heroes-icon"> 
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/venom.webp') }}" alt="" class="heroes-icon"> 
                            <img src="{{ url('assets/img/2-star.png') }}" class="star">
                        </div>
                        <div class="lineup-icon">
                            <img src="{{ url('assets/img/heroes-icon/azrael.webp') }}" alt="" class="heroes-icon"> 
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
        6-30 character
        <input maxlength="30" minlength="6" type="text" name="game-display-name" value="{{ Session::get('userdata')->in_game_display_name }}" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        <button disabled="disabled" type="button" id="submitDisplayName" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
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
    $('input[name=game-display-name]').on('change paste keyup focusout', function(){

        var display_name = $("input[name=game-display-name]").val();
        if (validateUsername(display_name)) {
            console.log('valid');
            $('#submitDisplayName').removeAttr('disabled');
        } else {
            $('#submitDisplayName').attr('disabled','disabled');
            console.log('invalid');
        }
    });
    $("#submitDisplayName").on('click', function() {
        var display_name = $("input[name=game-display-name]").val();
        if (validateUsername(display_name)) {
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
        } else {
            console.log("invalid");
        }
    });

    $("#switchNotification").on('click', function() {
        var switch_value = $("#switchNotification").is(':checked');
        var switch_num = 0;
        if (switch_value) {
            switch_num = 1;
        }

        $.ajax({
            url: '{{ url('change-game-notif') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                switch_num: switch_num,
                _token: "{{ csrf_token() }}",
            },
        })
        .always(function(result) {
            console.log(result);
            if (result.status == 'success') {
                window.location.reload();
            }
        });
    });

    function validateUsername(username) {
        var regex = /^[a-zA-Z0-9.@?#()*\+\/;\-=[\\\]\^_{|}<> ]{6,30}$/;
        return regex.test(username);
    }
</script>
@endsection