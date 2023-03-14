@extends('layouts.frame')
@section('content')
<link rel="stylesheet" href="css_js/crop/croppie.css">
<style>.image_upload>input{display: none;}</style>
<!-- TOP NAVIGASI START -->
<div class="btl">
    <a href="javascript:void(0);" onclick="cetak();" class="btn-sm btn-danger r20" title="Print"><i class="fa fa-print fa-sm"></i></a>
</div>
<div class="btr">
    <a href="" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<div class="container mt-2">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-id-card mr-2 mb-3"></i><strong><small>{{ hb('Profil saya')}}</small></strong></a>
        </center>
    <div class="row m-1">
        <div class="col-md-3">
            <div class="row">
                <div class="mb-2 col-md-12">

                    <div id="cr1">
                        <div class="">
                            <div class="my-3">
                                <a href="javascript:void(0);" class="btn-sm crop_image bg-1"> <i class="fa fa-crop mr-2"></i>Crop</a>
                                <a href="javascript:void(0);" onclick="cmod();" class="btn-sm bg-1 float-right"><i class="fa fa-times"></i></a>
                            </div>
                            <img id="temp_foto"></img>
                        </div>
                    </div>
                    <div class="text-center" id="cr2">
                        <!-- <div class="container"> -->
                        <span class="image_upload">
                            <label for="btn_logo_pl">
                                <a class="btn" rel="nofollow" id="btn_img">
                                    <div id="logo_p">
                                        <img src="img/avatar/{{avatar($o->jk,$o->foto)}}" width="100%" class="img-fluit" style="border-radius:10px;">
                                    </div>
                                </a>
                            </label>
                            <input type="file" name="btn_logo_p" id="btn_logo_pl">
                        </span>
                        <!-- </div> -->
                        <div class="small mb-2">
                            <small>
                                <strong>
                                    KLICK FOTO UNTUK MENGGANTI. <br>
                                </strong>
                                &nbsp;&nbsp;Extension : 'png','jpg','jpeg','gif','webp'
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-9">

            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Nama</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-10">
                                <div id="nama_lb"><strong>{{$o->nama}}</strong></div>
                                <input type="text" id="nama" style="height: 23px;" value="{{$o->nama}}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                    <a href="javascript:void(0);" id="bt_e_nama" class="float-right" onclick="pass_e('nama')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                    <a href="javascript:void(0);" id="bt_s_nama" class="float-right" onclick="save('nama','1')"><i class="fa fa-save" title="Save"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Email</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-12">
                                <div><strong>{{$o->email}}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;No Hp/Whatsapp</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-12">
                                <div><strong>{{$o->hp}}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Jenis Kelamin</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="jk" id="jk1" onclick="r_save('jk','L','1')" class="mr-2" value="L">Laki-Laki
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="jk" id="jk2" onclick="r_save('jk','P','1')" class="mr-2" value="P">Perempuan
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            @foreach($ss as $s)
            <?php $name = $s->name ?>
                        <!-- BATAS GARIS 1 -->
                        <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;{{$s->label}}</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-10">
                                <div id="{{$s->name}}_lb"><strong>{{$x->$name}}</strong></div>
                                <input type="text" id="{{$s->name}}" style="height: 23px;" value="{{$x->$name}}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                    <a href="javascript:void(0);" id="bt_e_{{$s->name}}" class="float-right" onclick="pass_e('{{$s->name}}')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                    <a href="javascript:void(0);" id="bt_s_{{$s->name}}" class="float-right" onclick="save('{{$s->name}}','2')"><i class="fa fa-save" title="Save"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            @endforeach
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Tanggal Register</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <strong>{{($o->created_at)?date("d-m-Y", strtotime($o->created_at)):'--'}}</strong>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            
        </div>
    </div>
</div>
<script type="text/javascript">
    //-----------------------------------------start
function cetak() {
    window.open("/cetak_profil/{{$o->id}}", "mywindow", "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=auto,height=auto,left =304,top = 150.5");
    testwindow.moveTo(0, 0);
}
//-----------------------------------------end
    $('#nama_lb').show();
    $('#nama').hide();
    $('#bt_s_nama').hide();
    $('#bt_e_nama').show();
    @foreach($ss as $s)
    $('#{{$s->name}}_lb').show();
    $('#{{$s->name}}').hide();
    $('#bt_s_{{$s->name}}').hide();
    $('#bt_e_{{$s->name}}').show();
    @endforeach
    //===========================================
    var jk = "{{$o->jk}}";
    if (jk == 'L') {
        document.getElementById('jk2').checked = false;
        document.getElementById('jk1').checked = true;
    } else {
        document.getElementById('jk1').checked = false;
        document.getElementById('jk2').checked = true;
    }
    //===========================================
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
    function save(id,root) {
        var token = $("meta[name='csrf-token']").attr("content");
        var val = document.getElementById(id).value;
        $.ajax({
            url: "/profil_post",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                "_token": token,id,val,root
            },
            success:function(r){
                if (r.success) {
                    document.getElementById(id + '_lb').innerHTML = '<strong>' + val + '</strong>';
                    $.messager.show({
                        title: 'Success !',
                        msg: 'Berhasil Di Save'
                    });
                    pass_x(id);
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
    function r_save(id,val,root) {
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "/profil_post",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                "_token": token,id,val,root
            }
        });
    }
    //===========================================
</script>
<!---------------------------croppie start--------------------------------->
    <script src="css_js/crop/croppie.min.js"></script>
<!---------------------------croppie end----------------------------------->
<script type="text/javascript">
    $('#cr1').hide();
    $('#cr2').show();

    function cmod() {
        $('#cr1').hide();
        $('#cr2').show();
        $('#temp_foto').croppie('destroy');
    }
</script>
<script type="text/javascript">
    $('#foto').on('hidden.bs.modal', function() {
        $('#temp_foto').croppie('destroy');
    });
    //===========================================
    $(document).ready(function() {

        $('#btn_logo_pl').on('change', function() {
            $('#cr2').hide();
            $('#cr1').show();
            var property = document.getElementById('btn_logo_pl').files[0];
            var name = property.name;
            var extension = name.split('.').pop().toLowerCase();
            var e = extension;
            if (e !== 'png' && e !== 'jpg' && e !== 'jpeg' && e !== 'gif' && e !== 'webp') {
                $('#cr1').hide();
                $('#cr2').show();
                $('#temp_foto').croppie('destroy');
                toastr.error('Extensi foto Harus [ png,jpg,jpeg,gif,webp ].');
                exit;
            }
            $image_crop = $('#temp_foto').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 240,
                    type: 'square'
                }, //circle 
                boundary: {
                    width: 200,
                    height: 240
                }
            });
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(property);
            // $('#foto').modal('show');
        });

    });
    //===========================================
    //==========================================================
    $('.crop_image').click(function(event) {
        var token = $("meta[name='csrf-token']").attr("content");
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "profil_foto",
                type: "POST",
                data: {
                    "_token": token,
                    "image": response,
                },
                success: function(data) {
                    $('#cr1').hide();
                    $('#cr2').show();
                    toastr.info('foto Berhasil Di Ganti.');
                    $('#logo_p').html(data);
                    $('#temp_foto').croppie('destroy');
                },
                error: function(data) {
                    $('#cr1').hide();
                    $('#cr2').show();
                    $('#temp_foto').croppie('destroy');
                    toastr.error('Uploa Gagal');
                }
            });
        });
    });
    //==========================================================
</script>
@endsection