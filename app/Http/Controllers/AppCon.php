<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppCon extends Controller
{
    // public function __construct(){}

    public function index(){
        fungsi_app();
        $data['lengkapi']='';
        $data['no']=1;
        $data['l']=get_row('a_levels',['id'=>me('level')]);
        $data['aa']=db('a_akses')->where(['id_level'=>me('level')])->get();
        $data['side']=db('sidebars')->orderBy('col1','asc')->where(me('akses'),'1')->get();
        $avatar = (me('foto')==null)?'/img/avatar/'.me('jk').'2.png':'/img/avatar/'.me('foto');
        // $data['avatar']=(me('level')=='dev')?me('foto'):$avatar;
        $data['avatar']=$avatar;
        $data['tema']=(inc('tema'))?inc('tema'):'light';
        if(me('level')==inc('level_regist')){
                $l = num_rows('a_akses',['id_level'=>me('level')]);
                if($l>1){
                    if(me('last_login')==null){
                        $data['lengkapi']='true';
                    }
                }
        }
        return view('apps',$data);
    }
    public function kunci()
    {
        $id=me('email');
        $x=get_row('users',['email'=>$id]);
        $p = htmlspecialchars($_POST['key']);
        $act = htmlspecialchars($_POST['act']);
        if($p=='@#@'){
            if(update('users',['kunci'=>'true'],['email'=>$id])){
                echo json_encode(array('success' => true));
                exit;
            } else {
                echo json_encode(array('errorMsg' => 'Server Sibuk'));
                exit;
            }
        }elseif($p=='@@@'){
            if(update('users',['last_login'=>date("d-m-Y H:i"),'akses'=>$act],['email'=>$id])){
                echo json_encode(array('success' => true));
                exit;
            } else {
                echo json_encode(array('errorMsg' => 'Server Sibuk'));
                exit;
            }
        }else{
            if($act=='change1'){
                if(base64_decode($x->pin)==$p) {
                    echo json_encode(array('success' => true));
                    exit;
                } else {
                    echo json_encode(array('errorMsg' => 'PIN Lama Salah!'));
                    exit;
                }
            }elseif($act=='change2'){
                if(update('users',['pin'=>base64_encode($p)],['email'=>$id])){
                    security_level_2($p);
                    echo json_encode(array('success' => true));
                    exit;
                } else {
                    echo json_encode(array('errorMsg' => 'Server Sibuk'));
                    exit;
                }
            }else{
                if($x->pin==null){
                    if(update('users',['pin'=>base64_encode('0000'),'kunci'=>'false'],['email'=>$id])){
                        echo json_encode(array('success' => true));
                        exit;
                    } else {
                        echo json_encode(array('errorMsg' => 'Server Sibuk'));
                        exit;
                    }
                }
                if(base64_decode($x->pin)==$p) {
                    if(update('users',['kunci'=>'false'],['email'=>$id])){
                        echo json_encode(array('success' => true));
                        exit;
                    } else {
                        echo json_encode(array('errorMsg' => 'Server Sibuk'));
                        exit;
                    }
                } else {
                    echo json_encode(array('errorMsg' => 'PIN Salah!'));
                    exit;
                }
            }
        }

    }
}
