<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inc;

class WebsiteCon extends Controller
{
    public function home(){
        if(inc('web_status',1)=='true'){
            $m = num_rows('moduls',['class'=>'web','status'=>'true']);
            if($m==1){
                $m = get_row('moduls',['class'=>'web','status'=>'true']);
                $data['m']=$m;
                $mig = num_and_get('tb_'.$m->id);
                $data['mig'] = ($mig)?$mig:[];
                return view('costume/'.$m->id.'/index',$data);
            }else{
                return abort(404);
            }
        }else{
            return redirect('login');
        }
    }
}

