@extends('layouts.frame')
@section('content')
<!-- TOP NAVIGASI START -->
<div class="card-header col-md-12 wid-t bg-1">
    <center>
        <small>
            <h6>
                <!-- <a href="" class="btn-sm bt-1 float-left" title="ADD"><i class="fa-solid fa-plus"></i></a> -->
                     <i class="fab fa-whmcs mr-2"></i> {{ strtoupper('control setting') }}
                     {!! tmb_r1() !!}
            </h6>
        </small>
    </center>
</div>
<!-- TOP NAVIGASI END -->
@endsection