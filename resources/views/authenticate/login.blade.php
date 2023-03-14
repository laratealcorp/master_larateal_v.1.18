@extends('layouts.authenticate')
@section('content')

<img class="wave" src="img/dev/{{ login_wave() }}">
<div class="container">

    <div class="img">
        <div class="m-2">
            {!! inc('login_desk') !!}
        </div>
    </div>
    <div class="login-content">
        <form>
            <div id="content"></div>
            <div id="bodi">
                <img src="img/{{ logo() }}">
                <h4 class="title">{{ inc('app_name') }}</h4>
                <br>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email / No.Hp</h5>
                        <input type="text" class="input" name="email" id="email">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" id="password">
                    </div>
                </div>
                <br>
                @if (inc('app_register',1)=='true')
                    <a href="register" class="float-start"><strong>Registrasi</strong></a>
                @endif
                @if (inc('app_forgot',1)=='true')
                   <a href="forgot" class="float-end"><strong>Lupa Password?</strong></a>
                @endif
                <br>
                <center>
                    <a href="javascript:void(0);" onclick="login()" class="btn">Login</a>
                </center>
                @if (inc('web_status',1)=='true')
                <a href="/"><strong>Website</strong></a>
                @endif
                <strong>© {{ cpr()}} <br> {{ inc('app_instansi') }} </strong>
            </div>
        </form>
    </div>

</div>
@if (session()->has('errorMsg'))
  <script>toastr.error('{{session("errorMsg")}}');</script>
@endif
<script>
function login() {
    var username = document.getElementById("email");
    var password = document.getElementById("password");
    var token = $("meta[name='csrf-token']").attr("content");
    if (username.value == '') {
        toastr.error('Username Belum Di isi.');
        username.focus();
        return;
    }
    if (password.value == '') {
        toastr.error('Password Belum Di isi.');
        password.focus();
        return;
    }
    waiting('1','');
    // document.getElementById("form").submit();
    $.ajax({
        url: "login",
        type: "POST",
        dataType: "JSON",
        cache: false,
        data: {
            "user_id": username.value,
            "password": password.value,
            "_token": token
        },
        success:function(r){
            if (r.success) {
                toastr.info('Login Berhasil.');
                setTimeout(() => {
                    window.location.reload();
                }, 3000);

            }else{
                toastr.error(r.errorMsg);
                waiting('1','hide');
            }
        },
        error:function(e){
                toastr.error(e);
                waiting('1','hide');
           }
    });
}
$('body').on("keyup", function(event) {
    if (event.keyCode === 13) {
        login();
        return false;
    }
});
</script>

@endsection
