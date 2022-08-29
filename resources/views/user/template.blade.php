<?php if (is_null(\Session::get('userdata'))) { header('location: '.url('login')); die(); } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Komoverse Hub</title>
        <link rel="icon" href="{{ url('assets/img/favicon.webp') }}">
        <link rel="shortcut-icon" href="{{ url('assets/img/favicon.webp') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/b71ce7388c.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <style>
            body {
                background-color: #17181c;
            }
            .bg-main {
                background-color: #212239;
            }
            .topup-shard-selection {
                border: 2px solid yellow;
            }
            .nav-wrapper {
                font-size: 0.6rem;
            }
           @media (min-width: 767.98px) {
                .nav-wrapper {
                    font-size: 0.6rem;
                    min-height: 100vh !important;
                }
            }
            .nav-wrapper .nav-link {
                padding: 5px;
                margin-bottom: 10px;
                color: white;
                text-align: center;
                font-weight: bold;
                text-transform: uppercase;
            }
            .nav-wrapper .nav-link .fas {
                color: white;
                width: 50px;
                height: 50px;
                text-align: center;
                background: linear-gradient( 180deg, #0d8721 0%, rgb(0 0 0 / 38%) 85.94%, rgb(0 0 0 / 53%) 100%, rgb(0 0 0 / 0%) 100% );
                border: 3px solid #866404;
                border-radius: 50%;
                font-size: 1.7rem;
                padding: 8px 0;
                display: inline-block;
                margin-bottom: 2px;
            }
            .account-username {
                font-weight: bold;
                display: block;
            }
            .game-display-name {
                font-weight: bold;
                color: #00b621;
                font-size: 2rem;
                display: block;
                line-height: 2.5rem;
                margin-bottom: 20px;
            }
            .shard-amount {
                font-size: 1.5rem;
                display: block;
                color: deepskyblue;
                font-weight: bold;
            }
            .text-shard {
                font-weight: normal;
            }
            .shard-amount img {
                height: 40px;
            }
            .history-wrapper {
                margin-bottom: 10px;
                padding-left: 20px;
            }
            .history-p1 {
background: rgb(35,255,0);
background: linear-gradient(90deg, rgba(35,255,0,0.7959558823529411) 0%, rgba(8,170,8,0) 100%);
            }
            .history-p4 {
background: rgb(76,159,63);
background: linear-gradient(90deg, rgba(76,159,63,0.7959558823529411) 0%, rgba(8,170,8,0) 100%);
            }
            .history-p8 {
background: rgb(152,0,0);
background: linear-gradient(90deg, rgba(152,0,0,0.9948354341736695) 0%, rgba(8,170,8,0) 100%);
            }
            .history-wrapper .placement {
                font-size: 2.5rem;
                font-weight: bold;
            }
            .history-wrapper .lineup,
            .history-wrapper .kd_ratio {
                display: block;
                font-size: 0.8rem;
            }
            .history-wrapper .kill {
                font-size: 1.6rem;
                font-weight: bold;
                color: lime;
            }
            .history-wrapper .death {
                font-size: 1.6rem;
                font-weight: bold;
                color: red;
            }
            .history-wrapper .lineup-icon {
                display: inline-block;
                position: relative;
                margin-bottom: 5px;
            }
            .history-wrapper .lineup-icon img {
                width: 35px;
            }
            .history-wrapper .lineup-icon .star {
                position: absolute;
                bottom: 0;
                left: 3px;
                width: auto;
                height: 10px;
                text-align: center;
            }
            .btn-outline-success {
                border-color: limegreen;
                color: limegreen;
            }
            .heroes-icon {
                border-radius: 50%;
                border: 2px solid orangered;
            }
            .leaderboard_self td {
                color: lime;
            }
            .menu-stipes {
                color: white;
                text-decoration: none;
                font-size: 2rem;
                float: right;
                margin-top: 15px;
                margin-right: 20px;
            }
        </style>
    </head>
    <body class="text-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-1 nav-wrapper bg-main text-light">
                    <img src="{{ url('assets/img/favicon.webp') }}" style="width: 90px" class="mt-3 d-none d-md-block" alt="">
                    <img src="{{ url('assets/img/favicon.webp') }}" style="height: 60px" class="my-2 d-inline-block d-md-none" alt="">
                    <a class="menu-stipes d-inline-block d-md-none flex-right" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="collapse d-md-block" id="collapseExample">
                        <nav class="nav flex-column mt-2">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                                <i class="fas fa-chart-line"></i>
                                Dashboard
                            </a>
                            <a class="nav-link" href="{{ url('leaderboard') }}">
                                <i class="fas fa-award"></i>
                                Leaderboard
                            </a>
                            <a class="nav-link" href="{{ url('topup') }}">
                                <i class="fas fa-donate"></i>
                                Topup Shard
                            </a>
                            <a class="nav-link" href="{{ url('shard-tx') }}">
                                <i class="fas fa-history"></i>
                                Shard History
                            </a>
                            {{-- <a class="nav-link" href="{{ url('redeem') }}">Redeem Shard</a> --}}
                            <a class="nav-link" href="{{ url('logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-md-11 py-3 px-md-5">
                    <div class="container-fluid">
                        @if (Session::get('userdata')->is_verified == 0)
                        <div class="alert alert-warning" role="alert">
                            Your Email is Not Verified. Please <a href="{{ url('resend-verify-email') }}">Click Here</a> to Resend Your Verification Email.
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('script')
        <script>
            $('.datatable').DataTable();
        </script>
    </body>
</html>