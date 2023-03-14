@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:history.back();" class="btn-sm bg-1 r20" title="Back"><i class="fa fa-arrow-left fa-sm"></i></a>
<a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="ADD"><i class="fa fa-plus"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser1`).datagrid(`reload`);$(`#dguser2`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<div class="container">
  <div class="row mt-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-indent mr-2 mb-3"></i><small><strong>{{ strtoupper('Setting Input') }}</strong></small></a>
        </center>
    </div>
        <div class="col-md-12 my-2">
            <div class="card bg-1">
                <div class="col">
                    <small>
                        <strong>
                            Level : {{$root}}
                        </strong>
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-2 mt-2 table-responsive">
            <center>
                <table id="dguser1" toolbar="#" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="false" pagination="false" url="/get_input/{{$level}}/1" pageSize="1000" pageList="[10,25,50,100,200,500,1000,2000,5000]">
                    <thead>
                        <tr>
                            <th field="pur_col1" width="300px" formatter="show_col1" align="left">KIRI / LEFT</th>

                        </tr>
                    </thead>
                </table>
            </center>
        </div>
        <div class="col-md-6 mb-2 mt-2 table-responsive">
            <center>
                <table id="dguser2" toolbar="#" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="false" pagination="false" url="/get_input/{{$level}}/2" pageSize="1000" pageList="[10,25,50,100,200,500,1000,2000,5000]">
                    <thead>
                        <tr>
                            <th field="pur_col2" width="300px" formatter="show_col2" align="left">KANANG / RIGHT</th>

                        </tr>
                    </thead>
                </table>
            </center>
        </div>

    </div>
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
            <div class="modal-body">
                <form id="fm" method="post">
                    <input type="hidden" id="token" name="_token">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="level" name="level">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-2">
                                <strong class="ml-2"><small>Posisi :</small></strong>
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="col" id="col1" class="mr-2" value="1">Kiri
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="col" id="col2" class="mr-2" value="2">Kanang
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                        <strong class="ml-2"><small>Wajib :</small></strong>
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="wajib" id="wajib1" class="mr-2" value="YA">YA
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="wajib" id="wajib2" class="mr-2" value="TIDAK">TIDAK
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                        <small class="ml-2">Tag :</small> 
                            <div class="row col">
                                <div class="col-md-4">
                                    <input type="radio" name="tag" id="tag1" onclick="c_tag();" class="mr-2" value="input">Input
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" name="tag" id="tag2" onclick="c_tag();" class="mr-2" value="textarea">TextArea
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" name="tag" id="tag3" onclick="c_tag();" class="mr-2" value="code">Code
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <small class="ml-2">Type :</small> 
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type1" class="mr-2" value="text">text
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type2" class="mr-2" value="email">email
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type3" class="mr-2" value="password">password
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type4" class="mr-2" value="checkbox">checkbox
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type5" class="mr-2" value="color">color
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="type" id="type6" class="mr-2" value="hidden">hidden
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            <small>No.</small> 
                                <input type="number" name="sort" id="sort" class="form-control" style="height:24px;">
                            </div>
                            <div class="col-md-9">
                            <small>Label</small>
                                <input type="text" name="label" id="label" class="form-control" style="height:24px;">
                            </div>
                        </div>
                        <small>Class</small>
                            <input type="text" name="class" id="class" class="form-control" style="height:24px;">
                        </div>
                        <div class="col-md-6">
                        <small id="lb_code">Code</small>
                           <textarea name="code" id="code" cols="30" rows="2" class="form-control"></textarea>
                        <small>Script</small>
                           <textarea name="script" id="script" cols="30" rows="2" class="form-control"></textarea>
                        <small>Initial</small>
                           <textarea name="init" id="init" cols="30" rows="2" class="form-control"></textarea>
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

<script type="text/javascript">
    var token = $("meta[name='csrf-token']").attr("content");
    var level="{{$level}}";
