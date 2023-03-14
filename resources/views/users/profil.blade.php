@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
<a href="javascript:history.back();" class="btn-sm bt-1 r20" title="Back"><i class="fa fa-arrow-left"></i></a>
</div>
<div class="btr">
<a href="javascript:void(0);" onclick="cetak();" class="btn-sm btn-danger r20" title="Print"><i class="fa fa-print fa-sm"></i></a>
    <a href="" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<div class="container mt-2">
        <center>
            <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="fa fa-id-card mr-2 mb-3"></i><strong><small>{{ hb('Profil')}}</small></strong></a>
        </center>
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
                        <small>{{($o->created_at)?date("d-m-Y", strtotime($o->created_at)):'--'}}</small>
                    </div>
                </div>
            </div>
            <!-- BATAS GARIS 1 -->
            
        </div>
    </div>
</div>
<script>
//-----------------------------------------start
function cetak() {
    window.open("/cetak_profil/{{$o->id}}", "mywindow", "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=auto,height=auto,left =304,top = 150.5");
    testwindow.moveTo(0, 0);
}
//-----------------------------------------end
</script>
@endsection