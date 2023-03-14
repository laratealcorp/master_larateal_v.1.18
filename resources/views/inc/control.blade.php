@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btr">
    <a href="" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
    <!-- <a href="" class="btn-sm bg-1 r10" title="Reload"><i class="fa fa-paint-brush mr-2"></i>PENGATURAN UI</a> -->
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="container mt-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fab fa-whmcs mr-2 mb-3"></i><strong><small>{{ strtoupper('pengaturan inti') }}</small></strong></a>
    </center>

    <div class="col-12">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card bg-1">
                    <div class="col">
                        <small>
                            <strong>
                               FIRST SETTING
                            </strong>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>PASSWORD DEFAULT</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="pass_default_lb"><strong>{{ inc('pass_default') }}</strong></div>
                                    <input type="text" id="pass_default" style="height: 23px;" value="{{ inc('pass_default')}}" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <x>
                                        <a href="javascript:void(0);" id="bt_e_pass_default" class="float-right" onclick="pass_e('pass_default')"><i class="fa fa-edit text-success" title="Edit"></i></a>
                                        <a href="javascript:void(0);" id="bt_s_pass_default" class="float-right" onclick="save('pass_default')"><i class="fa fa-save" title="Save"></i></a>
                                    </x>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>JAM ANALOG</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="show_analog" id="show_analog1" onclick="r_save('show_analog','true')" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="show_analog" id="show_analog2" onclick="r_save('show_analog','false')" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>JAM DIGITAL</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="show_digital" id="show_digital1" onclick="r_save('show_digital','true')" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="show_digital" id="show_digital2" onclick="r_save('show_digital','false')" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>MANUAL BOOK</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="mbook_status" id="mbook_status1" onclick="r_save('mbook_status','true')" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="mbook_status" id="mbook_status2" onclick="r_save('mbook_status','false')" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>MAINTENANCE</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="maint" id="maint1" onclick="r_save('maintenance','true')" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="maint" id="maint2" onclick="r_save('maintenance','false')" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($web_modul)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>WEBSITE</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="status" id="status1" onclick="r_save('web_status','true')" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="status" id="status2" onclick="r_save('web_status','false')" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                        var sts = "{{ inc('web_status',1)}}";
                        if (sts == 'true') {
                            document.getElementById('status2').checked = false;
                            document.getElementById('status1').checked = true;
                        } else {
                            document.getElementById('status1').checked = false;
                            document.getElementById('status2').checked = true;
                        }
                </script>
                @endif
                @if($msg_modul)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>REGISTER</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="reg" id="reg1" onclick="r_save('app_register','true')"" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="reg" id="reg2" onclick="r_save('app_register','false')"" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>REGISTER LEVEL</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-12">
                                    <input type="radio" name="level" id="null" onclick="b_save('level_regist','null')" class="mr-2" value="false">DISABLE
                                </div>
                                @foreach ($lvl as $o)
                                    <div class="col-md-12">
                                        <input type="radio" name="level" id="{{$o->id}}" onclick="b_save('level_regist','{{$o->id}}')" class="mr-2" value="true">{{$o->name}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="card col table-responsive">
                            <small><strong>LUPA PASSWORD</strong></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card col table-responsive">
                            <div class="row col">
                                <div class="col-md-6">
                                    <input type="radio" name="forgot" id="forgot1" onclick="r_save('app_forgot','true')"" class="mr-2" value="true">ENABLE
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="forgot" id="forgot2" onclick="r_save('app_forgot','false')"" class="mr-2" value="false">DISABLE
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var reg = "{{ inc('app_register',1)}}";
                    if (reg == 'true') {
                        document.getElementById('reg2').checked = false;
                        document.getElementById('reg1').checked = true;
                    } else {
                        document.getElementById('reg1').checked = false;
                        document.getElementById('reg2').checked = true;
                    }
                    var forgot = "{{ inc('app_forgot',1)}}";
                    if (forgot == 'true') {
                        document.getElementById('forgot2').checked = false;
                        document.getElementById('forgot1').checked = true;
                    } else {
                        document.getElementById('forgot1').checked = false;
                        document.getElementById('forgot2').checked = true;
                    }
                    var level = "{{ inc('level_regist')}}";
                     document.getElementById(level).checked = true;
                </script>
                @endif
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
<script type="text/javascript">
    var maint = "{{inc('maintenance','1')}}";
    if (maint == 'true') {
        document.getElementById('maint2').checked = false;
        document.getElementById('maint1').checked = true;
    } else {
        document.getElementById('maint1').checked = false;
        document.getElementById('maint2').checked = true;
    }
    var mbook_status = "{{inc('mbook_status','1')}}";
    if (mbook_status == 'true') {
        document.getElementById('mbook_status2').checked = false;
        document.getElementById('mbook_status1').checked = true;
    } else {
        document.getElementById('mbook_status1').checked = false;
        document.getElementById('mbook_status2').checked = true;
    }
    var show_analog = "{{ inc('show_analog',1)}}";
    if (show_analog == 'true') {
        document.getElementById('show_analog2').checked = false;
        document.getElementById('show_analog1').checked = true;
    } else {
        document.getElementById('show_analog1').checked = false;
        document.getElementById('show_analog2').checked = true;
    }
    var show_digital = "{{ inc('show_digital',1)}}";
    if (show_digital == 'true') {
        document.getElementById('show_digital2').checked = false;
        document.getElementById('show_digital1').checked = true;
    } else {
        document.getElementById('show_digital1').checked = false;
        document.getElementById('show_digital2').checked = true;
    }

    $('#pass_default_lb').show();
    $('#pass_default').hide();
    $('#bt_s_pass_default').hide();
    $('#bt_e_pass_default').show();
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
    function save(id) {
        var token = $("meta[name='csrf-token']").attr("content");
        var val = document.getElementById(id).value;
        var col = 'code';
        $.ajax({
            url: "update_inc",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                "_token": token,id,val,col
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
    function r_save(id,val) {
        var token = $("meta[name='csrf-token']").attr("content");
        var col = 'status';
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