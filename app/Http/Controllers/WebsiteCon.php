<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inc;

class WebsiteCon extends Controller
{
    public function home(){
        if(inc('web_status',1)=='true'){
            return abort(404, 'HALAMAN BELUN DI BUAT');
        }else{
            return redirect('login');
        }
    }
}
