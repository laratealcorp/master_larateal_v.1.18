@extends('layouts.frame')
@section('content')
<div class="container">
    <center>
        <img src="/img/{{logo()}}" alt="Logo" class="brand-image elevation-3" width="100px">
       <h2>{{inc('app_name')}}</h2>
    </center>
   <hr>
   <center>
       <strong><h5>BIO DATA</h5></strong>
   </center>
</div>
<br>
<div class="container mt-4">
    <div class="row m-1">
        <div class="col-md-3">
            <div class="row">
                <div class="mb-2 col-md-12">
                    <div class="text-center">
                        <img src="/img/avatar/{{avatar($o->jk,$o->foto)}}" width="100%" class="img-fluit" style="border-radius:10px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Nama</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                    <strong>{{$o->nama}}</strong>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Email</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-12">
                                {{$o->email}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;No Hp/Whatsapp</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        <div class="row">
                             <div class="col-md-12">
                               {{$o->hp}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Jenis Kelamin</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                       {{($o->jk=='L')?'Laki-Laki':'Perempuan';}}
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            @foreach($ss as $s)
            <?php $name = $s->name ?>
                        <!-- BATAS GARIS 1 -->
                        <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;{{$s->label}}</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        {{$x->$name}}
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            @endforeach
            <!-- BATAS GARIS 1 -->
            <div class="row my-1">
                <div class="col-md-4">
                    <div class="card table-responsive">
                        <strong>&nbsp;&nbsp;Tanggal Register</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card col table-responsive">
                        {{($o->created_at)?date("d-m-Y", strtotime($o->created_at)):'--'}}
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            <!-- BATAS GARIS 1 -->
            <div class="row mt-5">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                       <div id="qrmain" class="float-right"></div>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            
        </div>
    </div>
</div>
<script src="/css_js/js_me/qr-code-styling.js"></script>
<script src="/css_js/js_me/show_qr2.js"></script>
<script>
    window.print();
    var data = "{{ route('home').'/cetak_profil/'.$o->id }}";
    var logo = "/img/{{logo_n()}}";
    var color = "{{color('qr_dot')}}";
    qrcode("qrmain", data, logo, color);
</script>
@endsection