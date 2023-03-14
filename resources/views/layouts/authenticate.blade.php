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
    <link rel="stylesheet" type="text/css" href="/css_js/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css_js/fontawesome-free-6.2.1-web/css/all.min.css">
    <script src="/css_js/web/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css_js/toastr/toastr.min.css">
    <link rel="stylesheet" href="/css_js/login/main.css">
    <script src="/css_js/toastr/toastr.min.js"></script>
    @if(is_online())
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endif
</head>
{{-- @include('css') --}}
<style>
    .input-div:before,
    .input-div:after {
        content: '';
        position: absolute;
        bottom: -2px;
        width: 0%;
        height: 2px;
        background-color: #fff;
        transition: .4s;
    }
    .input-div.focus>.i>i {
        color: {{color('pri_a')}};
    }
    a:hover {
        color: {{color('pri_a')}};
    }

    .btn {
        display: block;
        width: 80%;
        height: 40px;
        border-radius: 25px;
        outline: none;
        border: none;
        background-image: linear-gradient(to right, {{color('pri_a')}}, {{color('pri_b')}}, {{color('pri_c')}});
        background-size: 200%;
        font-size: 1.2rem;
        color: {{color('pri_b')}};
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        margin: 1rem 0;
        cursor: pointer;
        transition: .5s;
    }
</style>
<body>

@yield('content')

<div id="load"></div>
<script type="text/javascript" src="/css_js/login/main.js"></script>
<script type="text/javascript" src="/css_js/js_me/function.js"></script>

</body>
</html>
