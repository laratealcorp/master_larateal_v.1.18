@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="Upload Modul"><i class="fa fa-upload fa-sm"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="cek_data();" class="btn-sm btn-warning r20" title="Repair"><i class="fa fa-wrench fa-sm"></i></a>
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="m-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fab fa-mix mr-2 mb-3"></i><strong><small>MODUL {{($class=='fc')?'FUNCTION':strtoupper($class)}} V.{{VERSION}}</small></strong></a>
    </center>
    <div class="my-2 table-responsive">
        {{-- {{base77();}} --}}
        {{-- {{file_encode_larateal(DIR.'mod/modul_pesan_001.bin')}} --}}
        {{-- {{file_decode_larateal_28071986(DIR.'mod/modul_pesan_001.bin')}} --}}
        <center>
            <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="true" pagination="true" url="/modul{{($class)?'/'.$class:'';}}" pageSize="25" pageList="[10,25,50,100,200]">
                <thead>
                    <tr>
                        <th field="id" align="left">ID</th>
                        @if($class==null)
                        <th field="class" align="center" sortable="true"><small>CLASS</small></th>
                        @endif
                        <th field="name" align="left">NAME</th>
                        <th field="version" align="center"><small>VERSI</small></th>
                        <th field="status" formatter="show_status" sortable="true" align="left"><small>STATUS</small></th>
                        <th field="dir" formatter="show_val" sortable="true" align="center"><small>DIR</small></th>
                        <th field="tb" formatter="show_val" sortable="true" align="center"><small>DATABASE</small></th>
                        <th field="sidebar" formatter="show_val" sortable="true" align="center"><small>SIDEBAR</small></th>
                        <th field="model" formatter="show_val" sortable="true" align="center"><small>MODELS</small></th>
                        <th field="view" formatter="show_val" sortable="true" align="center"><small>VIEW</small></th>
                        {{-- <th field="control" formatter="show_val" sortable="true" align="center"><small>CONTROLLERS</small></th> --}}
                        <th field="url" formatter="show_doc" align="center"><i class="fab fa-github" title="Github"></i></th>
                        <th field="autor" align="left"><small>AUTOR</small></th>
                        <th field="created_at" formatter="tgl_up" align="center"><small>UPLOAD TIME</small></th>
                        <th field="date" formatter="date" align="center"><small>CREATE DATE</small></th>
                    </tr>
                </thead>
            </table>
        </center>
    </div>

</div>
<!-- BODY END -->
<!-- TOOLBAR START -->
<div id="toolbarCustomer">
    <div class="row p-1">
        <div class="col-md-6">
            <!---------SEARCH BOX START--------->
            <input id="search" class="easyui-searchbox" data-options="prompt:'Cari..',searcher:doSearchCustomer,
            inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                keyup: function(e){
                    var t = $(e.data.target);
                    var opts = t.searchbox('options');
                    t.searchbox('setValue', $(this).val());
                    opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                }
            })" style="width:100%;"></input>
            <script>
                function doSearchCustomer() {
                    // $('#dg').datagrid('loadData',{url:'search_record.php'});
                    $('#dguser').datagrid('load', {
                        search: $('#search').val()
                    });
                }
            </script>
            <!---------SEARCH BOX END----------->
        </div>

    </div>
</div>
<!-- TOOLBAR END -->
<!-- RIGHT BUTTON START -->
<div id="mm" class="easyui-menu" style="border: 0px;">
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="unduh();"><i class="fa fa-download mr-2"></i> Unduh</a>
    <a id="subakses"></a>
</div>
<!-- RIGHT BUTTON END -->
<!-- Start Modal 1 -->
<div class="modal fade" id="form_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="head"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fm" method="post">
                    <label>File<small>[ Ext : .bin  ]</small></label>
                    <input type="file" class="form-control" id="file" name="file">
                </form>
            </div>
            <div class="modal-footer">
                <div id="btnact"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal 1-->
<script>
var _token = $("meta[name='csrf-token']").attr("content");
//==========================================================
function show_status(val, row) {
    for (var name in row) {
        return (row.status=='true')?'<i class="btn fa fa-check text-success"></i>Ter Install':'<i class="btn fa fa-times text-danger"></i>Belum di install';
    }
}
//==========================================================
//==========================================================
function show_doc(val, row) {
    for (var name in row) {
        return (row.url=='')?'':'<a href="'+row.url+'" target="_blank"><i class="btn fa fa-book"></i></a>';
    }
}
//==========================================================
//==========================================================
function show_val(val, row) {
    for (var name in row) {
        return (val=='true')?'<i class="btn fa fa-check text-success"></i>':'<i class="btn fa fa-times text-danger"></i>';
    }
}
//==========================================================
//==========================================================
function tgl_up(val, row) {
        for (var name in row) {
            return (row.created_at != "") ? moment(row.created_at).format('DD/MM/YYYY hh:mm') : '--';
        }
    }
//==========================================================
//==========================================================
function date(val, row) {
        for (var name in row) {
            let date = moment.unix(row.date);
            return (row.date != "") ? moment(date).format('DD/MM/YYYY') : '--';
        }
    }
