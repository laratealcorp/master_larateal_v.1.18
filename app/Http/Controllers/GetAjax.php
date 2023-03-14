<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class GetAjax extends Controller
{
    public function index(){
        // return view('app/index');
        return abort(403, 'Unauthorized action.');
    }
    public function get_user(){
      $response = Http::get('https://doubtful-crow-stole.cyclic.app/sitihulwalayyanamazaya');
      $e = json_decode($response->body());
      echo $e->img;

    // $client = new Client();
    // $res = $client->request('GET', 'https://doubtful-crow-stole.cyclic.app/sitihulwalayyanamazaya');
    // echo $res->getStatusCode();
    // 200
    // echo $res->getHeader('content-type');
    // 'application/json; charset=utf8'
    // echo $res->getBody()->data;
    //   $user = db('users')->join('user_x', 'users.level', '=', 'users.level')->get();
    //   return json_encode($user);
    //   $res = update('users',[
    //     'level'=>'super_admin',
    //     'akses'=>'super_admin',
    //     'nama'=>'Ismail samudra',
    //     'email'=>'admin@app.com',
    //     'hp'=>'0852022000',
    //     'password'=>bcrypt('admin'),
    //     'jk'=>'P',
    //     'foto'=>'admin_x.png',
    //     'status'=>'true'
    //   ],['id'=>'7d8b010b1b8d8f4630f1a7687537e753_1676305825']);
    // $res = rename_table('tabel1','mydata');
    //    if($res){
    //        return json_encode(['status'=>'success']);
    //     }else{
    //        return json_encode(['errorMsg'=>'Gagal di save']);
    //    }
    // return Excel::download(new UsersExport, 'users_'.time().'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
