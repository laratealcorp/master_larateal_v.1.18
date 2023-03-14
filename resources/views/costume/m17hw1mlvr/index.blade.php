@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="btl">
    <a href="javascript:void(0);" onclick="add();" class="btn-sm bg-1 r20" title="ADD"><i class="fa fa-plus"></i></a>
    <a href="javascript:history.back();" class="btn-sm bg-1 r20" title="Back"><i class="fa fa-arrow-left fa-sm"></i></a>
</div>
<div class="btr">
    <a href="javascript:void(0);" onclick="$(`#dguser`).datagrid(`reload`);" class="btn-sm bt-1 r20" title="Reload"><i class="fa-solid fa-sync fa-sm"></i></a>
</div>
<!-- TOP NAVIGASI END -->
<!-- BODY START -->
<div class="container mt-2">
    <center>
        <a href="" class="text-{{(inc('tema')=='dark')?'white':'dark';}}"><i class="{{$icon}} mr-2 mb-3"></i><strong><small>{{$label}}</small></strong></a>
    </center>



</div>
@endsection