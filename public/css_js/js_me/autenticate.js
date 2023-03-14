//var base = window.location.protocol +'//' + window.location.host;
    document.write(`
    <div class="modal fade b1" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="text-dark"><i class="fa fa-key mr-2"></i>Ganti Password</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form">
    <input type="hidden" name="id" value="cpanel">

    <label>Password Lama</label>
    <div class="input-group mb-3">
    <input type="password" class="form-control" name="pass_0" id="pass_0" autofocus>
    <div class="input-group-append">
    <div class="input-group-text">
    <a href="javascript:void(0);" onclick="show('pass_0','ic_0')" title="Lihat Password">
    <div id="ic_0">
    <span class="fa fa-eye-slash text-dark"></span>
    </div>
    </a>
    </div>
    </div>
    </div>
    <label>Password Baru</label>
    <div class="input-group mb-3">
    <input type="password" class="form-control" name="pass_1" id="pass_1" required>
    <div class="input-group-append">
    <div class="input-group-text">
    <a href="javascript:void(0);" onclick="show('pass_1','ic_1')" title="Lihat Password">
    <div id="ic_1">
    <span class="fa fa-eye-slash text-dark"></span>
    </div>
    </a>
    </div>
    </div>

    </div>

    <label>Ulangi Password Baru</label>
    <div class="input-group mb-3">
    <input type="password" class="form-control" name="pass_2" id="pass_2" required>
    <div class="input-group-append">
    <div class="input-group-text">
    <a href="javascript:void(0);" onclick="show('pass_2','ic_2')" title="Lihat Password">
    <div id="ic_2">
    <span class="fa fa-eye-slash text-dark"></span>
    </div>
    </a>
    </div>
    </div>
    </div>

    </div>
    <div class="modal-footer">
    <a href="javascript:void(0);" onclick="up_pass()" class="btn btn-outline-dark"><i class="fa fa-save mr-2"></i> Ganti</a>
    </div>
    </form>
    </div>
    </div>
    </div>

    <div class="modal fade modal-top" id="lock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <br>
                <center>
                <img src="/img/dev/lock.gif" width="300">
                <br>
            <div class="modal-content">
            <small class="mt-2 float-left">
            DEFAULT PIN : <strong>0000</strong>
            <small><strong><a href="javascript:void(0);" onclick="out()" class="float-right" title="Logout"><i class="fa fa-power-off fa-border mr-2 text-danger "></i></a></strong></small>
            </small>
            <small><strong id="bti"><a href="javascript:void(0);" onclick="ubahp()">Ubah PIN ?</a></strong></small>
                <div class="container p-2">
                    <div class="row">
                        <div class="col-2 my-1">
                        </div>
                        <div class="col-2 my-1">
                            <input type="text" readonly class="form-control text-center" name="p1" id="p1">
                        </div>
                        <div class="col-2 my-1">
                            <input type="text" readonly class="form-control text-center" name="p2" id="p2">
                        </div>
                        <div class="col-2 my-1">
                            <input type="text" readonly class="form-control text-center" name="p3" id="p3">
                        </div>
                        <div class="col-2 my-1">
                            <input type="text" readonly class="form-control text-center" name="p4" id="p4">
                        </div>
                    </div>

                        <label class="mt-2" id="label">Masukkan PIN Untuk Membuka</label>

                    <div class="row">
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('1')" class="btn btn-outline-dark btn-sm d-block"><strong>1</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('2')" class="btn btn-outline-dark btn-sm d-block"><strong>2</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('3')" class="btn btn-outline-dark btn-sm d-block"><strong>3</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('4')" class="btn btn-outline-dark btn-sm d-block"><strong>4</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('5')" class="btn btn-outline-dark btn-sm d-block"><strong>5</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('6')" class="btn btn-outline-dark btn-sm d-block"><strong>6</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('7')" class="btn btn-outline-dark btn-sm d-block"><strong>7</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('8')" class="btn btn-outline-dark btn-sm d-block"><strong>8</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('9')" class="btn btn-outline-dark btn-sm d-block"><strong>9</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="kosong()" class="btn btn-outline-danger btn-sm d-block"><strong>C</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="pin('0')" class="btn btn-outline-dark btn-sm d-block"><strong>0</strong></a>
                        </div>
                        <div class="col-4 my-1">
                            <a href="javascript:void(0);" onclick="backs()"class="btn btn-outline-primary btn-sm d-block"><i class="fa fa-chevron-circle-left"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </center>
        </div>
    </div>
    `);
