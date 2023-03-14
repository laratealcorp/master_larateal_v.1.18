@extends('layouts.frame')
@section('content')
<link rel="stylesheet" href="css_js/summernote/summernote-bs4.min.css">
<script src="css_js/summernote/summernote-bs4.min.js"></script>
<style>.image_upload>input {display: none;}</style>
<!-- TOP NAVIGASI START -->
<div class="btr">
    <a href="" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
    <!-- <a href="" class="btn-sm bg-1 r10" title="Reload"><i class="fa fa-paint-brush mr-2"></i>PENGATURAN UI</a> -->
</div>
<!-- BODY START -->
<div class="container mt-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fab fa-joget mr-2 mb-3"></i><strong><small>{{ strtoupper('PENGATURAN Aplikasi') }}</small></strong></a>
    </center>

    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card bg-1">
                    <div class="col">
                        <small>
                            <strong>
                                NB : KLICK LOGO UNTUK MENGGANTI.
                                <div class="small">&nbsp;&nbsp;Extension : 'png','svg'</div>
                            </strong>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col">
                                <small>
                                    <strong>
                                        Logo Aplikasi
                                    </strong>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-6">
                        <center>
                            <small><strong><small>POSITIFE</small></strong></small>
                            <span class="image_upload">
                                <label for="btn_logo_p">
                                    <a class="btn" rel="nofollow" id="btn_img">
                                        <div id="logo_p">
                                            <img src="img/{{logo()}}" width="100%">
                                        </div>
                                    </a>
                                </label>
                                <input type="file" name="btn_logo_p" id="btn_logo_p">
                            </span>
                        </center>
                    </div>
                    <div class="col-md-12 col-6">
                        <center>
                            <small><strong><small>NEGATIFE</small></strong></small>
                            <span class="image_upload">
                                <label for="btn_logo_n">
                                    <a class="btn" rel="nofollow" id="btn_img">
                                        <div id="logo_n">
                                            <img src="img/{{logo_n()}}" width="100%">
                                        </div>
                                    </a>
                                </label>
                                <input type="file" name="btn_logo_n" id="btn_logo_n">
                            </span>
                        </center>
                    </div>
                </div>

            </div>
            <div class="col-md-10">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Nama Aplikasi
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="app_name_lb"><strong>{{ inc('app_name') }}</strong></div>
                                    <input type="text" id="app_name" style="height: 23px;" value="{{ inc('app_name')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_app_name" class="float-right" onclick="pass_e('app_name')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_app_name" class="float-right" onclick="save('app_name')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Judul
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="app_title_lb"><strong>{{ inc('app_title') }}</strong></div>
                                    <input type="text" id="app_title" style="height: 23px;" value="{{ inc('app_title')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_app_title" class="float-right" onclick="pass_e('app_title')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_app_title" class="float-right" onclick="save('app_title')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Nama Instansi
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="app_instansi_lb"><strong>{{ inc('app_instansi') }}</strong></div>
                                    <input type="text" id="app_instansi" style="height: 23px;" value="{{ inc('app_instansi')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_app_instansi" class="float-right" onclick="pass_e('app_instansi')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_app_instansi" class="float-right" onclick="save('app_instansi')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Email
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="email_lb"><strong>{{ inc('email') }}</strong></div>
                                    <input type="text" id="email" style="height: 23px;" value="{{ inc('email')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_email" class="float-right" onclick="pass_e('email')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_email" class="float-right" onclick="save('email')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            No. Telp / Fax
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="telp_lb"><strong>{{ inc('telp') }}</strong></div>
                                    <input type="text" id="telp" style="height: 23px;" value="{{ inc('telp')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_telp" class="float-right" onclick="pass_e('telp')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_telp" class="float-right" onclick="save('telp')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            No. HP / Wa
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="hp_lb"><strong>{{ inc('hp') }}</strong></div>
                                    <input type="text" id="hp" style="height: 23px;" value="{{ inc('hp')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_hp" class="float-right" onclick="pass_e('hp')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_hp" class="float-right" onclick="save('hp')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Slogan
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="slogan_lb"><strong>{{ inc('slogan') }}</strong></div>
                                    <input type="text" id="slogan" style="height: 23px;" value="{{ inc('slogan')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_slogan" class="float-right" onclick="pass_e('slogan')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_slogan" class="float-right" onclick="save('slogan')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Alamat
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="alamat_lb"><strong>{{ inc('alamat') }}</strong></div>
                                    <input type="text" id="alamat" style="height: 23px;" value="{{ inc('alamat')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_alamat" class="float-right" onclick="pass_e('alamat')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_alamat" class="float-right" onclick="save('alamat')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                        <x>Deskripsi<a href="javascript:voit(0);" data-toggle="modal" data-target="#edit1" class="float-right" title="Edit"><i class="fa fa-edit text-success"></i></a></x>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                           <div id="app_desk_lb"> {!!inc("app_desk")!!}</div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="card bg-1">
                            <div class="col">
                                <small>
                                    <strong>
                                        TAMPILAN LOGIN
                                    </strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <x>
                                Login Backround
                                <a href="javascript:voit(0);" class="float-right image_upload" title="Ganti">
                                    <label for="btn_img_wave">
                                        <i class="fa fa-edit text-success"></i>
                                    </label>
                                    <input type="file" name="btn_img_wave" id="btn_img_wave">
                                </a>
                            </x>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div id="wave_l">
                                <img src="img/dev/{{ login_wave() }}" alt="wave" width="30%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <x> Login Deskripsi<a href="javascript:voit(0);" data-toggle="modal" data-target="#edit2" class="float-right" title="Edit"><i class="fa fa-edit text-success"></i></a></x>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                           <div id="login_desk_lb"> {!!inc("login_desk")!!}</div>
                        </div>
                    </div>
                </div>

                
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="card bg-1">
                            <div class="col">
                                <small>
                                    <strong>
                                        PLAY STORE
                                    </strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            Status
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="play_status" id="play_status1" onclick="r_save('play_status','true')"" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="play_status" id="play_status2" onclick="r_save('play_status','false')"" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                              Url
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="play_url_lb"><strong>{{ inc('play_url') }}</strong></div>
                                    <input type="text" id="play_url" style="height: 23px;" value="{{ inc('play_url')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_play_url" class="float-right" onclick="pass_e('play_url')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_play_url" class="float-right" onclick="save('play_url')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                        <x>Deskripsi<a href="javascript:voit(0);" data-toggle="modal" data-target="#edit3" class="float-right" title="Edit"><i class="fa fa-edit text-success"></i></a></x>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                           <div id="play_desk_lb"> {!!inc("play_desk")!!}</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-12 mb-2">
                <div class="card bg-1">
                    <div class="col">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- BODY END -->
