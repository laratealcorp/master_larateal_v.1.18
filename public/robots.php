<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
    <title>APLIKASI TERKUNCI</title>
    <link rel="icon" type="image/x-icon" href="/img/dev/dis.png" />
    <link rel="stylesheet" type="text/css" href="css_js/easyui/bootstrap_4.3.1.min.css">
    <link rel="stylesheet" type="text/css" href="css_js/easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="css_js/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="css_js/easyui/themes/color.css">
    <link rel="stylesheet" href="css_js/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" href="css_js/toastr/toastr.min.css">
    <script src="css_js/easyui/jquery.min.js"></script>
    <script src="css_js/easyui/jquery.easyui.min.js"></script>
    <script src="css_js/easyui/datagrid-filter.js"></script>
    <script src="css_js/easyui/datagrid-detailview.js"></script>
    <script src="css_js/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="css_js/toastr/toastr.min.js"></script>
    <style>
        body {
            background-color: #fff;
            color: #000;
        }

        .form_login {
            left: 50%;
            top: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
        }

        @media only screen and (max-width: 600px) {
            /* .form_login {
                left: 0;
                top: 50%;
                position: absolute;
                transform: translate(-50%, -50%);
            } */
        }
    </style>
</head>

<body>
    <div class="form_login">
        <center>
            <img src="img/dev/lock.gif" width="240px" class="img-fluid">
            <br>
            MAAF ! APLIKASI TERKUNCI
            <br>
            <div class="card p-4 mt-4">
                APLIKASI HANYA BISA DI BUKA PADA URL :
                <br>
                <div class="card p-2 m-2 float-left">
                <?php
                  $o=json_decode(base64_decode($_GET['data']));
                //   echo $o->url;
                  echo '<small><a href="http://'.$o->url.'" target="_blank"><strong>http://'.$o->url.'</strong></a></small>
                <small><a href="https://'.$o->url.'" target="_blank"><strong>https://'.$o->url.'</strong></a></small>';
                  if($o->loc){
                    echo '<strong>Local</strong> <small><a href="'.$o->loc.'" target="_blank"><strong>'.$o->loc.'</strong></a></small>';
                  }
                  if($o->val){
                    echo '<strong>Valet</strong><small><a href="'.$o->val.'" target="_blank"><strong>'.$o->val.'</strong></a></small>';
                  }
                  echo '</div>';
                  if($o->git){
                    echo '<a href="'.$o->git.'" class="text-dark" target="_blank"><i class="fa-brands fa-github fa-2x mr-2 mt-4"></i> Go to Github</a>';
                  }
                  if($o->info){
                    echo '<a href="'.$o->info.'" class="text-primary" target="_blank"><i class="fa fa-info mr-2 mt-4"></i> More Info</a>';
                  }
                ?>  
            </div>
        </center>
</body>

</html>
