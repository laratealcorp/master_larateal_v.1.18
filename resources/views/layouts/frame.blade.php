<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{inc('app_name')}}</title>
    <link rel="icon" type="image/x-icon" href="/img/{{logo()}}" />
    @if(is_online())
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @endif
    <link rel="stylesheet" type="text/css" href="/css_js/easyui/bootstrap_4.3.1.min.css">
    <link rel="stylesheet" type="text/css" href="/css_js/easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/css_js/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/css_js/easyui/themes/color.css">
    <link rel="stylesheet" href="/css_js/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/css_js/easyui/tema/{{inc('frame_ui')}}/easyui.css">
    <link rel="stylesheet" href="/css_js/toastr/toastr.min.css">
    {{-- <script src="/css_js/easyui/plugins/jquery.datagrid.js"></script> --}}
    <script src="/css_js/easyui/jquery.min.js"></script>
    <script src="/css_js/easyui/jquery.easyui.min.js"></script>
    <script src="/css_js/easyui/datagrid-filter.js"></script>
    <script src="/css_js/easyui/datagrid-detailview.js"></script>
    <script src="/css_js/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/css_js/toastr/toastr.min.js"></script>
    <script src="/css_js/moment/moment.min.js"></script>
    <script src="/css_js/easyui/datagrid-export.js"></script>
    <style>
        :root {
        --pa: {{color('pri_a')}};
        --pb: {{color('pri_b')}};
        --pc: {{color('pri_c')}};
        --sa: {{color('sec_a')}};
        --sb: {{color('sec_b')}};
        --sc: {{color('sec_c')}};
        --wa: {{color('wid_a')}};
        --wb: {{color('wid_b')}};
        --wc: {{color('wid_c')}};
        }
    .card {color: black;}
    .modal {color: black;}
    .bg-a {background-color: #c4d6f2;color: #000000;}
    .bg-b {background-color: #a3ffb4;color: #000000;}
    .bg-c {background-color: #fff6a3;color: #000000;}
    .bg-m {background-color: #f7a3a3;color: #000000;}
    .bg-0 {background-color: var(--pb);color: var(--pa);}
    .r10 {border-radius:10px;}
    .r20 {border-radius:20px;}
    .btr,.btl{top: 8px;position: fixed;z-index: 1000}
    .btr {right:8px;}
    .btl {left:8px;}
    .wid-tn {border-radius:6px;top: 5px;right:5px;position: fixed;height: 30px;z-index: 1000}
    .wid-t {top: 0rem;position: sticky;height: 50px;z-index: 1000}
    .wid-b {bottom: 0rem;position: sticky;height: 50px;z-index: 1000}
    .modal-top {position: fixed;z-index: 3000;}
    .rol-100 {height: 100px;overflow-y: scroll;}
    .rol-200 {height: 200px;overflow-y: scroll;}
    .rol-300 {height: 300px;overflow-y: scroll;}
    .rol-400 {height: 400px;overflow-y: scroll;}
    .rol-500 {height: 500px;overflow-y: scroll;}
    .bg-1 {background-color: var(--pa);color: var(--pb);}
    .bg-2 {background-color: var(--sa);color: var(--sb);}
    .bt-1 {background-color: var(--wa);color: var(--wb);}
    .bg-1-h {background-color: var(--pa);color: var(--pb);}
    .bg-2-h {background-color: var(--sa);color: var(--sb);}
    .bg-1-h:hover {background-color: var(--pc);color: var(--pb);}
    .bg-2-h:hover {background-color: var(--sc);color: var(--sb);}
    .bt-1:hover {background-color: var(--wc);color: var(--wb);}
    .pri-a {color: var(--pa);}
    .pri-b {color: var(--pb);}
    .pri-c {color: var(--pc);}
    .sec-a {color: var(--sa);}
    .sec-b {color: var(--sb);}
    .sec-c {color: var(--sc);}
    .bw-a {color: var(--wa);}
    .bw-b {color: var(--wb);}
    .bw-c {color: var(--wc);}
    .iwhite[readonly] {color: black;border-color: #fff;background-color: #fff;font-size: small;font-weight: bold;}
    .ribbon {position: absolute;padding: 0.1em 3em;font-size: 1em;font-weight: bold;right: 0;bottom: 0em;line-height: 1.875em;color: var(--sb);background: var(--sa);box-shadow: -1px 2px 3px rgba(0, 0, 0, 0.5);}
    .ribbon:before,
    .ribbon:after {position: absolute;content: '';display: block;}
    .ribbon:before {width: 0.5em;height: 2.05em;padding: 0 0 0.5em;top: 0;right: -0.5em;background: var(--sa);border-radius: 0 0 0.5em 0;}
    .ribbon:after {width: 0.4em;height: 0.4em;background: rgba(0, 0, 0, 0.5);bottom: -0.4em;right: -0.4em;border-radius: 0 0 0.4em 0;box-shadow: inset -1px 2px 2px rgba(0, 0, 0, 0.3);}
    .consta>input {display: none;}
</style>
</head>

<body class="bg-{{(inc('tema'))?inc('tema'):'light';}} text-{{(inc('tema')=='dark')?'white':'dark';}}">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}">
@yield('content')
<script type="text/javascript">
    //-----------------------------------------start
    function msg(t, msg) {
        $.messager.show({
            title: t,
            msg: msg
        });
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function hid_load(time){
        if(time==''){
            $('#load').modal('hide');
        }else{
            setTimeout(() => {
                $('#load').modal('hide');
            }, time);
        }
    }
    //-----------------------------------------end
    //-----------------------------------------start
    function show_load(){
        $('#load').modal({backdrop: "static"});
    }
    //-----------------------------------------end
</script>
</body>
<!--START Modal 1-->
<div class="modal fade" id="load" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <br>
        <br>
        <br>
        <br>
        <center>
            <img src="/img/dev/loading2.gif" width="140">
        </center>
    </div>
</div>
<!-- End Modal 1-->

</html>
