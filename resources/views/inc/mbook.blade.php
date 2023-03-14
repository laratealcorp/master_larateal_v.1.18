@extends('layouts.frame')
@section('content')
<link rel="stylesheet" href="css_js/summernote/summernote-bs4.min.css">
<script src="css_js/summernote/summernote-bs4.min.js"></script>
<style>.image_upload>input {display: none;}</style>
<!-- TOP NAVIGASI START -->
<div class="btl">
<a id="btnadd"></a>
<a id="btnclose"></a>
<a id="btnsave"></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="row m-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-book mr-2 mb-3"></i><strong><small>{{ strtoupper('Edit M-book') }}</small></strong></a>
        </center>
    </div>
<input type="hidden" id="idx">
    <div class="col-md-9 mb-2 mt-2 table-responsive">
        <div class="row">

            <div class="col-12" id="fo1">
                <center>
                    <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="true" pagination="true" url="/inc_m_book" pageSize="10" pageList="[10,25,50,75,100,125,150,200]">
                        <thead>
                            <tr>
                                <th field="pur_res" width="100%" formatter="show_res"></th>
                            </tr>
                        </thead>
                    </table>
                </center>
            </div>
            <div class="col-12" id="fo2">
                <div class="card col bg-1 mb-2">
                    <x>
                        <div id="head"></div>
                        <a href="javascript:void(0);" onclick="hid()" class="float-right pri-b mx-1" title="Close"><i class="fa fa-times"></i></a>
                    </x>
                </div>
                <form id="fm" method="post" enctype="multipart/form-data">
                <input type="hidden" id="token" name="_token">
                    <input type="hidden" id="id" name="id">
                    <div class="card col my-1">
                        <div class="row">
                            <div class="col-md-2">
                                <small><strong>TYPE</strong> :</small>
                            </div>
                            <div class="col-md-3" onclick="role()">
                                <input type="radio" class="mr-2" name="role" id="role1" value="PDF">PDF
                            </div>
                            <div class="col-md-3" onclick="role()">
                                <input type="radio" class="mr-2" name="role" id="role2" value="EDITOR">EDITOR
                            </div>
                        </div>
                    </div>
                    <div class="card col my-1">
                        <div class="row">
                            <div class="col-12">
                                <small><strong>Judul</strong></small>
                            </div>
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" placeholder="Input Judul.." style="height: 24px;" id="judul" name="judul">
                            </div>
                        </div>
                    </div>
                    <div id="con1">
                        <small><strong>Content</strong></small>
                        <textarea name="text" id="text" cols="30" rows="8" class="form-control"></textarea>
                    </div>
                    <div id="con2">
                        <small><strong>UPLOAD PDF</strong></small><br>
                        <input data-options="prompt:'ONLY PDF'" style="width: 200px;" class="easyui-filebox mb-2" id="file" name="file"><br><br>
                        <div id="pdf"></div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="col-md-3 mb-2 mt-2 table-responsive>
        <div class="container">
            <div class="">
                <strong>
                    NB :
                </strong>
                <hr>
                Doubel Klick pada baris data Untuk Edit.
                <hr>
                Untuk Menu Lain klick kanan Baris data jika dekstop dan sentuh tahan jika Mobile.
                <hr>
                Tombol Save Berada Pada Kanan Atas Disamping tombol close.
                <hr>
            </div>
        </div>
    </div>
</div>
<!-- BODY END -->
<!-- TOOLBAR START -->
<div id="toolbarCustomer">
    <div class="row p-1">
        <div class="col-md-5">
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
                        search : $('#searchCustomer').val()
                    });
                }
                //-----------------------------------------end
            </script>
            <!---------SEARCH BOX END----------->
        </div>
    </div>
</div>
<!-- TOOLBAR END -->
<!-- RIGHT BUTTON START -->
<div id="mm1" class="easyui-menu" style="border: 0px;">
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update();"><i class="far fa-edit mr-2"></i> Edit</a>
    <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="destroyuser('data');"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>
    <a id="btnhfile1"></a>
