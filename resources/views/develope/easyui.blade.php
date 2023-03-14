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
<style>.hov:hover{background-color:{{$t1}};color:{{$t2}};}.hov{border-radius:10px;}</style>
<!-- BODY START -->
<div class="m-4 r0">
    <div class="btl">
        <i class="fab fa-hubspot mr-2"></i>Jeasyui Root
    </div>
    <div class="btr">
        Active UI : {{inc('frame_ui')}}
    </div>
    <div class="row mt-2">
        @foreach($images as $i)
            <?php $exten = (file_exists("css_js/easyui/tema/".$i->id."/ss.png"))?"/css_js/easyui/tema/".$i->id."/ss.png":'/img/dev/lock.gif';?>
                <div class="col-md-4 hov r1 p-2">
                    <div class="table-responsive" title="{{$i->id}}">
                    <strong>{{$i->id}}</strong>
                    <img src="{{$exten}}" class="img-fluit" width="100%"/>
                    </div>
                </div>
        @endforeach
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
                      FILE [ ONLY .ui ]
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
<div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="table-responsive">
            <img id="img" class="img-responsive">
        </div>
    </div>
</div>
<!-- End Modal 1-->
<input type="hidden" id="id" name="id">
<script>
var _token = $("meta[name='csrf-token']").attr("content");
// CONTEXTMENU IN FILE START
$.contextMenu({
    selector: '.r1', 
    items: {
        "show": {name: "Lihat", icon: "fa-eye",
            callback: function(key, opt){
                show($(this).text()); 
            }},
        "load": {name: "Reload", icon: "fa-sync",
            callback: function(key, opt){
                $('#load').modal({backdrop: "static"});
                 window.location.reload();  
            }},
        "add": {name: "Upload", icon: "fa-upload",
            callback: function(key, opt){
                 go_upload();
            }},
        "open": {name: "Download", icon: "fa-cloud-download-alt",
            callback: function(key, opt){
                opn($(this).text()); 
            }},
        "sep1": "---------",
        "delete": {name: "Delete", icon: "delete",
            callback: function(key, opt){
                del($(this).text()); 
            }},
    }
});
// CONTEXTMENU IN FILE END
// CONTEXTMENU OUT FILE START
$.contextMenu({
    selector: 'body', 
    callback: function(key, options) {
        var id = $(this).text();
        if(key=='load'){
            $('#load').modal({backdrop: "static"});
            window.location.reload();  
        }else{
            go_upload();
        }
    },
    items: {
        "load": {name: "Reload", icon: "fa-sync"},
        "add": {name: "Upload", icon: "fa-upload"},
    }
});
// CONTEXTMENU OUT FILE END
//==========================================================
$( ".r1" ).dblclick(function() {
    show($(this).text());
});
//==========================================================
//==========================================================
function show(id){
    $('#show').modal('show');
    var text = '/css_js/easyui/tema/'+id+'/ss.png';
    var url = text.replace(/\s+/g,'');
    document.getElementById("img").src = url;
}
//============================================s==============
//==========================================================
function go_upload(){
    $('#modal').modal('show');
    document.getElementById("zip_file").value = '';
    document.getElementById("head").innerHTML = '<h5 class="modal-title"><i class="fa fa-upload mr-2"></i>Upload UI</h5>';
}
//============================================s==============
//==========================================================
$('#zip_file').on('change', function() {
    $('#load').modal({backdrop: "static"});
        var url = '/dev_easyui';
        var property = document.getElementById('zip_file').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var e = image_extension;
        if (e !== 'ui') {
            setTimeout(() => {
                $('#load').modal('hide');
            }, 1000);
            msg('Error!','Extensi Harus [ ui ].');
            return;
        }
        var form_data = new FormData();
        form_data.append("zip_file", property);
        form_data.append("_token", _token);
        form_data.append("id", e);

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(r) {
                $('#modal').modal('hide');
                msg('Success!','Berhasil di install.');
                window.location.reload();
            }
        },'json');
    });
//==========================================================
//==========================================================
function opn(id){
    var text = '/css_js/easyui/tema/'+id+'.ui';
    var url = text.replace(/\s+/g,'');
    window.location.href = url; 
}
//==========================================================
//==========================================================
function del(id){
    $.messager.confirm('Attention!', '<strong class="text-danger">Hati-hati Melakukan aksi ini,</strong><br> Apakah Anda Yakin Ingin Menghapus data ini ? <br> NAME : '+id, function(r) {
        if (r) {
            $('#load').modal({backdrop: "static"});
            $.post("/dev_easyui",{
                    _token,id
                },function(r){
                    if (r.success){
                        $('#modal').modal('hide');
                        msg('Success!','Berhasil di hapus.');
                            window.location.reload();
                    }else{
                        setTimeout(() => {
                            $('#load').modal('hide');
                        }, 1000);
                        msg('Error!',r.errorMsg);
                    }
            },'json');
        }
    });
}
//==========================================================
</script>
@endsection