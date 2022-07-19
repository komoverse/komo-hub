<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Komoverse Hub</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/b71ce7388c.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                font-size: 3rem;
                font-weight: bold;
            }
            .history-wrapper .lineup,
            .history-wrapper .kd_ratio {
                display: block;
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
            }
            .history-wrapper .lineup-icon img {
                width: 40px;
            }
            .history-wrapper .lineup-icon .star {
                position: absolute;
                bottom: 0;
                left: 5px;
                width: auto;
                height: 10px;
                text-align: center;
            }
            .btn-outline-success {
                border-color: limegreen;
                color: limegreen;
            }
        </style>
    </head>
    <body class="text-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-1 nav-wrapper bg-main text-light min-vh-100">
                    <img src="{{ url('assets/img/favicon.webp') }}" style="width: 90px" class="mt-3" alt="">
                    <nav class="nav flex-column mt-2">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <i class="fas fa-chart-line"></i>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ url('topup') }}">
                            <i class="fas fa-donate"></i>
                        Topup Shard</a>
                        <a class="nav-link" href="{{ url('shard-tx') }}">
                            <i class="fas fa-history"></i>
                        Shard History</a>
                        {{-- <a class="nav-link" href="{{ url('redeem') }}">Redeem Shard</a> --}}
                        <a class="nav-link" href="{{ url('logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        Logout</a>
                    </nav>
                </div>
                <div class="col-12 col-md-11 py-3 px-5">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('script')
    </body>
</html>