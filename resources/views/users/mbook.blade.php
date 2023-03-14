@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<input type="hidden" id="idx">
<div class="row m-2">
    <div class="col-12">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-book mr-2 mb-3"></i><strong><small>{{ strtoupper('Manual Book') }}</small></strong></a>
        </center>
    </div>
    <div class="col-md-9 mb-2 mt-2 table-responsive">
        <div class="row">

            <div class="col-12" id="fo1">
                <center>
                    <table id="dguser" toolbar="#toolbarCustomer" class="easyui-datagrid" singleSelect="true" style="width: 100%;height:500px;" fitColumns="true" rowNumbers="true" pagination="true" url="/user_m_book" pageSize="10" pageList="[10,25,50,75,100,125,150,200]">
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
                        <a href="javascript:void(0);" onclick="hid()" class="btn-sm btn-danger float-right r20 m-1" title="Close"><i class="fa fa-times fa-sm"></i></a>
                    </x>
                </div>
                <div id="content"></div>
            </div>

        </div>

    </div>
    <div class="col-md-3 mb-2 mt-2 table-responsive">
        <div class="container">
            <div class="">
                <strong>
                    NB :
                </strong>
                <hr>
                Doubel Klick pada baris data Untuk life preview
                <hr>
            </div>
            <br>
            <br>
            <br>
        </div>
        <center>
            <i class="fa fa-book fa-5x"></i><br>
            <strong>
                <?= strtoupper('Manual Book') ?>
            </strong><br>
        </center>
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
<script type="text/javascript">
    $('#fo2').hide();
    //-----------------------------------------start
    function show_res(val, row) {
        for (var name in row) {
            var t = `
            <div class="card col table-responsive my-1">
                <div class="row mt-1">
                    <div class="col-md-11">
                        <strong>` + row.judul + `</strong>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0)" onclick="lifeview()" class="pri-a"><i class="fa fa-arrow-right"></i></a>
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
        $('#fo2').hide();
        $('#fo1').show();
        $('#content').html('');
        $('#dguser').datagrid('reload');
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function lifeview() {
        var row = $('#dguser').datagrid('getSelected');
        if (row) {
            $('#fo1').hide();
            $('#fo2').show();
            $("#head").html('<strong class="float-left">' + row.judul + '</strong>');
            if (row.role == 'PDF') {
                $('#content').html('<iframe src="/file/pdf/' + row.content + '" frameborder="0" width="100%" height="1000px"></iframe>');
            } else {
                $('#content').html('<div class="card card-body">'+row.content+'</div>');
            }
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    $(function() {
        $('#dguser').datagrid({
            singleSelect: true,
            onDblClickRow: function() {
                lifeview()
            }
        })

    })
    //-----------------------------------------end
</script>
@endsection