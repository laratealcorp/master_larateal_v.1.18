@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:history.back();" class="btn-sm bg-1 r20" title="Back"><i class="fa fa-arrow-left fa-sm"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="row m-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-th-list mr-2 mb-3"></i><strong><small>{{ hb('edit sidebar')}}</small></strong></a>
        </center>
    </div>
    <div class="col-md-8 mb-2 mt-2 table-responsive">
        <center>
            <table id="dguser" toolbar="#" class="easyui-datagrid" singleSelect="true" style="width: 100%;" fitColumns="true" rowNumbers="false" pagination="false" url="/cr_side/{{$level}}" pageSize="1000" pageList="[10,25,50,100,200,500,1000,2000,5000]">
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
            <br>
            <br>
        </div>
        <center>
            <i class="fa fa-th-list fa-5x"></i><br>
            <strong>
                {{ hb('edit sidebar')}}
                <br>
                Root : {{$root}}
            </strong><br>
        </center>
    </div>
</div>
<!-- BODY END -->
<script type="text/javascript">
    var akses = "{{$akses}}"
    //-----------------------------------------start
    function show_col1(val, row) {
        for (var name in row) {
            if (row.colum == '1') {
               bg = (row.role == '0') ?'#9ba3a1':'#dfebe7';
               arrow = (row.role == '0') ?'<i class="fa fa-sign-out-alt float-right" ></i>':'';
               cek = (row[akses] == '1') ? 'checked' : '';
               var t = `
            <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                <div class="row mt-1">
                    <div class="col-md-12">
                        <o>
                        <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                        ` + row.nama + `
                        ` + arrow + `
                        <input type="checkbox" ` + cek + ` onclick="exet('` +row.id+ `','` +akses+ `')" class="float-right mr-2">
                        </o>
                    </div>
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
                cek = (row[akses] == '1') ? 'checked' : '';
                var t = `
                    <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <o>
                                <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                                ` + row.nama + `
                                ` + arrow + `
                                <input type="checkbox" ` + cek + ` onclick="exet('` +row.id+ `','` +akses+ `')" class="float-right mr-2">
                                </o>
                            </div>
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
                cek = (row[akses] == '1') ? 'checked' : '';
                var t = `
                <div class="col table-responsive my-1  style="background-color:` + bg + `;color:#000;">
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <o>
                            <i class="` + row.icon + ` mr-2 ml-2" title="` + row.ket + `"></i>
                            ` + row.nama + `
                            ` + arrow + `
                            <input type="checkbox" ` + cek + ` onclick="exet('` +row.id+ `','` +akses+ `')" class="float-right mr-2">
                            </o>
                        </div>
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
                url: "/sidebar_checked",
                type: "POST",
                data: {
                    "_token": token,
                    "id": id,
                    "col": col,
                }
            });
    }
    //-----------------------------------------end
</script>
@endsection