<!-- Start Modal 1 -->
<div class="modal fade" id="edit1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_user"><i class="fa fa-edit mr-2"></i>Edit App Deskripsi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="app_desk" id="app_desk" class="form-control" rows="6"><?= inc("app_desk") ?></textarea>
            </div>

            <div class="modal-footer">
                <a href="javasript:void(0);" onclick="save('app_desk');" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i>Save</a>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_user"><i class="fa fa-edit mr-2"></i>Edit Deskripsi login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body rol-400">

                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="login_desk" id="login_desk" class="form-control" rows="6"><?= inc("login_desk") ?></textarea>
            </div>

            <div class="modal-footer">
                <a href="javasript:void(0);" onclick="save('login_desk');" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i>Save</a>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="edit3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_user"><i class="fa fa-edit mr-2"></i>Edit Deskripsi login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body rol-400">

                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="play_desk" id="play_desk" class="form-control" rows="6"><?= inc("play_desk") ?></textarea>
            </div>

            <div class="modal-footer">
                <a href="javasript:void(0);" onclick="save('play_desk');" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i>Save</a>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- End Modal 1-->

<script type="text/javascript">
    $('#app_desk').summernote({
        height: 600,
        // themes:paper,
        airMode: false
    })
    $('#login_desk').summernote({
        height: 600,
        // themes:paper,
        airMode: false
    })
    $('#play_desk').summernote({
        height: 600,
        // themes:paper,
        airMode: false
    })

    var play_status = "{{inc('play_status','1')}}";
    if (play_status == 'true') {
        document.getElementById('play_status2').checked = false;
        document.getElementById('play_status1').checked = true;
    } else {
        document.getElementById('play_status1').checked = false;
        document.getElementById('play_status2').checked = true;
    }

    $('#app_name_lb').show();
    $('#app_name').hide();
    $('#bt_s_app_name').hide();
    $('#bt_e_app_name').show();
    $('#app_title_lb').show();
    $('#app_title').hide();
    $('#bt_s_app_title').hide();
    $('#bt_e_app_title').show();
    $('#app_instansi_lb').show();
    $('#app_instansi').hide();
    $('#bt_s_app_instansi').hide();
    $('#bt_e_app_instansi').show();
    $('#email_lb').show();
    $('#email').hide();
    $('#bt_s_email').hide();
    $('#bt_e_email').show();
    $('#telp_lb').show();
    $('#telp').hide();
    $('#bt_s_telp').hide();
    $('#bt_e_telp').show();
    $('#hp_lb').show();
    $('#hp').hide();
    $('#bt_s_hp').hide();
    $('#bt_e_hp').show();
    $('#alamat_lb').show();
    $('#alamat').hide();
    $('#bt_s_alamat').hide();
    $('#bt_e_alamat').show();
    $('#slogan_lb').show();
    $('#slogan').hide();
    $('#bt_s_slogan').hide();
    $('#bt_e_slogan').show();
    $('#play_url_lb').show();
    $('#play_url').hide();
    $('#bt_s_play_url').hide();
    $('#bt_e_play_url').show();
    //===========================================
    function pass_e(id) {
        $('#bt_e_' + id).hide();
        $('#bt_s_' + id).show();
        $('#' + id + '_lb').hide();
        $('#' + id).show();
        $('#' + id).focus();
    }
    //===========================================
    //===========================================
        function pass_x(id) {
        $('#' + id).hide();
        $('#' + id + '_lb').show();
        $('#bt_s_' + id).hide();
        $('#bt_e_' + id).show();
    }
    //===========================================
    //===========================================
    function save(id) {
        var token = $("meta[name='csrf-token']").attr("content");
        var val = document.getElementById(id).value;
        var col = 'code';
        $.ajax({
            url: "update_inc",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                "_token": token,id,val,col
            },
            success:function(r){
                if (r.success) {
                    document.getElementById(id + '_lb').innerHTML = val ;
                    $.messager.show({
                        title: 'Success !',
                        msg: 'Berhasil Di Save'
                    });
                    pass_x(id);
                    $("#edit2").modal('hide');
                    $("#edit1").modal('hide');
                    $("#edit3").modal('hide');
                }else{
                    pass_x(id);
                    $.messager.show({
                        title: 'Error !',
                        msg: r.errorMsg
                    });
                }
            }
        });
    }
    //===========================================
    //===========================================
    function r_save(id,val) {
        var token = $("meta[name='csrf-token']").attr("content");
        var col = 'status';
        $.ajax({
            url: "update_inc",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                "_token": token,id,val,col
            }
        });
    }
    //===========================================
    //===========================================
    $(document).ready(function() {
    $('#btn_logo_p').on('change', function() {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = 'app_logo';
        var url = 'upload_logo';
        var property = document.getElementById('btn_logo_p').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        if (e !== 'png' && e !== 'svg') {
            toastr.error('Logo Extensi Harus [ png , svg].');
            exit;
        }
        var form_data = new FormData();
        form_data.append("file", property);
        form_data.append("_token", token);
        form_data.append("id", id);

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                toastr.success('Logo Positife Berhasil Di Ganti.');
                $('#logo_p').html(data);
            }
        });
    });
    $('#btn_logo_n').on('change', function() {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = 'app_logo_n';
        var url = 'upload_logo';
        var property = document.getElementById('btn_logo_n').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        if (e !== 'png' && e !== 'svg') {
            toastr.error('Logo Extensi Harus [ png , svg].');
            exit;
        }
        var form_data = new FormData();
        form_data.append("file", property);
        form_data.append("_token", token);
        form_data.append("id", id);

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                toastr.success('Logo Negatife Berhasil Di Ganti.');
                $('#logo_n').html(data);
            }
        });
    });
    $('#btn_img_wave').on('change', function() {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = 'login_wave';
        var url = 'upload_logo';
        var property = document.getElementById('btn_img_wave').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        if (e !== 'png' && e !== 'svg' && e !== 'jpg' && e !== 'jpeg') {
            toastr.error('Logo Extensi Harus [ png , svg, jpg, jpeg].');
            exit;
        }
        var form_data = new FormData();
        form_data.append("file", property);
        form_data.append("_token", token);
        form_data.append("id", id);

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                toastr.success('img backround Berhasil Di Ganti.');
                $('#wave_l').html(data);
            }
        });
    });
});
//===========================================
</script>
@endsection