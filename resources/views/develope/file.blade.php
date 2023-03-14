@extends('layouts.frame')
@section('content')
<script src="/css_js/contextmenu/dist/jquery.contextMenu.js"></script>
<script src="/css_js/contextmenu/dist/jquery.ui.position.min.js"></script>
<link rel="stylesheet" href="/css_js/contextmenu/dist/jquery.contextMenu.min.css">
<style>
.context-menu-icon::before {
position: absolute;
top: 50%;
left: 0;
width: 2em; 
font-family: "context-menu-icons";
font-size: 1em;
font-style: normal;
font-weight: normal;
line-height: 1;
color: {{ color('pri_a') }};
text-align: center;
-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
        transform: translateY(-50%);

-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
}
.context-menu-icon.context-menu-icon--fa::before {
  position: absolute;
  top: 50%;
  left: 0;
  width: 2em; 
  font-family: FontAwesome;
  font-size: 1em;
  font-style: normal;
  font-weight: normal;
  line-height: 1;
  color: {{ color('pri_a') }};
  text-align: center;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
       -o-transform: translateY(-50%);
          transform: translateY(-50%);

  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.context-menu-icon.context-menu-hover:before {
color: {{ color('pri_b') }};
}
.context-menu-icon.context-menu-icon--fa.context-menu-hover:before {
color: {{ color('pri_b') }};
}

.context-menu-item.context-menu-hover {
  color: {{ color('pri_b') }};
  cursor: pointer; 
  background-color: {{ color('pri_a') }};
}
</style>
<!-- TOP NAVIGASI START -->
<!-- <div class="card-header col-md-12 wid-t bg-1">
    <center>
        <small>
            <h6>
                <a href="javascript:void(0);" onclick="go_upload();" class="btn-sm bt-1 float-left" title="Upload Zip"><i class="fa-solid fa-upload"></i></a>
                     <i class="fa fa-window-restore mr-2"></i> {{ strtoupper('public file') }}
                <a href="" class="btn-sm bt-1 float-right" title="RELOAD"><i class="fa-solid fa-sync"></i></a>
            </h6>
        </small>
    </center>
</div> -->
<!-- TOP NAVIGASI END -->
<style>.hov:hover{background-color:{{$t1}};color:{{$t2}};}.hov{border-radius:10px;}</style>
<!-- BODY START -->
<div class="m-4 r0">
    @if(u())
    <div class="btl">
       <i class="fa fa-home mr-2"></i>Root <i class="fa fa-caret-right small"></i> {{str_replace("/"," ",u2(u()))}}
    </div>
    <div class="btr">
       <a href="javascript:void(0)" onclick="history.back();" class="btn-sm r20 bg-1 mb-4 mr-2" title="Kembali"><i class="fa fa-arrow-left"></i></a>
    </div>
    @else
    <div class="btl">
        <i class="fa fa-home mr-2"></i>Root
    </div>
    @endif
    <div class="row mt-2">
        <?php 
        for ($i=0; $i<count($images); $i++) 
        { 
            $single_image = str_replace("file".u2(u())."/","", $images[$i]);
            $name = str_replace("file/".u2(u()),"",$single_image);
            $e = explode(".",$single_image);
            $ext = end($e);
            if($ext=='png' or $ext=='jpg' or $ext=='jpeg' or $ext=='gif'){
            echo '<div class="col-md-2 col-4 hov r1 p-2">
                        <div class="table-responsive" title="'.$name.'">
                            <img src="/file'.u2(u()).'/'.$single_image.'" class="br1" width="100%"/>
                            <small>'.$name.'</small>
                        </div>
                    </div>'; 
            }elseif($name=='index.html'){
                echo '';
            }elseif(count($e)==1){
                echo '<div class="col-md-2 col-4 hov r1 p-2">
                <div class="table-responsive" title="'.$name.'">
                <img src="/img/dev/ext/folder.png" class="br1" width="100%"/>
                <small>'.$name.'</small>
                </div>
                </div>';
            }else{
                $exten = (file_exists('img/dev/ext/'.$ext.'.png'))?'/img/dev/ext/'.$ext.'.png':'/img/dev/ext/file.png';
                echo '<div class="col-md-2 col-4 hov r1 p-2">
                <div class="table-responsive" title="'.$name.'">
                <img src="'.$exten.'" class="br1" width="100%"/>
                <small>'.$name.'</small>
                </div>
                </div>';
            }
        }
        ?>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<!-- BODY END -->
<div id="ee"></div>
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
                      FILE [ ONLY .zip ]
                    <input type="file" name="zip_file" id="zip_file" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="head2"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fm2" method="post">
                      FILE
                    <input type="file" name="file" id="file" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- End Modal 1-->
<!-- Start Modal 1 -->
<div class="modal fade" id="rename" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="head3"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fm3" method="post">
                    <input type="hidden" name="act" id="act">
                    <input type="text" name="text" id="text" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
            <a href="javascript:void(0);" onclick="save()" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i> Save</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal 1-->
<input type="hidden" id="id" name="id">
<script>
var _token = $("meta[name='csrf-token']").attr("content");
$.contextMenu({
    selector: '.r1', 
    items: {
        "open": {name: "Open", icon: "fa-sign-out-alt",
            callback: function(key, opt){
                opn($(this).text()); 
            }},
        "rename": {name: "Rename", icon: "edit",
            callback: function(key, opt){
                rename($(this).text());
            }},
        "arzip": {name: "Arzipkan", icon: "paste",
            callback: function(key, opt){
                arzip($(this).text());
            }},
        "sep1": "---------",
        "delete": {name: "Delete", icon: "delete",
            callback: function(key, opt){
                del($(this).text()); 
            }},
    }
});
$.contextMenu({
    selector: 'body', 
    callback: function(key, options) {
        var id = $(this).text();
        if(key=='dir'){
            buat();
        }else if(key=='load'){
            $('#load').modal({backdrop: "static"});
            window.location.reload();  
        }else if(key=='home'){
            window.location.href = '/dev_file'; 
        }else if(key=='add'){
            upload();
        }else{
            go_upload();
        }
    },
    items: {
        "home": {name: "Root", icon: "fa-home"},
        "dir": {name: "New Folder", icon: "fa-folder-plus"},
        "load": {name: "Reload", icon: "fa-sync"},
        "add": {name: "Upload", icon: "fa-upload"},
        "add2": {name: "Upload and Extract zip", icon: "copy"},
    }
});
//==========================================================
$( ".r1" ).dblclick(function() {
    opn($(this).text()); 
});
//==========================================================
//==========================================================
function go_upload(){
    $('#modal').modal('show');
    document.getElementById("zip_file").value = '';
    document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-upload mr-2"></i>Upload & extract zip</h5>';
}
//============================================s==============
//==========================================================
function upload(){
    $('#modal2').modal('show');
    document.getElementById("file").value = '';
    document.getElementById("head2").innerHTML = '<h5 class="modal-title"><i class="fa fa-upload mr-2"></i>Upload File</h5>';
}
//============================================s==============
//==========================================================
function rename(val){
    $('#rename').modal('show');
    var vals = val.replace(/\s+/g,'');
    document.getElementById("text").value = vals;
    document.getElementById("act").value = vals;
    document.getElementById("head3").innerHTML = '<h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Rename</h5>';
}
//============================================s==============
//==========================================================
function buat(){
    $('#rename').modal('show');
    document.getElementById("text").value = '';
    document.getElementById("text").focus();
    document.getElementById("act").value = 'insert';
    document.getElementById("head3").innerHTML = '<h5 class="modal-title"><i class="fa fa-folder-plus mr-2"></i>New Folder</h5>';
}
//============================================s==============
//==========================================================
$('#zip_file').on('change', function() {
    $('#load').modal({backdrop: "static"});
        var url = '/dev_file';
        var property = document.getElementById('zip_file').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        if (e !== 'zip') {
            setTimeout(() => {
                $('#load').modal('hide');
            }, 1000);
            msg('Error!','Extensi Harus [ zip ].');
            return;
        }
        var form_data = new FormData();
        form_data.append("zip_file", property);
        form_data.append("_token", _token);
        form_data.append("id", 'zip');
        form_data.append("dir", '{{u()}}');

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(r) {
                $('#modal').modal('hide');
                msg('Success!','Berhasil di extract.');
                window.location.reload();
            }
        },'json');
    });
