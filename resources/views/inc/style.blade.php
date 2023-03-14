@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btr">
    <a href="" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
    <!-- <a href="" class="btn-sm bg-1 r10" title="Reload"><i class="fa fa-paint-brush mr-2"></i>PENGATURAN UI</a> -->
</div>
<!-- BODY START -->
<div class="container mt-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-paint-brush mr-2 mb-3"></i><strong><small>PENGATURAN UI</small></strong></a>
    </center>

    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card bg-1">
                    <div class="col">
                        <small>
                            <strong>
                               UI SETTING
                            </strong>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

            <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>BODY COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="tema" id="tema_light" onclick="b_save('tema','light')" class="mr-2" value="true">PUTIH / LIGHT
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="tema" id="tema_dark" onclick="b_save('tema','dark')" class="mr-2" value="true">HITAM / DARK
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>DATA UI</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                @foreach ($frame as $f)
                                    <div class="col-md-6">
                                        <input type="radio" name="frame" id="{{$f->id}}" onclick="b_save('frame_ui','{{$f->id}}')" class="mr-2" value="true"><a href="javascript:void(0);" title="Display" onclick="show('{{$f->id}}')"><i class="fa fa-eye fa-sm mr-2"></i></a>{{tos('-',hb($f->id))}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 mb-2">
                    <div class="card bg-1">
                        <div class="col">
                            NB : <small>Reload halaman untuk melihat hasil</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>QRCODE COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="qr_dot" value="{{ color('qr_dot') }}" class="form-control" onchange="r_save('qr_dot',this.value);">
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="card bg-1">
                        <div class="col">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 1 BACKGROUND COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="pri_a" value="{{ color('pri_a') }}" class="form-control" onchange="r_save('pri_a',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 1 TEXT COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="pri_b" value="{{ color('pri_b') }}" class="form-control" onchange="r_save('pri_b',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 1 HOVER COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="pri_c" value="{{ color('pri_c') }}" class="form-control" onchange="r_save('pri_c',this.value);">
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="card bg-1">
                        <div class="col">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 2 BACKGROUND COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="sec_a" value="{{ color('sec_a') }}" class="form-control" onchange="r_save('sec_a',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 2 TEXT COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="sec_b" value="{{ color('sec_b') }}" class="form-control" onchange="r_save('sec_b',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>PART 2 HOVER COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="sec_c" value="{{ color('sec_c') }}" class="form-control" onchange="r_save('sec_c',this.value);">
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="card bg-1">
                        <div class="col">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>TOMBOL WID BACKGROUND COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="wid_a" value="{{ color('wid_a') }}" class="form-control" onchange="r_save('wid_a',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>TOMBOL WID TEXT COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="wid_b" value="{{ color('wid_b') }}" class="form-control" onchange="r_save('wid_b',this.value);">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive" style="height: 36px;">
                            <small><strong>TOMBOL WID HOVER COLOR</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <input type="color" id="wid_c" value="{{ color('wid_c') }}" class="form-control" onchange="r_save('wid_c',this.value);">
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
<div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="table-responsive center">
            <img id="img" class="img-responsive">
        </div>
    </div>
</div>
<!-- End Modal 1-->
<script type="text/javascript">

    var frame = "{{ inc('frame_ui')}}";
    document.getElementById(frame).checked = true;
    var tema = "{{ 'tema_'.inc('tema')}}";
    document.getElementById(tema).checked = true;
    //==========================================================
    function show(id){
        $('#show').modal('show');
        var text = '/css_js/easyui/tema/'+id+'/ss.png';
        var url = text.replace(/\s+/g,'');
        document.getElementById("img").src = url;
    }
    //============================================s==============
    //===========================================
    function r_save(id,val) {
        var token = $("meta[name='csrf-token']").attr("content");
        var col = 'code';
        $.ajax({
            url: "update_color",
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
    function b_save(id,val) {
        var token = $("meta[name='csrf-token']").attr("content");
        var col = 'code';
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
</script>
@endsection