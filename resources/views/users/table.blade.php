@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<link rel="stylesheet" href="/css_js/summernote/summernote-bs4.min.css">
<script src="/css_js/summernote/summernote-bs4.min.js"></script>
<link rel="stylesheet" href="/css_js/crop/croppie.css">
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="ADD"><i class="fa fa-plus"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="manual()" class="btn-sm btn-info r20" title="Manual Book"><i class="fa fa-book fa-sm"></i></a>
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="m-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="far fa-user mr-2 mb-3"></i><strong><small>Level : {{ strtoupper($l->name) }}</small></strong></a>
    </center>

    <div class="col-md-12 table-responsive">
        <center>
            <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;height: 400px;" fitColumns="true" rowNumbers="false" pagination="true" url="/user_get/{{$l->id}}" pageSize="10" pageList="[10,25,50,75,100,125,150,200]">
                <thead>
                    <tr>
                        <th field="pur_foto" formatter="show_foto" align="center">Foto</th>
                        <th field="nama" width="200" sortable="true">Nama</th>
                        <th field="email" sortable="true">Email</th>
                        <th field="hp" sortable="true">No.HP/WA</th>
                        <th field="last_login" sortable="true">Last Login</th>
                        <th field="jk" sortable="true" align="center">JK</th>
                        <th field="sub" sortable="true" align="center">Hak Akses</th>
                        <th field="pur_status" formatter="show_status">
                            <center><i class="far fa-user" title="AKTIVE / BLOKIR"></i></center>
                        </th>
                    </tr>
                </thead>
            </table>
        </center>
    </div>
</div>
<!-- BODY END -->
<!-- BODY END -->
<div id="toolbarCustomer">
    <div class="row p-1">
        <div class="col-md-3">
            <!---------SEARCH BOX START--------->
            <input id="searchCustomer" class="easyui-searchbox" data-options="prompt:'Cari..',searcher:doSearchCustomer,
            inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                keyup: function(e){
                    var t = $(e.data.target);
                    var opts = t.searchbox('options');
                    t.searchbox('setValue', $(this).val());
                    opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                }
            })
        " style="width:100%;"></input>
            <script>
                //-----------------------------------------start
                function doSearchCustomer() {
                    $('#dguser').datagrid('load', {
                        search: $('#searchCustomer').val()
                    });
                }
                //-----------------------------------------end
            </script>
            <!---------SEARCH BOX END----------->
        </div>
    </div>
</div>
<div id="mm" class="easyui-menu">
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="biodata();"><span id="tumb-user"></span>Profil</a>
    <a id="btnwa"></a>
    <a id="btnwar"></a>
    <!-- <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="all_history();"><i class="fa fa-download mr-2"></i>All.History</a> -->
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update();"><i class="far fa-edit mr-2"></i> Edit</a>
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="destroyuser('res');"><i class="fa fa-key mr-2"></i>R.Password</a>
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="destroyuser('pin');"><i class="fa fa-lock mr-2"></i>R.PIN</a>
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="status();"><span id="btn-status"></span></a>
    <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="destroyuser('del');"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>
</div>
<!-- Start Modal 1 -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div id="head"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body rol-300">
                <form id="fm" method="post">
                    <input type="hidden" id="_token" name="_token">
                    <input type="hidden" id="level" name="level">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="action" name="action">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-2">
                                <small>Pilih Hak Akses :</small>
                                <div class="row">
                                    <?php $no=1; ?>
                                    @foreach($aa as $a)
                                    <div class="col-md-6">
                                    <input type="radio" name="akses" id="akses{{$no++}}" class="mr-2" value="{{$a->id}}" style="height:24px;">{{$a->sub}}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($scm1 as $s1)
                            <small>{{$s1->label}} <small>[ {{($s1->wajib=='YA')?'Wajib':'Optional';}} ]</small></small>
                                @if($s1->tag=='input')
                                   <input type="{{$s1->type}}" name="{{$s1->name}}" id="{{$s1->name}}" class="{{$s1->class}}" style="height:24px;">
                                @elseif($s1->tag=='textarea')
                                   <textarea name="{{$s1->name}}" id="{{$s1->name}}" cols="30" rows="2" class="{{$s1->class}} mb-2"></textarea>
                                @else
                                    {!!$s1->code!!}
                                @endif
                                {!! $s1->script !!}
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            @foreach($scm2 as $s2)
                            <small>{{$s2->label}} <small>[ {{($s2->wajib=='YA')?'Wajib':'Optional';}} ]</small></small>
                                @if($s2->tag=='input')
                                   <input type="{{$s2->type}}" name="{{$s2->name}}" id="{{$s2->name}}" class="{{$s2->class}}" style="height:24px;">
                                @elseif($s2->tag=='textarea')
                                   <textarea name="{{$s2->name}}" id="{{$s2->name}}" cols="30" rows="2" class="{{$s2->class}} mb-2"></textarea>
                                @else
                                    {!!$s2->code!!}
                                @endif
                                    {!! $s2->script !!}
                            @endforeach
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" onclick="save();" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i>Save</a>
            </div>


        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="foto" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <a onclick="cmod();" class="btn" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <div id="cont1" class="container my-3">
                <input type="file" id="upload_image" class="form-control" accept="image/*">
            </div>
            <div id="cont2" class="container mty-3">
                <a class="btn btn-outline-primary btn-sm crop_image d-block"> <i class="fa fa-crop mr-2"></i>Crop & Upload</a>
            </div>
            <div id="temp_foto"></div>
        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="manual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-book mr-2"></i>Manual Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    ===TABLE=== <br>
                    -Doubel klick baris data untuk mengganti foto. <br>
                    -klick kanang baris data jika desktop <br>
                    dan sentuh tahan jika hp untuk menu user <br>
                    ---Menu User--- <br>
                    *-Profil menuju profil user <br>
                    *-Whatsapp untuk mengirim pesan whatsapp -> aksi ini membutuhkan koneksi Endpoint<br>
                    *-Edit untuk edit data user <br>
                    *-R.Password untuk mereset password <br>
                    *-R.PIN untuk mereset PIN <br>
                    [ default password tertera pada notifikasi ] <br>
                    *-Blokir/Aktifkan untuk Blokir atau Aktifkan user <br>
                    *-Hapus untuk menghapus user <br>
                    ---Menu User--- <br>
                    ===INPUT=== <br>
                    -Email dan No.Hp merupakan User login <br>
                    jadi tidak boleh sama dengan user lain atau kosong <br>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
