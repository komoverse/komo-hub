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
                <img src="{{ url('assets/img/shard.webp') }}" alt=""> {{ Session::get('userdata')->shard }} <span class="text-shard">SHARD</span>
                <a href="{{ url('topup') }}" class="ms-3 btn btn-sm btn-outline-purple"><i class="fas fa-plus"></i> Topup</a>
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
                <br>
                <div class="d-block d-md-none">
                    Solana Wallet: {!! (Session::get('userdata')->wallet_pubkey) ? substr(Session::get('userdata')->wallet_pubkey,0,5).'...'.substr(Session::get('userdata')->wallet_pubkey, (strlen(Session::get('userdata')->wallet_pubkey) - 5), 5) : '
                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#walletPopup">
                        <i class="fas fa-wallet"></i> Add Solana Wallet
                    </button>
                    '; !!}
                </div>
                <div class="d-none d-md-block">
                    Solana Wallet: {!! (Session::get('userdata')->wallet_pubkey) ? Session::get('userdata')->wallet_pubkey : '
                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#walletPopup">
                        <i class="fas fa-wallet"></i> Add Solana Wallet
                    </button>
                    '; !!}
                </div>
                <br>

            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#changePassModal">
            <i class="fas fa-lock"></i> Change Password
            </button>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="bg-main p-3">
            <h2>Komoverse Auto-Chess Match History</h2>
            <hr>
            @foreach ($autochess as $row)
            <div class="history-wrapper history-p{{ $row->placement }}" data-matchid="{{ $row->match_id }}">
                <div class="row">
                    <div class="col-2 col-md-1 p-0">
                        <span class="placement">#{{ $row->placement }}</span>
                    </div>
                    <div class="col-7 col-md-9">
                        <span class="lineup">LINEUP</span>
                        @php
                            $lineup = json_decode($row->lineup);
                            for ($star=3; $star > 0; $star--):
                                foreach ($lineup as $key => $value):
                                    $heroes_array = explode('*', $key);
                                    if ($heroes_array[0] == $star):
                        @endphp
                                <div class="lineup-icon">
                                    <img src="{{ url('assets/img/heroes-icon/'.$heroes_array[1].'.webp') }}" alt="{{ $heroes_array[1] }} icon" class="heroes-icon" onError="this.onerror=null;this.src='{{ url('assets/img/nopic.webp') }}';" 
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="{{ ucwords(str_replace('_', ' ', $heroes_array[1])) }}">
                                    <img src="{{ url('assets/img/'.$heroes_array[0].'-star.png') }}" class="star">
                                </div>
                        @php
                                    endif;
                                endforeach;
                            endfor;
                        @endphp
                    </div>
                    <div class="col-3 col-md-2">
                        <span class="kd_ratio">
                            W / L
                        </span>
                            <span class="kill">{{ $row->win }}</span>
                            <span class="death">{{ $row->lose }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            <p class="text-end">
                <a href="{{ url('match-history') }}" style="color:lime; text-decoration: none">Show More Match History >></a>
            </p>
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
            <p class="text-end">
                <a href="{{ url('shard-tx') }}" style="color:lime; text-decoration: none">Show All Shard Transaction History >></a>
            </p>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="walletPopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Solana Wallet</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button class="btn form-control btn-success" id="addPhantomDashboard">Connect Phantom Wallet</button>
        <center>
            - or -
        </center>
        <input placeholder="Manually Input Wallet Public Key" type="text" name="inputWalletPubkey" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success" id="addSolanaWalletButton"><i class="fas fa-check"></i> Save</button>
      </div>
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
<div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ url('change-password') }}" method="POST">
        @csrf
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Old Password
        <input minlength="6" type="password" name="old_password" class="form-control">
        New Password
        <input minlength="6" type="password" name="new_password" class="form-control">
        Confirm New Password
        <input minlength="6" type="password" name="confirm_password" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        <button type="submit" id="submitPasswordButton" class="btn btn-danger"><i class="fas fa-edit"></i> Change Password</button>
      </div>
    </div>
  </div>
</form>
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
        Please upload square image 1:1 ratio. Otherwise, your image will be stretched. <br>Support jpg, jpeg, png, bmp, webp
        <input type="file" accept="image/png, image/jpg, image/jpeg, image/bmp, image/webp" name="profile_picture" class="form-control">
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
    var isPhantomConnected = false;
    const isPhantomInstalled = window.phantom?.solana?.isPhantom;

    $('#addPhantomDashboard').on('click', function() {
        event.preventDefault();
        if (isPhantomInstalled) {
            window.phantom.solana.connect();
            // Check for Solana & Phantom
            provider = window.solana;
            provider.connect().then(function(value){
                console.log(value.publicKey.toString());
                $('input[name=inputWalletPubkey]').val(value.publicKey.toString());
                $('#addSolanaWalletButton').trigger('click');
            });
        }
    });

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

    $("#addSolanaWalletButton").on('click', function() {
        var walletaddress = $("input[name=inputWalletPubkey]").val();
        if (validateWallet(walletaddress)) {
            $.ajax({
                url: '{{ url('add-wallet') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    wallet_pubkey: walletaddress,
                    _token: "{{ csrf_token() }}",
                },
            })
            .always(function(result) {
                console.log(result);
                if (result.status == 'success') {
                    window.location.reload();
                } else {
                    alert(result.message);
                    $('input[name=inputWalletPubkey]').val('');
                }
            });
        } else {
            alert("Invalid Solana Wallet");
        }
    });

    function validateUsername(username) {
        var regex = /^[a-zA-Z0-9.@?#()*\+\/;\-=[\\\]\^_{|}<> ]{6,30}$/;
        return regex.test(username);
    }

    function validateWallet(wallet) {
        var regex = /^[a-zA-Z0-9]{32,44}$/;
        return regex.test(wallet);
    }

    $('.history-wrapper').on('click', function(){
        window.location.href='{{ url('match-detail') }}/'+$(this).data('matchid');
    });
</script>
@endsection