//==========================================================
//==========================================================
$(function() {
        $('#dguser').datagrid({
            singleSelect: true,
            onRowContextMenu: function(e, index, row) {
                $(this).datagrid('selectRow', index);
                e.preventDefault();
                if (row) {
                        if (row.status == 'true') {
                            document.getElementById('subakses').innerHTML = `
                            <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="unins();"><i class="fa fa-ban text-danger mr-2"></i>Uninstall</a>`;
                        } else {
                            document.getElementById('subakses').innerHTML = `
                            <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="ins();"><i class="fa fa-leaf text-success mr-2"></i>Install</a>
                            <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="destroyuser();"><i class="fa fa-trash mr-2 text-danger mr-2"></i> Hapus</a>`;
                        }
                    $('#mm').menu('show', {
                        left: e.pageX,
                        top: e.pageY
                    });
                } else {
                    $.messager.show({ // show error message
                        title: 'Error',
                        msg: 'Harus memilih baris data'
                    });
                }
            },
            onDblClickRow: function() {
                var row = $('#dguser').datagrid('getSelected');
                if (row) {
                    $('#fm').form('load', row);
                   
                } 
            },
            rowStyler: function(index, row) {
                if (row.role == '0') {
                    // return 'font-weight:bold;color:#9c4503;';
                }
            }

        })

    })
//==========================================================
//==========================================================
$('#file').on('change', function() {
    show_load();
        var url = '/modul_upload';
        var property = document.getElementById('file').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        if(image_extension!='bin'){
            hid_load(1000);
            msg('Failed !','Extensi Harus .bin');
            return;
        }
        var form_data = new FormData();
        form_data.append("zip_file", property);
        form_data.append("_token", _token);

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(r) {
                hid_load(1000);
                $('#dguser').datagrid('reload');
                msg('Success!','Berhasil di upload.');
                $('#form_modal').modal('hide');
            },
            error: function(e) {
                hid_load(1000);
                msg('Failed !','Modul Sudah Ada atau Error');
            }
        });
    });
//==========================================================
//==========================================================
function destroyuser() {
    var row = $('#dguser').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>Modul Name : ' + row.name, function(r) {
            if (r) {
                show_load();
                var url = '/modul_delete';
                var id = row.id;
                    $.post(url, {
                            _token, id
                        }, function(r) {
                            hid_load(1000);
                        if (r.success) {
                            $('#dguser').datagrid('reload');
                            msg('Success !','Berhasil Di hapus.');
                        } else {
                            msg('Error',r.errorMsg);
                        }
                    }, 'json');
            }
        });
    }
}
//==========================================================
//==========================================================
function add(){
    document.getElementById("file").value='';
    document.getElementById("head").innerHTML='<h5 class="modal-title"><i class="fa fa-upload mr-2"></i>Upload Modul</h5>';
    $('#form_modal').modal('show');
}
//==========================================================
//==========================================================
function unduh(){
    var row = $('#dguser').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Attention!', 'Unduh Modul : ' + row.name, function(r) {
            if (r) {
                var file = 'mod/'+row.id+'.bin'
                $.post('/get_exists', {
                        _token, file
                    }, function(r) {
                        if (r.success) {
                            window.location.href=file;
                        } else {
                            msg('Error',r.errorMsg);
                        }
                    }, 'json');
            }
        });
    }
}
//==========================================================
//==========================================================
function ins(){
var row = $('#dguser').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Attention!', 'Apakah Anda Yakin Ingin Menginstall Modul ini ?<br>Modul Name : ' + row.name, function(r) {
            if (r) {
                show_load();
                var url = '/modul_install';
                    var id = row.id;
                    $.post(url, {
                        _token, id
                    }, function(r) {
                        if (r.success) {
                            $.post('/mig_'+id, {
                                _token
                            }, function(r) {
                                hid_load(1000);
                                if (r.success) {
                                    $('#dguser').datagrid('reload');
                                    msg('Success !','Berhasil Di install.');
                                } else {
                                    msg('Error',r.errorMsg);
                                }
                            }, 'json');
                        } else {
                            hid_load(1000);
                            msg('Error',r.errorMsg);
                        }
                    }, 'json');
            }
        });
    }
}
//==========================================================
//==========================================================
function unins(){
    var row = $('#dguser').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Uninstall Modul ini ?<br>Modul Name : ' + row.name, function(r) {
            if (r) {
                show_load();
                var url = '/modul_uninstall';
                var id = row.id;
                    $.post(url, {
                        _token, id
                    }, function(r) {
                        hid_load(1000);
                        if (r.success) {
                            $('#dguser').datagrid('reload');
                            msg('Success !','Berhasil Di Uninstall.');
                        } else {
                            msg('Error',r.errorMsg);
                        }
                    }, 'json');
            }
        });
    }
}
//==========================================================
//==========================================================
function cek_data(){
    $.messager.confirm('Attention!', 'Repair Modul ? ', function(r) {
        if (r) {
            show_load();
            $('#dguser').datagrid('reload');
               var url = '/modul_cek';
            $.post(url,{
                    _token
                },function(r){
                    hid_load(1000);
                    if (r.success){
                        $('#dguser').datagrid('reload');
                        msg('Success!','Repair Selesai.');
                    }else{
                        msg('Error!',r.errorMsg);
                    }
            },'json');
        }
    });
}
//==========================================================
</script>
@endsection