//==========================================================
//==========================================================
$('#file').on('change', function() {
    $('#load').modal({backdrop: "static"});
        var url = '/dev_file';
        var property = document.getElementById('file').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        var form_data = new FormData();
        form_data.append("file", property);
        form_data.append("_token", _token);
        form_data.append("id", 'file');
        form_data.append("dir", '{{u()}}');

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(r) {
                $('#modal').modal('hide');
                msg('Success!','Berhasil di upload.');
                window.location.reload();
            }
        });
    });
//==========================================================
//==========================================================
function opn(id){
    var text = '/dev_file/{{u()}}@@@'+id;
    var ur = '/file{{u2(u())}}/'+id;
    var s = text.split(".");
    var x = ur.split(".");
    var url = text.replace(/\s+/g,'');
    var urlss = ur.replace(/\s+/g,' ');
    var urls = urlss.replace(' ','');
    if(s.length==1){
        window.location.href = url; 
    }else if(x[x.length - 1] =='pdf'){
        window.open(urls, "mywindow", "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=auto,height=auto,left =304,top = 150.5");
    }else{
        // msg('m',x[x.length - 1]);
        window.location.href = urls; 
    }
}
//==========================================================
//==========================================================
function save(){
    $('#load').modal({backdrop: "static"});
    var id = document.getElementById("text").value;
    var act = document.getElementById("act").value;
    $.post("/dev_file_dir",{
            _token,id,act,dir:'{{u()}}'
        },function(r){
            if (r.success){
                $('#rename').modal('hide');
                msg('Success!','Berhasil di save.');
                    window.location.reload();
            }else{
                $('#load').modal('hide');
                msg('Error!',r.errorMsg);
            }
    },'json');
}
//==========================================================
//==========================================================
function del(id){
    $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ? <br> NAME : '+id, function(r) {
        if (r) {
            $('#load').modal({backdrop: "static"});
            $.post("/dev_file_del",{
                    _token,id,dir:'{{u()}}'
                },function(r){
                    if (r.success){
                        $('#modal').modal('hide');
                        msg('Success!','Berhasil di hapus.');
                        // setTimeout(() => {
                            window.location.reload();
                        // }, 1000);
                    }else{
                        $('#load').modal('hide');
                        msg('Error!',r.errorMsg);
                    }
            },'json');
        }
    });
}
//==========================================================
//==========================================================
function arzip(id){
    $.messager.confirm('Attention!', 'Arzipkan data ? <br> '+id, function(r) {
        if (r) {
            $('#load').modal({backdrop: "static"});
            $.post("/dev_file_dir",{
                    _token,id,act:'arzip',dir:'{{u()}}'
                },function(r){
                    if (r.success){
                        $('#modal').modal('hide');
                        msg('Success!','Berhasil.');
                        // setTimeout(() => {
                            window.location.reload();
                        // }, 1000);
                    }else{
                        $('#load').modal('hide');
                        msg('Error!',r.errorMsg);
                    }
            },'json');
        }
    });
}
//==========================================================
</script>
@endsection