let role = 'lock';
let pinc = '';
function cek_lock(dt){
    if(dt=='true'){
        // startin1()
        // document.getElementById("pass_3").value='';
        $('#lock').modal({backdrop: "static"});
    }
}
function out(){
    $('#logout').modal({backdrop: "static"});
}
function ubahp(){
    role = 'change1';
    kosong();
    document.getElementById("bti").innerHTML='<a href="javascript:void(0);" onclick="batal()" class="text-danger">Batal</a>';
    document.getElementById("label").innerHTML='<label class="mt-2 text-primary">Masukkan PIN Lama Anda</label>';
    toastr.info('Masukkan PIN Lama.');
}
function step2(){
    role = 'change2';
    kosong();
    document.getElementById("label").innerHTML='<label class="mt-2 text-primary">Masukkan PIN Baru</label>';
    
}
function step3(){
    role = 'change3';
    kosong();
    document.getElementById("label").innerHTML='<label class="mt-2 text-primary">Ulangi PIN Baru</label>';
    
}
function batal(){
    role = 'lock';
    kosong();
    document.getElementById("bti").innerHTML='<a href="javascript:void(0);" onclick="ubahp()">Ubah PIN ?</a>';
    document.getElementById("label").innerHTML='<label class="mt-2" id="label">Masukkan PIN Untuk Membuka</label>';
    
}
function lock(){
    var _token = $("meta[name='csrf-token']").attr("content");
    var key = '@#@';
    var act = 'lock';
    $.post("/apps",{
        _token,key,act
    },function(result){
        if (result.success){
            kosong();
            // startin1();
            // document.getElementById("pass_3").value='';
            $('#lock').modal({backdrop: "static"});
        }else{
            toastr.error(result.errorMsg);
        }
    },'json');
}
function unlock(){
    var p1 = document.getElementById("p2").value;
    var p2 = document.getElementById("p2").value;
    var p3 = document.getElementById("p3").value;
    var p4 = document.getElementById("p4").value;
    var key = p1+p2+p3+p4;
    var act = 'unlock';
    var _token = $("meta[name='csrf-token']").attr("content");
    $.post("/apps",{
        _token,key,act
    },function(result){
        if (result.success){
            // stopin1();
            $('#lock').modal('hide');
        }else{
            kosong();
            toastr.error(result.errorMsg);
        }
    },'json');
}
function change1(){
    var p1 = document.getElementById("p2").value;
    var p2 = document.getElementById("p2").value;
    var p3 = document.getElementById("p3").value;
    var p4 = document.getElementById("p4").value;
    var key = p1+p2+p3+p4;
    var act = 'change1';
    var _token = $("meta[name='csrf-token']").attr("content");
    $.post("/apps",{
        _token,key,act
    },function(result){
        if (result.success){
            toastr.info('Masukkan PIN Baru.');
            step2();
        }else{
            kosong();
            toastr.error(result.errorMsg);
        }
    },'json');
}
function change2(){
    var p1 = document.getElementById("p2").value;
    var p2 = document.getElementById("p2").value;
    var p3 = document.getElementById("p3").value;
    var p4 = document.getElementById("p4").value;
    pinc = p1+p2+p3+p4;
    toastr.info('Ulangi PIN Baru.');
    step3();
}
function change3(){
    var p1 = document.getElementById("p2").value;
    var p2 = document.getElementById("p2").value;
    var p3 = document.getElementById("p3").value;
    var p4 = document.getElementById("p4").value;
    newpinc = p1+p2+p3+p4;
    if(pinc!=newpinc){
        toastr.error('Pengulangan PIN Tidak sama');
        step2();
    }else{
        var key = p1+p2+p3+p4;
        var act = 'change2';
        var _token = $("meta[name='csrf-token']").attr("content");
        $.post("/apps",{
            _token,key,act
        },function(result){
            if (result.success){
                toastr.success('PIN Berhasil diganti.');
                batal();
            }else{
                batal();
                toastr.error(result.errorMsg);
            }
        },'json');
    }
}
function pin(val){
    let id = get_col();
    document.getElementById(id).value=val;
    if(id=='p4'){
        if(role=='change1'){
            change1();
        }else if(role=='change2'){
            change2();
        }else if(role=='change3'){
            change3();
        }else{
            unlock();
        }
    }
}
function kosong(){
    document.getElementById("p1").value='';
    document.getElementById("p2").value='';
    document.getElementById("p3").value='';
    document.getElementById("p4").value='';
}
function backs(){
    var p2 = document.getElementById("p2").value;
    var p3 = document.getElementById("p3").value;
    var p4 = document.getElementById("p4").value;
    if(p4!=''){
        document.getElementById("p4").value='';
    }else if(p3!='' || p4!=''){
        document.getElementById("p3").value='';
        document.getElementById("p4").value='';
    }else if(p2!='' || p3!='' || p4!=''){
        document.getElementById("p2").value='';
        document.getElementById("p3").value='';
        document.getElementById("p4").value='';
    }else{
        kosong();
    }
}
function get_col(){
    if(document.getElementById("p1").value==''){
            return 'p1';
    }else if(document.getElementById("p2").value==''){
        return 'p2';
    }else if(document.getElementById("p3").value==''){
        return 'p3';
    }else{
        return 'p4';
    }
}
// document.getElementById("pass_3").addEventListener("keyup", function(event) {
//     if (event.keyCode === 13) {
//     	unlock();
// 		return false;
//     }
// });
function show(id,icon){
    var x = document.getElementById(id);
    if (x.type === "password") {
      x.type = "text";
      document.getElementById(icon).innerHTML='<span class="fa fa-eye text-success"></span>';
    } else {
      x.type = "password";
      document.getElementById(icon).innerHTML='<span class="fa fa-eye-slash text-dark"></span>';
    }
}
function keyup(id){
    var x = document.getElementById(id);
    if (x.type === "url") {
        x.type = "password";
    }
}

