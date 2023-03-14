@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:void(0);" onclick="insert_level();" class="btn-sm bg-1 r20" title="ADD"><i class="fa fa-plus"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="row m-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fab fa-react mr-2 mb-3"></i><strong><small>{{ hb('Hak Akses')}}</small></strong></a>
        </center>
    </div>

    <div class="col-md-8 mb-2 mt-2 table-responsive">
        <center>
            <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="false" pagination="true" url="get_engine" pageSize="1000" pageList="[10,25,50,100,200,500,1000,2000,5000]">
                <thead>
                    <tr>
                        <th field="pur_col1" width="450px" formatter="show_col1" align="left">LEVEL</th>
                        <th field="pur_col2" width="450px" formatter="show_col2" align="left">AKSES</th>

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
                    Doubel Klick pada baris data Untuk Edit Sidebar. <br>
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
            <i class="fab fa-react fa-5x"></i><br>
            <strong>
                {{ hb('hak akses')}}
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
                    <input type="hidden" id="act" name="act">
                    Title
                    <input type="text" name="name" id="name" class="form-control" required>
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
            if (row.role == 'primary') {
               bg = (row.role == 'primary') ?'#9ba3a1':'#dfebe7';
               arrow = (row.role == 'primary') ?'<i class="fa fa-sign-out-alt float-right" ></i>':'';
               var t = `
            <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>
                        <i class="fab fa-xing-square mr-2 ml-2" title="` + row.name + `"></i>
                        ` + row.name + `
                        ` + arrow + `
                        </o>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12">
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
            bg = (row.role == 'primary') ?'#9ba3a1':'#dfebe7';
                var t = `
            <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>
                        <i class="fab fa-angular mr-2 ml-2" title="` + row.sub + `"></i>
                        ` + row.sub + `
                        </o>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
            `;
            if (row["pur_col2"] == "Received") {} else {
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
    function insert_level() {
        $('#fm').form('clear');
        document.getElementById("token").value = '{{ csrf_token()}}';
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fab fa-xing-square mr-2"></i>Tambah Level</h5>';
        document.getElementById("id").value = 'insert';
        document.getElementById("act").value = 'insert_level';
        $('#modal').modal('show');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function update_level() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
            $('#fm').form('load', row);
            document.getElementById("token").value = '{{ csrf_token()}}';
            document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fab fa-xing-square mr-2"></i>Edit Level</h5>';
            document.getElementById("act").value = 'update_level';
            $('#modal').modal('show');
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function insert_akses() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
        $('#fm').form('load', row);
        document.getElementById("token").value = '{{ csrf_token()}}';
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fab fa-angular mr-2"></i>Add Akses <small>Level : '+row.name+'</small></h5>';
        document.getElementById("name").value = '';
        document.getElementById("act").value = 'insert_akses';
        $('#modal').modal('show');
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
        function update_akses() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
            $('#fm').form('load', row);
            document.getElementById("token").value = '{{ csrf_token()}}';
            document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fab fa-angular mr-2"></i>Edit Akses <small>Level : '+row.name+'</small></h5>';
            document.getElementById("name").value = row.sub;
            document.getElementById("act").value = 'update_akses';
            $('#modal').modal('show');
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function save() {
        if (document.getElementById('name').value == '') {
            $.messager.show({
                title: 'Error',
                msg: 'kolom harus di isi'
            });
            exit;
        }
        $('#fm').form('submit', {
            url: 'crud_engine',
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
    function del_level() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>Level name : ' + row.name, function(r) {
                if (r) {
                    $.post('crud_engine', {
                        _token:token,id:row.id,act:"del_level",name:"000"
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
    function del_akses() {
        var row = $('#dguser').datagrid('getSelected');
        var token = $("meta[name='csrf-token']").attr("content");
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>Akses name : ' + row.sub, function(r) {
                if (r) {
                    $.post('crud_engine', {
                        _token:token,id:row.id,act:"del_akses",name:"000"
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
                    if (row.role == 'primary') {
                        if (row.id == 'a_dev' || row.id == 'a_super_admin'){
                        document.getElementById('subakses').innerHTML = `
                        <a href="/dev_side/`+row.id+`" class="btn-sm form-control mb-1" plain="true"><i class="fa fa-th-list mr-2"></i>Edit Sidebar</a>
                        `;
                        }else{
                        document.getElementById('subakses').innerHTML = `
                        <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="insert_akses();"><i class="fa fa-plus mr-2"></i> Add Akses</a>
                        <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update_level();"><i class="far fa-edit mr-2"></i> Edit L</a>
                        <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update_akses();"><i class="far fa-edit mr-2"></i> Edit A</a>
                        <a href="/dev_side/`+row.id+`" class="btn-sm form-control mb-1" plain="true"><i class="fa fa-th-list mr-2"></i>Edit Sidebar</a>
                        <a href="/dev_input/`+row.id+`" class="btn-sm form-control mb-1" plain="true"><i class="fa fa-indent mr-2"></i>Set Input</a>
                        <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="del_level();"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>
                        `;
                        }
                    } else {
                        document.getElementById('subakses').innerHTML = `
                        <a href="javascript:void(0)" class="btn-sm form-control mb-1" plain="true" onClick="update_akses();"><i class="far fa-edit mr-2"></i> Edit A</a>
                        <a href="/dev_side/`+row.id+`" class="btn-sm form-control mb-1" plain="true"><i class="fa fa-th-list mr-2"></i>Edit Sidebar</a>
                        <a href="javascript:void(0)" class="btn-sm form-control" plain="true" onClick="del_akses();"><i class="fa fa-trash mr-2 text-danger"></i> Hapus</a>
                        `;
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
                    window.location.href='/dev_side/'+row.id;
                } else {
                    $.messager.show({ // show error message
                        title: 'Error',
                        msg: 'Data tidak di pilih'
                    });
                }
            },
            rowStyler: function(index, row) {
                if (row.role == 'primary') {
                    // return 'font-weight:bold;color:#9c4503;';
                }
            }

        })

    })
    //-----------------------------------------end
</script>
@endsection