//==========================================================
function c_tag(){
    if(document.getElementById("tag3").checked == true){
        $('#code').show();
        $('#lb_code').show();
    }else{
        $('#code').hide();
        $('#lb_code').hide();
    }
};
//==========================================================
//-----------------------------------------start
function show_col1(val, row) {
    for (var name in row) {
        wajib = (row.wajib=='YA') ?'Wajib':'Optional';
        script = (row.script==null)?'':row.script;
        code = (row.code==null)?'':row.code;
        btn = (row.role == '0') ?'<a href="javascript:void(0);" onclick="del1();" class="float-right ml-2"><i class="fa fa-trash text-danger" title="Hapus"></i></a>':'';
        if (row.tag == 'input') {
            content = `<input type="` + row.type + `" name="` + row.name + `" id="` + row.name + `" class="` + row.class + ` mb-2" style="height:24px;">`;
        } else if (row.tag == 'textarea'){ 
            content = `<textarea name="` + row.name + `" id="` + row.name + `" cols="30" rows="2" class="` + row.class + ` mb-2"></textarea>`;
        } else {
            content = code;
        }
        var t = `<small>
                    <strong>` + row.sort + ` .</strong> ` + row.label + `
                    <small>[ ` + wajib + ` ]</small>
                    ` + btn + `
                    <a href="javascript:void(0);" onclick="edit1();" class="float-right"><i class="fa fa-edit text-success" title="Edit"></i></a>
                </small>
                `+ content + `
                `+ script;
        if (row["pur_col1"] == "Received") {} else {
            return t;
        }
    }
}
//-----------------------------------------end
//-----------------------------------------start
function show_col2(val, row) {
    for (var name in row) {
        wajib = (row.wajib=='YA') ?'Wajib':'Optional';
        script = (row.script==null)?'':row.script;
        code = (row.code==null)?'':row.code;
        btn = (row.role == '0') ?'<a href="javascript:void(0);" onclick="del2();" class="float-right ml-2"><i class="fa fa-trash text-danger" title="Hapus"></i></a>':'';
        if (row.tag == 'input') {
            content = `<input type="` + row.type + `" name="` + row.name + `" id="` + row.name + `" class="` + row.class + ` mb-2" style="height:24px;">`;
        } else if (row.tag == 'textarea'){  
            content = `<textarea name="` + row.name + `" id="` + row.name + `" cols="30" rows="2" class="` + row.class + ` mb-2"></textarea>`;
        } else {
            content = code;
        }
        var t = `<small>
                    <strong>` + row.sort + ` .</strong> ` + row.label + `
                    <small>[ ` + wajib + ` ]</small>
                    ` + btn + `
                    <a href="javascript:void(0);" onclick="edit2();" class="float-right"><i class="fa fa-edit text-success" title="Edit"></i></a>
                </small>
                `+ content + `
                `+ script;
        if (row["pur_col2"] == "Received") {} else {
            return t;
        }
    }
}
//-----------------------------------------end
//-----------------------------------------start
    function add() {
    $('#fm').form('clear');
    document.getElementById("token").value = '{{ csrf_token()}}';
    document.getElementById("col1").checked = true;
    document.getElementById("wajib1").checked = true;
    document.getElementById("tag1").checked = true;
    document.getElementById("type1").checked = true;
    document.getElementById("sort").value = 1;
    document.getElementById("class").value = 'form-control';
    document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Tambah Input</h5>';
    document.getElementById("id").value = 'insert';
    c_tag();
    $('#modal').modal('show');
}
//-----------------------------------------end
//-----------------------------------------start
    function edit1() {
    var row = $('#dguser1').datagrid('getSelected');
    if (row) {
        $('#fm').form('load', row);
        document.getElementById("token").value = '{{ csrf_token()}}';
        document.getElementById("level").value = level;
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Input</h5>';
        c_tag();
        $('#modal').modal('show');
    }
}
//-----------------------------------------end
//-----------------------------------------start
    function edit2() {
    var row = $('#dguser2').datagrid('getSelected');
    if (row) {
        $('#fm').form('load', row);
        document.getElementById("token").value = '{{ csrf_token()}}';
        document.getElementById("level").value = level;
        document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Input</h5>';
        c_tag();
        $('#modal').modal('show');
    }
}
//-----------------------------------------end
    //-----------------------------------------start
    function save() {
        if (document.getElementById('label').value == '') {
            msg('Error','Label harus di isi');
            exit;
        }
        if (document.getElementById('sort').value == '') {
            msg('Error','no harus di isi');
            exit;
        }
        $('#fm').form('submit', {
            url: '/crud_input/{{$level}}',
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    msg('Error',esult.errorMsg);
                } else {
                    $('#modal').modal('hide');
                    $('#dguser1').datagrid('reload');
                    $('#dguser2').datagrid('reload');
                    msg('Success !','Berhasil');
                }
            }
        });
    }
    //-----------------------------------------end
    //-----------------------------------------start
        function del1() {
        var row = $('#dguser1').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>LABEL : ' + row.label, function(r) {
                if (r) {
                    $.post("/crud_input/{{$level}}", {
                        "_token":token, id: row.id,col:"delete"
                    }, function(result) {
                        if (result.success) {
                            $('#dguser1').datagrid('reload');
                            msg('Success !','Berhasil Di Hapus');
                        } else {
                            msg('Error',result.errorMsg);
                        }
                    }, 'json');
                }
            });
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
        function del2() {
        var row = $('#dguser2').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ?<br>LABEL : ' + row.label, function(r) {
                if (r) {
                    $.post("/crud_input/{{$level}}", {
                        "_token":token, id: row.id,col:"delete"
                    }, function(result) {
                        if (result.success) {
                            $('#dguser2').datagrid('reload');
                            msg('Success !','Berhasil Di Hapus');
                        } else {
                            msg('Error',result.errorMsg);
                        }
                    }, 'json');
                }
            });
        }
    }
    //-----------------------------------------end
</script>
@endsection