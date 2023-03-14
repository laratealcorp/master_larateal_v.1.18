@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="ADD"><i class="fa fa-plus"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="row m-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-th-list mr-2 mb-3"></i><small><strong>{{ hb('sidebar')}}</strong></small></a>
        </center>
    </div>
    <div class="col-md-8 my-2 table-responsive">
        <center>
            <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="false" pagination="true" url="get_sidebar" pageSize="1000" pageList="[10,25,50,100,200,500,1000,2000,5000]">
                <thead>
                    <tr>
                        <th field="pur_col1" width="300px" formatter="show_col1" align="left">SIDEBAR-1</th>
                        <th field="pur_col2" width="300px" formatter="show_col2" align="left">SIDEBAR-2</th>
                        <th field="pur_col3" width="300px" formatter="show_col3" align="left">SIDEBAR-3</th>

                    </tr>
                </thead>
            </table>
        </center>
    </div>
    <div class="col-md-4 mb-2 mt-2 table-responsive">
        <div class="container">
            <strong>
                NB : <br>
                <small>
                    Doubel Klick pada baris data Untuk Edit Data. <br>
                    Klick kanang jika desktop dan sentuh tahan jika mobile untuk menu lain.
                </small>
            </strong><br>
            <div class="text-danger">
                <strong>
                    Attention!
                </strong><br>
                Hati-hati dalam menggunakan aksi hapus
                di karenakan ada beberapa data lain yg terkait dengan data ini
                akan ikut terhapus atau tidak terdeteksi.
                Harap mempelajari terlebih dahulu arah datanya.
            </div>
            <br>
            <br>
            <br>
        </div>
        <center>
            <i class="fa fa-th-list fa-5x"></i><br>
            <strong>
                {{ hb('sidebar')}}
            </strong><br>
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
    <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update();"><i class="far fa-edit mr-2"></i> Edit</a>
    <a id="subakses"></a>
</div>
<!-- RIGHT BUTTON END -->
<!-- Start Modal 1 -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="token" name="_token">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="idx" name="idx">
                    <input type="hidden" id="colum" name="colum">
                    <input type="hidden" id="gp1" name="gp1">
                    <div class="card mb-2">
                        <div class="row col">
                            <div class="col-md-3">
                                <strong class="mr-2">Role :</strong>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" name="role" id="role1" class="mr-2" value="1">Tombol Aktif
                            </div>
                            <div class="col-md-5" id="role0">
                                <input type="radio" name="role" id="role2" class="mr-2" value="0">Tombol Sub
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" id="no1">
                            No.
                            <input type="number" name="col1" id="col1" class="form-control" required>
                        </div>
                        <div class="col-md-3" id="no2">
                            No.
                            <input type="number" name="col2" id="col2" class="form-control" required>
                        </div>
                        <div class="col-md-3" id="no3">
                            No.
                            <input type="number" name="col3" id="col3" class="form-control" required>
                        </div>
                        <div class="col-md-9">
                            Label
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                    </div>
                    URL
                    <input type="text" name="url" id="url" class="form-control" required>
                    ICON
                    <input type="text" name="icon" id="icon" class="form-control" required>
                    KETERANGAN
                    <input type="text" name="ket" id="ket" class="form-control" required>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" onclick="save();" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i>Save</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal 1-->