function g_pass(){
    document.getElementById("pass_0").value='';
    document.getElementById("pass_1").value='';
    document.getElementById("pass_2").value='';
    $('#password').modal('show');
}
function up_pass(){
    var token = $("meta[name='csrf-token']").attr("content");
    var pass_0 = document.getElementById("pass_0").value;
    if(pass_0==''){toastr.error('Password Lama Belum Di isi.');exit;}
    var pass_1 = document.getElementById("pass_1").value;
    if(pass_1==''){toastr.error('Password Baru Belum Di isi.');exit;}
    var pass_2 = document.getElementById("pass_2").value;
    if(pass_2==''){toastr.error('Confirmasi Password Belum Di isi.');exit;}
    $.ajax({
        url: "g_pass",
        type: "POST",
        dataType: "JSON",
        cache: false,
        data: {
            "pass_0": pass_0,
            "pass_1": pass_1,
            "pass_2": pass_2,
            "_token": token
        },
        success:function(r){
            if (r.success) {
                toastr.success('Password Berhasil Di Ganti.');
                $('#password').modal('hide');
            }else{
                toastr.error(r.errorMsg);
            }
        },
        error:function(e){
                toastr.error(e);
        }
    });
}
//<!--
function showTime() {
    // var a_p = "";
    var today = new Date();
    var curr_hour = today.getHours();
    var curr_minute = today.getMinutes();
    var curr_second = today.getSeconds();
    // if (curr_hour < 12) {
    // a_p = "AM";
    // } else {
    // a_p = "PM";
    // }
    // if (curr_hour == 0) {
    // curr_hour = 12;
    // }
    // if (curr_hour > 12) {
    // curr_hour = curr_hour - 12;
    // }
    curr_hour = checkTime(curr_hour);
    curr_minute = checkTime(curr_minute);
    curr_second = checkTime(curr_second);
    document.getElementById('jam').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second
    }
    // + " " + a_p
    function checkTime(i) {
    if (i < 10) {
    i = "0" + i;
    }
    return i;
    }
    setInterval(showTime, 500);
    // //-->

//====================INTERVAL INDEX START===================
// function int_maint(){
//     var _token = $("meta[name='csrf-token']").attr("content");
//     var key = '1';
//     $.post("/apps",{
//         _token,key
//     },function(result){
//         if (result.success){
//             stopin1();
//             window.location.reload();
//         }
//     },'json');
// }
// function startin1(){
//     inter1 = setInterval(int_maint, 10000);
// }
// function stopin1(){
//     clearInterval(inter1);
// }
//=====================INTERVAL INDEX END====================