</div>
<!-- End Modal 1-->
<!---------------------------croppie start--------------------------------->
<script src="/css_js/crop/croppie.min.js"></script>
<!---------------------------croppie end----------------------------------->
<script type="text/javascript">
    var token = $("meta[name='csrf-token']").attr("content");
    var level = "{{$l->id}}";
    //-----------------------------------------start
    function validasi() {
        @foreach($scm as $s)
            @if($s->validasi)
            {!!$s->validasi!!}
            @endif
        @endforeach
    }
    // -----------------------------------------end
    //-----------------------------------------start
    function initial() {
        @foreach($scm as $s)
            @if($s->init)
            {!!$s->init!!}
            @endif
        @endforeach
    }
    // -----------------------------------------end
    //-----------------------------------------start
    function manual() {
        $('#manual').modal('show');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function cmod() {
        $('#foto').modal('hide');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function add() {
        $('#fm').form('clear');
        document.getElementById("_token").value = token;
        document.getElementById("level").value = level;
        initial();
        document.getElementById("akses1").checked = true;
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Tambah Data</h5>';
        document.getElementById("id").value = 'insert';
        $('#modal').modal('show');

    }
    //-----------------------------------------end
    //-----------------------------------------start
    function update() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $('#fm').form('load', row);
              document.getElementById("_token").value = token;
              document.getElementById("level").value = level;
            document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Data</h5>';
            $('#modal').modal('show');
        } else {
            msg('Error','Data tidak di pilih');
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function biodata() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            window.location = '/profil/' + row.id;
        } else {
            msg('Error','Data tidak di pilih');
        }
    }
    //-----------------------------------------end
        // -----------------------------------------start
        function save() {
            validasi();
            $('#fm').form('submit', {
                url: '/user_crud',
                onSubmit: function() {
                    return $(this).form('validate');
                },
                success: function(result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        msg('Error',result.errorMsg);
                    } else {
                        $('#modal').modal('hide');
                        $('#dguser').datagrid('reload');
                        msg('Success !','Berhasil');
                    }
                }
            });
    }
    // -----------------------------------------end
    //-----------------------------------------start
    function destroyuser(val) {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            if (val == 'del') {
                $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>Nama : ' + row.nama, function(r) {
                    if (r) {
                        $.post("/user_delete", {
                           "_token":token, id: row.id,level
                        }, function(result) {
                            if (result.success) {
                                $('#dguser').datagrid('reload');
                                msg('Success !','Berhasil Di Hapus');
                            } else {
                                msg('Error',result.errorMsg);
                            }
                        }, 'json');
                    }
                });
            } else if (val == 'pin') {
                $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Mereset PIN User ini ?<br>PIN Reset : 0000 <br>Nama User : ' + row.nama, function(r) {
                    if (r) {
                        $.post("/user_rpin", {
                           "_token":token, id: row.id,level
                        }, function(result) {
                            if (result.success) {
                                $('#dguser').datagrid('reload');
                                msg('Success !','PIN berhasil di reset');
                            } else {
                                msg('Error',result.errorMsg);
                            }
                        }, 'json');
                    }
                });
            } else {
                $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Mereset Password User ini ?<br>Password Reset : {{inc('pass_default')}} <br>Nama User : ' + row.nama, function(r) {
                    if (r) {
                        $.post("/user_rpass", {
                            "_token":token, id: row.id,level
                        }, function(result) {
                            if (result.success) {
                                $('#dguser').datagrid('reload');
                                msg('Success !','Password Berhasil Di Reset');
                            } else {
                                msg('Error',result.errorMsg);
                            }
                        }, 'json');
                    }
                });
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function status() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            if (row.status == 'true') {
                $.messager.confirm('Confirm', 'Apakah Anda ingin memblokir user <br>' + row.nama + ' ?', function(r) {
                    if (r) {
                        $.post("/user_ban", {
                            "_token":token, id: row.id,level
                        }, function(result) {
                            if (result.success) {
                                $('#dguser').datagrid('reload');
                                msg('Success !','Berhasil Di Blokir');
                            } else {
                                msg('Error',result.errorMsg);
                            }
                        }, 'json');
                    }
                });
            } else {
                $.messager.confirm('Confirm', 'Apakah Anda ingin mengaktifkan user <br>' + row.nama + ' ?', function(r) {
                    if (r) {
                        $.post("/user_ban", {
                            "_token":token, id: row.id,level
                        }, function(result) {
                            if (result.success) {
                                $('#dguser').datagrid('reload');
                                msg('Success !','Berhasil Di Aktifkan');
                            } else {
                                msg('Error',result.errorMsg);
                            }
                        }, 'json');
                    }
                });
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_foto(val, row) {
        for (var name in row) {
            if (row["foto"] == null) {
                var t = '<img src="/img/avatar/' + row["jk"] + '2.png" class="rounded elevation-2 m-1" width="34" alt="' + row["nama"] + '">';
            } else {
                var t = '<img src="/img/avatar/' + row["foto"] + '" class="rounded elevation-2 m-1" width="34" alt="' + row["nama"] + '">';
            }
            if (row["pur_foto"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_status(val, row) {
        for (var name in row) {
            if (row["status"] == 'true') {
                var t = '<i class="fa fa-check btn-sm text-success"></i>';
            } else {
                var t = '<i class="fa fa-times btn-sm text-danger"></i>';
            }
            if (row["pur_status"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_akses(val, row) {
        for (var name in row) {
            var t = '<strong>' + document.getElementById(row.akses).value + '</strong>';
            if (row["pur_akses"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    $(function() {
        var base = '';
        $('#dguser').datagrid({
            data: '',
            singleSelect: true,
            onRowContextMenu: function(e, index, row) {
                if (row.status == 'true') {
                    document.getElementById("btn-status").innerHTML = '<i class="fa fa-times text-danger mr-2"></i>Blokir';
                } else {
                    document.getElementById("btn-status").innerHTML = '<i class="fa fa-check text-success mr-2"></i>Aktifkan';
                }
                if (row.foto == null) {
                    var tumb = '<img src="/img/avatar/' + row.jk + '2.png" class="rounded elevation-2 mr-2" width="14">';
                } else {
                    var tumb = '<img src="/img/avatar/' + row.foto + '" class="rounded elevation-2 mr-2" width="14">';
                }
                document.getElementById("tumb-user").innerHTML = tumb;
                $(this).datagrid('selectRow', index);
                e.preventDefault();
                $('#mm').menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            },
            onDblClickRow: function() {
                var row = $('#dguser').datagrid('getSelected');
                if (row) {
                    document.getElementById("id").value = row.id;
                    // if(row.foto==''){
                    // var t = '<img src="'+base+'assets/avatar/'+row.jk+'.png" class="rounded elevation-2 m-1" width="60%" alt="'+row.nama+'">';
                    // }else{
                    //     var t = '<img src="'+base+'assets/avatar/'+row.foto+'" class="rounded elevation-2 m-1" width="60%" alt="'+row.nama+'">';
                    // }
                    // document.getElementById("show_ttd").innerHTML='';
                    $('#foto').modal('show');
                }
            },
            rowStyler: function(index, row) {
                if (row.status == 'false') {
                    return 'color:red;font-weight:bold;';
                }
            }
        })

    })
    //-----------------------------------------end
    $('#cont2').hide();
    $('#cont1').show();
    //==========================================================
    $('#foto').on('shown.bs.modal', function() {
        $('#cont2').hide();
        $('#cont1').show();
        $image_crop = $('#temp_foto').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 400,
                type: 'square'
            }, //circle
            boundary: {
                width: 300,
                height: 400
            }
        });
        $('#temp_foto').hide();
    });
    $('#foto').on('hidden.bs.modal', function() {
        $('#temp_foto').croppie('destroy');
        $('#cont2').hide();
        $('#cont1').show();
    });
    // setInterval(function() {},1000);
    //==========================================================
    //==========================================================
    $('#upload_image').on('change', function() {
        $('#temp_foto').show();
        $('#cont1').hide();
        $('#cont2').show();
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        // console.log(document.getElementById("id").value);
    });
    //==========================================================
    //==========================================================
    $('.crop_image').click(function(event) {
        var id = document.getElementById("id").value;
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "/user_crop_img",
                type: "POST",
                data: {
                    "_token": token,
                    "image": response,
                    id,
                    level
                },
                success: function(data) {
                    $('#foto').modal('hide');
                    $('#crop').modal('hide');
                    $('#dguser').datagrid('reload');
                    msg('Success !','Foto berhasil di ganti');
                }
            });
        });
    });
    //==========================================================
</script>
@endsection