<script type="text/javascript">
    var ost = <?=$lvl?>;
    //-----------------------------------------start
    function show_col1(val, row) {
        for (var name in row) {
            if (row.colum == '1') {
               bg = (row.role == '0') ?'#9ba3a1':'#dfebe7';
               arrow = (row.role == '0') ?'<i class="fa fa-sign-out-alt float-right" ></i>':'';
               var t = `
            <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>` + row.col1 + `
                        <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                        ` + row.nama + `
                        ` + arrow + `
                        </o>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12">
                    <small>LEVEL DISPLAY</small>
                    </div>
                    <div class="col-md-12">
                       <div class="row">`;
            for (i = 0; i < ost.length; i++) {
                cek = (row[ost[i].id] == '1') ? 'checked' : '';
                t += `
                    <div class="col-md-12">
                    <input type="checkbox" ` + cek + ` onclick="exet('` + row.id + `','` + ost[i].id + `')" class="mr-2">` + ost[i].name + `
                    </div>
                `;
            }
            t += `</div>
                    </div>
                </div>
            </div>
            `;
            } else {
                var t = '';
            }
            if (row["pur_col1"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_col2(val, row) {
        for (var name in row) {
            if (row.colum == '2') {
                bg = (row.role == '0') ?'#9ba3a1':'#dfebe7';
                arrow = (row.role == '0') ?'<i class="fa fa-sign-out-alt float-right" ></i>':'';
                var t = `
            <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>` + row.col2 + `
                        <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                        ` + row.nama + `
                        ` + arrow + `
                        </o>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12">
                    <small>LEVEL DISPLAY</small>
                    </div>
                    <div class="col-md-12">
                       <div class="row">`;
            for (i = 0; i < ost.length; i++) {
                cek = (row[ost[i].id] == '1') ? 'checked' : '';
                t += `
                    <div class="col-md-12">
                    <input type="checkbox" ` + cek + ` onclick="exet('` + row.id + `','` + ost[i].id + `')" class="mr-2">` + ost[i].name + `
                    </div>
                `;
            }
            t += `</div>
                    </div>
                </div>
            </div>
            `;
            } else {
                var t = '';
            }
            if (row["pur_col2"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_col3(val, row) {
        for (var name in row) {
            if (row.colum == '3') {
                bg = (row.role == '0') ?'#9ba3a1':'#dfebe7';
                var t = `
            <div class="col table-responsive my-1 style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>` + row.col3 + `
                        <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                        ` + row.nama + `
                        </o>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12">
                    <small>LEVEL DISPLAY</small>
                    </div>
                    <div class="col-md-12">
                       <div class="row">`;
            for (i = 0; i < ost.length; i++) {
                cek = (row[ost[i].id] == '1') ? 'checked' : '';
                t += `
                    <div class="col-md-12">
                    <input type="checkbox" ` + cek + ` onclick="exet('` + row.id + `','` + ost[i].id + `')" class="mr-2">` + ost[i].name + `
                    </div>
                `;
            }
            t += `</div>
                    </div>
                </div>
            </div>
            `;
            } else {
                var t = '';
            }
            if (row["pur_col3"] == "Received") {} else {
                return t;
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function exet(id,col) {
        var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "sidebar_checked",
                type: "POST",
                data: {
                    "_token": token,
                    "id": id,
                    "col": col,
                }
            });
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function add() {
        $('#fm').form('clear');
        document.getElementById("token").value = '{{ csrf_token()}}';
        document.getElementById("role0").hidden = false;
        document.getElementById("colum").value = '1';
        document.getElementById("role1").checked = true;
        document.getElementById("col1").value = '20';
        document.getElementById("col2").value = '0';
        document.getElementById("col3").value = '0';
        document.getElementById("no1").hidden = false;
        document.getElementById("no2").hidden = true;
        document.getElementById("no3").hidden = true;
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Tambah Sidebar</h5>';
        document.getElementById("id").value = 'insert';
        $('#modal').modal('show');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function adds() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $('#fm').form('load', row);
            document.getElementById("token").value = '{{ csrf_token()}}';
            if (row.colum == '1') {
                document.getElementById("idx").value = row.id;
                document.getElementById("role0").hidden = false;
                document.getElementById("colum").value = '2';
                document.getElementById("col1").value = row.col1;
                document.getElementById("col2").value = '20';
                document.getElementById("col3").value = '0';
                document.getElementById("no1").hidden = true;
                document.getElementById("no2").hidden = false;
                document.getElementById("no3").hidden = true;
            }
            if (row.colum == '2') {
                document.getElementById("idx").value = row.id;
                document.getElementById("gp1").value = row.group_1;
                document.getElementById("role0").hidden = true;
                document.getElementById("colum").value = '3';
                document.getElementById("col1").value = row.col1;
                document.getElementById("col2").value = row.col2;
                document.getElementById("col3").value = '20';
                document.getElementById("no1").hidden = true;
                document.getElementById("no2").hidden = true;
                document.getElementById("no3").hidden = false;
            }
            document.getElementById("role1").checked = true;
            document.getElementById("nama").value = '';
            document.getElementById("url").value = '';
            document.getElementById("icon").value = '';
            document.getElementById("ket").value = '';
            document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Tambah Sub Sidebar</h5>';
            document.getElementById("id").value = 'insert';
            $('#modal').modal('show');
        } else {
            $.messager.show({ // show error message
                title: 'Error',
                msg: 'Data tidak di pilih'
            });
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function update() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $('#fm').form('load', row);
            document.getElementById("token").value = '{{ csrf_token()}}';
            if (row.colum == '1') {
                document.getElementById("role0").hidden = false;
                document.getElementById("no1").hidden = false;
                document.getElementById("no2").hidden = true;
                document.getElementById("no3").hidden = true;
            }
            if (row.colum == '2') {
                document.getElementById("role0").hidden = false;
                document.getElementById("no1").hidden = true;
                document.getElementById("no2").hidden = false;
                document.getElementById("no3").hidden = true;
            }
            if (row.colum == '3') {
                document.getElementById("role0").hidden = true;
                document.getElementById("no1").hidden = true;
                document.getElementById("no2").hidden = true;
                document.getElementById("no3").hidden = false;
            }
            document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Data</h5>';
            $('#modal').modal('show');
        } else {
            $.messager.show({ // show error message
                title: 'Error',
                msg: 'Data tidak di pilih'
            });
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function save() {
        if (document.getElementById('nama').value == '') {
            $.messager.show({
                title: 'Error',
                msg: 'Label harus di isi'
            });
            exit;
        }
        if (document.getElementById('url').value == '') {
            $.messager.show({
                title: 'Error',
                msg: 'URL harus di isi'
            });
            exit;
        }
        $('#fm').form('submit', {
            url: 'crud_sidebar',
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#modal').modal('hide');
                    $('#dguser').datagrid('reload');
                    $.messager.show({
                        title: 'Success !',
                        msg: 'Berhasil'
                    });

                }
            }
        });
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function destroyuser() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>Sidebar name : ' + row.nama, function(r) {
                if (r) {
                    url = 'crud_sidebar';
                    $.post(url, {
                        _token:token,id: row.id,role:"del"
                    }, function(result) {
                        if (result.success) {
                            $('#dguser').datagrid('reload'); // reload the Vendor data
                            $.messager.show({ // show error message
                                title: 'Success !',
                                msg: 'Berhasil Di Hapus'
                            });
                        } else {
                            $.messager.show({ // show error message
                                title: 'Error',
                                msg: result.errorMsg
                            });
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
                        if (row.role == '0') {
                            if (row.id == '{{inc("side_us")}}' || row.group_1 == '{{inc("side_us")}}' || row.m!=null){
                            document.getElementById('subakses').innerHTML = `
                            <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="adds();"><i class="fa fa-plus mr-2"></i> Sub Sidebar</a>`;
                            }else{
                            document.getElementById('subakses').innerHTML = `
                            <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="adds();"><i class="fa fa-plus mr-2"></i> Sub Sidebar</a>
                            <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="destroyuser();"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>`;
                            } 
                        } else {
                            if (row.id == '{{inc("side_us")}}' || row.group_1 == '{{inc("side_us")}}' || row.m!=null){
                            document.getElementById('subakses').innerHTML = '';
                            }else{
                            document.getElementById('subakses').innerHTML = `
                            <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="destroyuser();"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>`;
                            }
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
                    if (row.colum == '1') {
                        document.getElementById("role0").hidden = false;
                        document.getElementById("no1").hidden = false;
                        document.getElementById("no2").hidden = true;
                        document.getElementById("no3").hidden = true;
                    }
                    if (row.colum == '2') {
                        document.getElementById("role0").hidden = false;
                        document.getElementById("no1").hidden = true;
                        document.getElementById("no2").hidden = false;
                        document.getElementById("no3").hidden = true;
                    }
                    if (row.colum == '3') {
                        document.getElementById("role0").hidden = true;
                        document.getElementById("no1").hidden = true;
                        document.getElementById("no2").hidden = true;
                        document.getElementById("no3").hidden = false;
                    }
                    document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Data</h5>';
                    $('#modal').modal('show');
                } else {
                    $.messager.show({ // show error message
                        title: 'Error',
                        msg: 'Data tidak di pilih'
                    });
                }
            },
            rowStyler: function(index, row) {
                if (row.role == '0') {
                    // return 'font-weight:bold;color:#9c4503;';
                }
            }

        })

    })
    //-----------------------------------------end
</script>
@endsection