</div>
<!-- RIGHT BUTTON END -->
<a id="aaa"></a>
<script type="text/javascript">
    $('#btnadd').html('<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="TAMBAH"><i class="fa fa-plus"></i></a>');
    $('#btnsave').html('');
    $('#btnclose').html('');
    $('#con2').hide();
    $('#fo2').hide();
    $('#text').summernote({
        height: 500,
        // themes:paper,
        airMode: false
    })
    //-----------------------------------------start
    function show_res(val, row) {
        var ost = <?=$lvl?>;
        for (var name in row) {
            var t = `
            <div class="card table-responsive col my-1">
                <div class="row mt-1">
                    <div class="col-md-2">
                        <strong>JUDUL</strong>
                    </div>
                    <div class="col-md-10">
                        : ` + row.judul + `
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2">
                        <strong>TYPE</strong>
                    </div>
                    <div class="col-md-10">
                        :  ` + row.role + `
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2">
                    <strong>LEVEL DISPLAY</strong>
                    </div>
                    <div class="col-md-10">
                       <div class="row">`;
            for (i = 0; i < ost.length; i++) {
                cek = (row[ost[i].id] == '1') ? 'checked' : '';
                t += `
                    <div class="col-md-3">
                    <input type="checkbox" ` + cek + ` onclick="check('` + row.id + `','` + ost[i].id + `')" class="mr-2">` + ost[i].name + `
                    </div>
                `;
            }
            t += `</div>
                    </div>
                </div>
            </div>
            `;
            if (row["pur_res"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function hid() {
        $('#fm').form('clear');
        $('#fo2').hide();
        $('#fo1').show();
        $('#pdf').html('');
        $('#dguser').datagrid('reload');
        $('#btnadd').html('<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="TAMBAH"><i class="fa fa-plus"></i></a>');
        $('#btnsave').html('');
        $('#btnclose').html('');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function add() {
        $('#fm').form('clear');
        document.getElementById("token").value = '{{ csrf_token()}}';
        $('#fo1').hide();
        $('#fo2').show();
        $('#btnadd').html('');
        $('#btnclose').html('<a href="javascript:void(0)" onclick="hid();" class="btn-sm btn-danger r20" title="Close"><i class="fa fa-times"></i></a>');
        $('#btnsave').html('<a href="javascript:void(0)" onclick="save();" class="btn-sm btn-success r20" title="Save"><i class="fa fa-save fa-sm"></i></a>');
        document.getElementById('role2').checked = true;
        $('#text').summernote('code', '');
        $("#head").html('<small class="float-left"><i class="fa fa-plus mr-2"></i>Tambah Data</small>')
        document.getElementById("id").value = 'insert';
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function role() {
        if (document.getElementById('role1').checked) {
            $('#con1').hide();
            $('#con2').show();
        } else {
            $('#con2').hide();
            $('#con1').show();
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function update() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $('#fm').form('load', row);
            document.getElementById("token").value = '{{ csrf_token()}}';
            $('#fo1').hide();
            $('#fo2').show();
            $('#btnadd').html('');
            $('#btnclose').html('<a href="javascript:void(0)" onclick="hid();" class="btn-sm btn-danger r20" title="Close"><i class="fa fa-times"></i></a>');
            $('#btnsave').html('<a href="javascript:void(0)" onclick="save();" class="btn-sm btn-success r20" title="Save"><i class="fa fa-save fa-sm"></i></a>');
            if (row.role == 'PDF') {
                $('#pdf').html('<iframe src="/file/pdf/' + row.content + '" frameborder="0" width="100%" height="1000px"></iframe>');
                $('#text').summernote('code', '');
            }else{
                $('#text').summernote('code', row.content);
            }
            role();
            $("#head").html('<small class="float-left"><i class="fa fa-edit mr-2"></i>Edit Data</small>');
        } else {
            msg('Error', 'Data tidak di pilih');
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function check(id, row) {
        var url = '/inc_check_mbook';
        $.post(url, {
            _token:'{{ csrf_token()}}',
            id,
            row
        }, function(result) {
            if (result.success) {
                msg('Success !', 'Berhasil.');
            } else {
                msg('Error', result.errorMsg);
            }
        }, 'json');
    }
    //-----------------------------------------end
    //-----------------------------------------start

    function save() {
        ($('#judul').val() == '') ? [msg('Error', 'judul harus di isi'), $('#judul').focus(), exit] : '';
        if (document.getElementById('role2').checked) {
            ($('#text').val() == '') ? [msg('Error', 'Content harus di isi'), $('#text').focus(), exit] : '';
        }
        $('#fm').form('submit', {
            url: '/inc_crud_mbook',
            ajax: 'true',
            iframe: 'false',
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.success) {
                    if (result.id == 'insert') {
                        $('#fo2').hide();
                        $('#fo1').show();
                        $('#btnadd').html('<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="TAMBAH"><i class="fa fa-plus"></i></a>');
                        $('#btnclose').html('');
                        $('#btnsave').html('');
                    }
                    if (result.file) {
                        $('#pdf').html('<iframe src="/file/pdf/' + result.con + '" frameborder="0" width="100%" height="1000px"></iframe>');
                    }
                    $('#dguser').datagrid('reload');
                    msg('Success !', 'Berhasil Di Save');
                } else {
                    msg('Error', result.errorMsg);
                }
            }
        });
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function destroyuser(data) {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>JUDUL : <br>' + row.judul, function(r) {
                if (r) {
                    url = '/inc_crud_mbook';
                    $.post(url, {
                        _token:'{{ csrf_token()}}',id: row.id,role:'delete'
                    }, function(result) {
                        if (result.success) {
                            $('#dguser').datagrid('reload');
                            msg('Success !', 'Berhasil Di Hapus');
                        } else {
                            msg('Error', result.errorMsg);
                        }
                    }, 'json');
                }
            });
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    $(function() {
        $('#dguser').datagrid({
            singleSelect: true,
            onRowContextMenu: function(e, index, row) {
                $(this).datagrid('selectRow', index);
                e.preventDefault();
                if (row) {
                    document.getElementById('idx').value = row.id;
                } else {
                    msg('Error', 'Harus memilih baris data');
                }
                $('#mm1').menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            },
            onDblClickRow: function() {
                update();
            },
            rowStyler: function(index, row) {
                if (row.status == 'false') {
                    return 'font-weight:bold;background-color: #e60e11;color:#000;';
                }
            }

        })

    })
    //-----------------------------------------end
</script>
@endsection