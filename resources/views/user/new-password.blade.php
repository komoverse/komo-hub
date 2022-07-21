@extends('user.before-login-template')
@section('content')
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
            <form action="{{ url('reset-password') }}" method="POST">
                @csrf
                <input type="hidden" name="hash" value="{{ $hash }}">
                New Password
                <input type="password" name="new_password" class="form-control mt-1 mb-2">
                Confirm Password
                <input type="password" name="confirm_password" class="form-control mt-1 mb-2">
                <i id="pass-mismatch" class="form-validation red" style="display: none">Password not match<br></i>
                <button class="btn form-control btn-success" disabled="disabled"><i class="fas fa-edit"></i> &nbsp; Reset Password</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    function revalidatePassword() {
        var pass1 = $('input[name=new_password]').val();
        var pass2 = $('input[name=confirm_password]').val();
        if (pass1 != '') {
            if (pass1 === pass2) {
                $("#pass-mismatch").hide();
                $('button').removeAttr('disabled');
            } else {
                $("#pass-mismatch").show();
                $('button').attr('disabled', 'disabled');
            }
        } else {
            $("#pass-mismatch").hide();
        }
    }

    $('input[type=password]').on('change paste keyup', function(){
        revalidatePassword();
    });
</script>
@endsection