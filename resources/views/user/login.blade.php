<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Komoverse Hub Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b71ce7388c.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            a {
                color: lime;
                text-decoration: none;
            }
        </style>
    </head>
    <body style="background: #aaa">
        <div class="container">
            <div class="row my-5">
                <div class="col"></div>
                <div class="col-12 col-md-4 my-5 bg-dark text-light p-5">
                    <div class="text-center">
                        <img src="{{ url('assets/img/logo.png') }}" alt="">
                    </div>
                    @if (session('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        Username
                        <input type="text" name="username" class="form-control my-1">
                        Password
                        <input type="password" name="password" class="form-control mt-1 mb-2">
                        <button class="btn form-control btn-success"><i class="fas fa-sign-in-alt"></i> &nbsp; Login</button>
                    </form>
                    <center>
                    - or -
                    </center>
                    <a href="{{ url('register') }}" class="btn form-control btn-outline-success"><i class="fas fa-edit"></i> &nbsp; Register</a>
                    <br>
                    <a href="{{ url('forgot-password') }}">Lost your password?</a>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </body>
</html>