<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{inc('app_name')}}</title>
    <link rel="icon" type="image/x-icon" href="img/{{logo()}}" />
    @if(is_online())
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @endif
    <link rel="stylesheet" type="text/css" href="css_js/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_js/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" href="css_js/toastr/toastr.min.css">
    <link rel="stylesheet" href="css_js/lte/css/adminlte.min.css">
    <link rel="stylesheet" href="css_js/crop/croppie.css">
    <link rel="stylesheet" href="css_js/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="css_js/owlcarousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="css_js/overlayScrollbars/css/OverlayScrollbars.min.css">
    <style type="text/css">
        .card {color: black;}
        .modal {color: black;}
        .modal-top{z-index: 9000;}
        .modal-top2{z-index: 9001;}
        .modal-top3{z-index: 9002;}
        .sidebar-light-costume .nav-sidebar>.nav-item>.nav-link.active {
            background-color: {{color('pri_a')}};
            color: {{color('pri_b')}};
        }

        .sidebar-light-costume .nav-sidebar.nav-legacy>.nav-item>.nav-link.active {
            border-color: {{color('pri_a')}};
        }
        .sidebar-dark-costume .nav-sidebar>.nav-item>.nav-link.active {
            background-color: {{color('pri_a')}};
            color: {{color('pri_b')}};
        }

        .sidebar-dark-costume .nav-sidebar.nav-legacy>.nav-item>.nav-link.active {
            border-color: {{color('pri_a')}};
        }
        .jam_analog {
            background-image: url("img/dev/analog.png");
            background-repeat: no-repeat;
            /* background-attachment:local; */
            background-position: center center;
            background-size: cover;
            /* background: #e7f2f7; */
            position: relative;
            width: 240px;
            height: 240px;
            border: 16px solid {{color('pri_a')}};
            border-radius: 50%;
            padding: 20px;
            margin:20px auto;
        }

        .xxx {
            height: 100%;
            width: 100%;
            position: relative;
        }

        .jarum {
            position: absolute;
            width: 50%;
            background: #232323;
            top: 50%;
            transform: rotate(90deg);
            transform-origin: 100%;
            transition: all 0.05s cubic-bezier(0.1, 2.7, 0.58, 1);
        }

        .lingkaran_tengah {
            width: 24px;
            height: 24px;
            background: #232323;
            border: 4px solid #52b6f0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -14px;
            margin-top: -14px;
            border-radius: 50%;
        }

        .jarum_detik {
            height: 2px;
            border-radius: 1px;
            background: #F0C952;
        }

        .jarum_menit {
            height: 4px;
            border-radius: 4px;
        }

        .jarum_jam {
            height: 8px;
            border-radius: 4px;
            width: 35%;
            left: 15%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height" oncontectmenu="return false">

    <!-- LOADER START -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="img/{{logo()}}" alt="{{inc('app_name')}}" height="100" width="100">
    </div>
    <!--- LOADER END --->
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-{{$tema}} navbar-{{$tema}}">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @if (inc('show_digital',1)=='true')
                <li class="nav-item">
                    <a href="javascript:void(0);" class="btn btn-outline-info  mr-2">
                        <div id="jam"></div>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="javascript:void(0);" class="btn btn-outline-warning mr-2" title="Ganti Password" onclick="g_pass();">
                        <i class="fa fa-key"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="javascript:void(0);" class="btn btn-outline-primary mr-2" title="Kunci" onclick="lock();">
                        <i class="fa fa-lock"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="btn btn-outline-success mr-2" data-widget="fullscreen" href="javascript:void(0);" role="button" title="Fullscreen">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="btn btn-outline-danger mr-2" title="Logout" data-toggle="modal" data-target="#logout">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
{{-- BODY START --}}
<aside class="main-sidebar sidebar-{{$tema}}-costume elevation-2">
    <a href="" class="brand-link">
        <img src="img/{{logo()}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-{{$tema}}"> <strong>{{inc('app_name')}}</strong> </span>
    </a>
    <div class="sidebar">
         {{-- <!--================================== SLIDEBAR START ========================--> --}}
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="{{$avatar}}" class="img-rounded elevation-3" alt="{{me('nama')}}" title="{{me('nama')}}">
            </div>
            <div class="info font-weight-bold text-{{($tema=='dark')?'white':'dark';}}" title="{{me('nama')}}">
                {{me('nama')}}
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(me('level') != 'dev' && me('level') != 'super_admin')
                <li class="nav-item">
                    <a href="me_profil" class="nav-link">
                    <i class="nav-icon fa fa-id-card"></i>
                    <p>
                    PROFIL SAYA
                    </p>
                    </a>
                </li>
            @endif
                @foreach ($side as $s1)
                    @if ($s1->url=='#' && $s1->colum==1)
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon {{$s1->icon}}"></i>
                            <p>
                                {{$s1->nama}}
                            <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php $side2 = db('sidebars')->orderBy('col2','asc')->where([me('akses')=>'1','group_1'=>$s1->id])->get();?>
                                @foreach ($side2 as $s2)
                                    @if ($s2->url=='#' && $s2->colum==2)
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="nav-icon {{$s2->icon}}"></i>
                                                <p>
                                                    {{$s2->nama}}
                                                <i class="fas fa-angle-left right"></i>
                                                </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <?php $side3 = db('sidebars')->orderBy('col3','asc')->where([me('akses')=>'1','group_1'=>$s2->id])->get();?>
                                                    @foreach ($side3 as $s3)
                                                        @if ($s3->colum==3)
                                                            <li class="nav-item">
                                                                <a href="{{$s3->url}}" class="nav-link">
                                                                <i class="nav-icon {{$s3->icon}}"></i>
                                                                <p>
                                                                    {{$s3->nama}}
                                                                </p>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                    @else
                                        @if ($s2->colum==2)
                                            <li class="nav-item">
                                                <a href="{{$s2->url}}" class="nav-link">
                                                <i class="nav-icon {{$s2->icon}}"></i>
                                                <p>
                                                    {{$s2->nama}}
                                                </p>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                       @if ($s1->colum==1)
                            <li class="nav-item">
                                <a href="{{$s1->url}}" class="nav-link">
                                <i class="nav-icon {{$s1->icon}}"></i>
                                <p>
                                {{$s1->nama}}
                                </p>
                                </a>
                            </li>
                       @endif
                    @endif
                @endforeach
                @if(me('level') == 'dev' || me('level') == 'super_admin')
                <!--========== SIDEBAR ADMIN START ==========-->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-staylinked"></i>
                        <p>
                            MENU SISTEM
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    @if(inc('mbook_status',1)=='true')
                    <li class="nav-item">
                        <a href="inc_m_book" class="nav-link">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                EDIT M-BOOK
                            </p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="inc_control" class="nav-link">
                            <i class="nav-icon fab fa-whmcs"></i>
                            <p>
                              PENGATURAN INTI
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="inc_apps" class="nav-link">
                            <i class="nav-icon fab fa-joget"></i>
                            <p>
                                PENGATURAN APL
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="inc_style" class="nav-link">
                            <i class="nav-icon fa fa-paint-brush"></i>
                            <p>
                                PENGATURAN UI
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="inc_smtp_email" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                SMTP EMAIL
                            </p>
                        </a> -->
                    </li>

                    </ul>
                </li>
                <!--========== SIDEBAR ADMIN END ==========-->
                @endif
                @if(me('level') == 'dev')
                <!--========== SIDEBAR ADMIN START ==========-->
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-resolving"></i>
                        <p>
                            MENU DEVELOP
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fab fa-mix"></i>
                                <p>
                                    MODUL
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="modul/web" class="nav-link">
                                        <i class="nav-icon fa fa-adjust"></i>
                                        <p>
                                            MODUL WEBSITE
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modul/fc" class="nav-link">
                                        <i class="nav-icon fa fa-adjust"></i>
                                        <p>
                                            MODUL FUNCTION
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modul/msg" class="nav-link">
                                        <i class="nav-icon fa fa-adjust"></i>
                                        <p>
                                            MODUL MSG
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modul/api" class="nav-link">
                                        <i class="nav-icon fa fa-adjust"></i>
                                        <p>
                                            MODUL API
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modul" class="nav-link">
                                        <i class="nav-icon fa fa-adjust"></i>
                                        <p>
                                            ALL MODUL
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="dev_easyui" class="nav-link">
                                <i class="nav-icon fab fa-hubspot"></i>
                                <p>
                                    TEMA JEASYUI
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="dev_engine" class="nav-link">
                                <i class="nav-icon fab fa-react"></i>
                                <p>
                                    HAK AKSES
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="dev_sidebar" class="nav-link">
                                <i class="nav-icon fa fa-th-list"></i>
                                <p>
                                    SIDEBAR
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="dev_admin" class="nav-link">
                                <i class="nav-icon fab fa-skype"></i>
                                <p>
                                    SUPER ADMIN
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="fontawesome" class="nav-link">
                                <i class="nav-icon fab fa-font-awesome"></i>
                                <p>
                                     FONTAWESOME
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="dev_file" class="nav-link">
                                <i class="nav-icon fa fa-window-restore"></i>
                                <p>
                                    PUBLIC FILE
                                </p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="dev_keygen" class="nav-link">
                                <i class="nav-icon fa fa-key"></i>
                                <p>
                                    KEYGEN
                                </p>
                            </a>
                        </li> -->

                    </ul>
                </li>
                <!--========== SIDEBAR ADMIN END ==========-->
               @endif
               @if(inc('mbook_status',1)=='true')
               <li class="nav-item">
                   <a href="user_m_book" class="nav-link">
                       <i class="nav-icon fa fa-book"></i>
                       <p>
                           MANUAL BOOK
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        {{-- <!--================================== SLIDEBAR END ==========================--> --}}
    </div>
</aside>
{{-- <!-- Start Content--> --}}
<div class="content-wrapper iframe-mode  bg-{{$tema}}" data-widget="iframe" data-loading-screen="750">
    <div class="nav navbar navbar-expand navbar-{{$tema}} navbar-{{$tema}} border-bottom p-0">

        <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
        <a class="nav-link bg-{{$tema}}" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
    </div>
    <div class="tab-content">
        <div class="tab-empty">
            <div class="card col-md-10 m-2">
                <div class="card-header">
                    <i class="fa fa-cog mr-2"></i> <small><strong>{{inc('app_name')}}</strong></small>
                </div>
                <div class="card-body">
                    <!-- {{auth()->user()->sort}} -->
                    <div class="row">
                        @if (inc('show_analog',1)=='true')
                        <div class="col-md-4">
                            <div class="jam_analog">
                                <div class="xxx">
                                    <div class="jarum jarum_detik"></div>
                                    <div class="jarum jarum_menit"></div>
                                    <div class="jarum jarum_jam"></div>
                                    <div class="lingkaran_tengah"></div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (inc('play_status',1)=='true')
                            <div class="col-md-{{(inc('show_analog',1)=='true')?4:6}}">
                                <center>
                                    <a href="{{inc('play_url')}}" target="_blank">
                                        <strong>Scan To Play Store</strong>
                                        <div id="play_store"></div>
                                    </a>
                                    <a href="javascript:void(0)" onclick="download_qr()">Download Qrcode</a>
                                </center>
                            </div>
                            <div class="col-md-{{(inc('show_analog',1)=='true')?4:6}}">
                                {!! inc('play_desk') !!}
                            </div>
                        @else
                            <div class="col-md-{{(inc('show_analog',1)=='true')?4:6}}">
                                <center>
                                    <a href="/" target="_blank">
                                        <strong>Scan To Website</strong>
                                        <div id="qrmain"></div>
                                    </a>
                                    <a href="javascript:void(0)" onclick="download_qr()">Download Qrcode</a>
                                </center>
                            </div>
                            <div class="col-md-{{(inc('show_analog',1)=='true')?4:6}}">
                                {!! inc('app_desk') !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <img src="img/{{logo()}}" width="32" class="mr-2">{{inc('app_instansi')}}<br>
                </div>
            </div>
        </div>
        <div class="tab-loading">
            <div>
                <span class="display-8">Loading ... <i class="fa fa-sync fa-spin ml-2"></i></span>
            </div>
        </div>
    </div>
</div>


</div>


{{-- <!--  End Content--> --}}
<div class="modal fade modal-top2" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <br>
        <br>
            <center>
                <div class="modal-content">
                    <div class="container">
                    <img src="/img/dev/Singout.gif" width="100%" class="mt-2">
                        <label class="mt-2 mb-2">Pilih tombol "logout", jika anda ingin menyelesaikan sesi ini.</label>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-outline-secondary float-start"  style="border-radius:2rem" type="button" data-dismiss="modal"><strong>CANCEL</strong></button>
                    <form id="myform" method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-outline-info" style="border-radius:2rem" type="submit"><strong>LOG OUT</strong></button>
                    </form>
                    </div>
                </div>
            </center>
    </div>
</div>
<div class="modal fade modal-top3" id="lengkapi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-dark"><i class="fab fa-react mr-2"></i>Akses Akun</h5>
            </div>
            <div class="modal-body">
            <form">

                <label>Pilih Akses</label>
                <div class="row">
                    <input type="hidden" id="aks">
                    @foreach($aa as $a)
                    <div class="col-md-12">
                         <input type="radio" name="akses" onclick="aks('{{$a->id}}');" id="akses{{$no++}}" class="mr-2" value="{{$a->id}}">{{$l->name.' - '.$a->sub}}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
            <a href="javascript:void(0);" onclick="lengkap()" class="btn btn-outline-dark btn-sm"><i class="fa fa-save mr-2"></i> Save</a>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- BODY END --}}
        <footer class="main-footer bg-{{$tema}}">
            <strong>Copyright &copy; {{ cpr()}} <a href="/" target="_blank">{{inc('app_instansi')}}</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Tanggal</b> {{date("d").' '.ma(date("m")).' '.date("Y")}}
            </div>
        </footer>

        <script src="css_js/jquery/jquery.min.js"></script>
        <script src="css_js/jquery-ui/jquery-ui.min.js"></script>
        <script src="css_js/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="css_js/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="css_js/toastr/toastr.min.js"></script>
        <script src="css_js/lte/js/adminlte.js"></script>
        <script src="css_js/owlcarousel/owl.carousel.min.js"></script>

        </body>
        <div id="autenticate"></div>
        <div id="load"></div>
        <script src="css_js/js_me/function.js"></script>
        <script src="css_js/js_me/autenticate.js"></script>
        <script type="text/javascript">
            var lengkapi = '{{$lengkapi}}';
            document.getElementById('aks').value='{{me("akses")}}';
            if(lengkapi=='true'){
                document.getElementById('akses1').checked = true;
                $('#lengkapi').modal({backdrop: "static"});
            }
            function aks(v){
                document.getElementById('aks').value=v;
            }
            function lengkap(){
                var _token = $("meta[name='csrf-token']").attr("content");
                var key = '@@@';
                var act = document.getElementById('aks').value;
                $.post("/apps",{
                    _token,key,act
                },function(result){
                    if (result.success){
                        toastr.success('Berhasil Memilih Akses.');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else{
                        toastr.error(result.errorMsg);
                    }
                },'json');
            }
        </script>
        <script type="text/javascript">
            $.widget.bridge("uibutton", $.ui.button);
            const secondHand = document.querySelector('.jarum_detik');
            const minuteHand = document.querySelector('.jarum_menit');
            const jarum_jam = document.querySelector('.jarum_jam');

            function setDate(){
                const now = new Date();
                const seconds = now.getSeconds();
                const secondsDegrees = ((seconds / 60) * 360) + 90;
                secondHand.style.transform = `rotate(${secondsDegrees}deg)`;
                if (secondsDegrees === 90) {
                    secondHand.style.transition = 'none';
                } else if (secondsDegrees >= 91) {
                    secondHand.style.transition = 'all 0.05s cubic-bezier(0.1, 2.7, 0.58, 1)'
                }

                const minutes = now.getMinutes();
                const minutesDegrees = ((minutes / 60) * 360) + 90;
                minuteHand.style.transform = `rotate(${minutesDegrees}deg)`;

                const hours = now.getHours();
                const hoursDegrees = ((hours / 12) * 360) + 90;
                jarum_jam.style.transform = `rotate(${hoursDegrees}deg)`;
            }

            setInterval(setDate, 1000)
        </script>
        <!-- QRCODE STYLE START -->
        <script src="css_js/js_me/qr-code-styling.js"></script>
        <script src="css_js/js_me/show_qr3.js"></script>
        <script type="text/javascript">
        cek_lock("{{me('kunci')}}");
              var play_status = "{{inc('play_status',1)}}";
              if(play_status=='true'){
                  var data = "{{ inc('play_url') }}";
                  var logo = "img/dev/play.png";
                  var color = "{{color('qr_dot')}}";
                  qrcode("play_store", data, logo, color);
              }else{
                  var data = "{{ route('home') }}";
                  var logo = "img/{{logo_n()}}";
                  var color = "{{color('qr_dot')}}";
                  qrcode("qrmain", data, logo, color);
              }
              function download_qr(){
                    if(play_status=='true'){
                        var data = "{{ inc('play_url') }}";
                        var logo = "img/dev/play.png";
                        var color = "{{color('qr_dot')}}";
                        download_qrcode(data, logo, color);
                    }else{
                        var data = "{{ route('home') }}";
                        var logo = "img/{{logo_n()}}";
                        var color = "{{color('qr_dot')}}";
                        download_qrcode(data, logo, color);
                    }
              }
        </script>
        <!-- QRCODE STYLE END -->
