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
            @csrf
            <div id="content"></div>
            <div id="bodi">
                <img src="img/{{ logo() }}">
                <h4 class="title">{{ inc('app_name') }}</h4>
                <small><strong class="pri-c">HALAMAN REGISTRASI</strong></small>
                <br>
                <br>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                </div>
                <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fab fa-whatsapp pri-c"></i></span>
                    <input type="text" class="form-control" id="hp" placeholder="No.Hp [ Whatsapp ]">
                </div>
                <i class="fa fa-venus-mars pri-c mr-2"></i> Jenis Kelamin
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <input type="radio" class="" name="jk" id="jk1" Value="L">
                                </span>
                            <input type="text" class="form-control" value="Laki-Laki" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <input type="radio" class="" name="jk" id="jk2" Value="P">
                                </span>
                            <input type="text" class="form-control" value="Perempuan" readonly>
                        </div>
                    </div>
                </div>

                <br>
                <a href="login" class="float-start"><strong>Login</strong></a>
                @if (inc('app_forgot',1)=='true')
                   <a href="forgot" class="float-end"><strong>Lupa Password?</strong></a>
                @endif
                <br>
                <center>
                    <a href="javascript:void(0);" onclick="daftar()" class="btn">Daftar</a>
                </center>
                @if (inc('web_status',1)=='true')
                <a href="/"><strong>Website</strong></a>
                @endif
                <strong>© {{ cpr()}} <br> {{ inc('app_instansi') }} </strong>
            </div>
        </form>
    </div>

</div>
<script>
    document.getElementById("jk1").checked = true;

    function daftar() {
        var nama = document.getElementById("nama").value;
        var email = document.getElementById("email").value;
        var hp = document.getElementById("hp").value;
        var jk = $("input[type='radio'][name='jk']:checked").val();
        (nama) ? '' : [toastr.error('Nama Belum Di isi.'), $('#nama').focus(), exit];
        (email) ? '' : [toastr.error('Email Belum Di isi.'), $('#email').focus(), exit];
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!email.match(mailformat)) {
            toastr.error('Format Email Salah');
            $('#email').focus();
            exit;
        }
        (hp) ? '' : [toastr.error('No.Hp Belum Di isi.'), $('#hp').focus(), exit];
        (jk) ? '' : [toastr.error('Jenis Kelamin Belum dipilih.'), exit];
        $("#bodi").hide()
        $("#content").html(`
        <center>
            <img src="/img/dev/loading1.gif">
            <br>
            <br>
            <small><strong>Harap Menunggu...</strong></small>
        </center>
        `);
        $.post("/portal/regist", {
            nama,
            email,
            hp,
            jk
        }, function(result) {
            if (result.success) {
                $('#bodi').hide();
                $('#content').html(`
                <h3>Registrasi Berhasil !</h3><br>
                Password telah dikirim <br> ke Email atau No. Whatsapp yang anda Daftarkan
                <br>
                <br>
                <strong>
                        Nama : ` + nama + `<br>
                        Email : ` + email + `<br>
                        No.Hp [ Whatsapp ] : ` + hp + `<br>
                </strong>
                <br>
                <a href="login" class="btn-sm btn-dark bg-1-h">Login</a>
                `);
            } else {
                $("#bodi").show()
                $("#content").html('');
                toastr.error(result.errorMsg);
            }
        }, 'json');
    }
    $('body').on("keyup", function(event) {
        if (event.keyCode === 13) {
            daftar();
            return false;
        }
    });
    $('#hp').on('keypress', function(event) {
        return (((event.which > 47) && (event.which < 58)) || (event.which == 13));
    });
</script>

@endsection
