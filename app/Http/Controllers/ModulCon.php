<?php

namespace App\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use File;

class ModulCon extends Controller
{
    public function index($class=null){
        only_admin();
        $data['class']=$class;
        return view('modul/index',$data);
    }
    public function get_data($class=null)
    {
        only_admin();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sort';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        if($class==null){
            $result['total'] = num_rows('moduls');
            $country = db('moduls')
            ->where('name','LIKE','%'.$search.'%')
            ->orWhere('id','LIKE','%'.$search.'%')
            ->orWhere('autor','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        }else{
            $result['total'] = num_rows('moduls',['class'=>$class]);
            $country = db('moduls')
            ->where('class',$class)
            ->where('name','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        }
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    public function install(){
        only_admin();
        $id  = request()->input('id');
        $cek = num_rows('moduls',['id'=>$id]);
        if($cek<1){
            echo json_encode(['errorMsg' => 'Id salah']);
            exit();
        }
        $m = get_row('moduls',['id'=>$id]);
        if($m->class=='web'){
            $x=num_rows('moduls',['class'=>'web','status'=>'true']);
            if($x>0){
                echo json_encode(['errorMsg' => 'Modul web hanya dapat di install 1']);
            exit();
            }
        }
        if(true_modul($id)){
            echo json_encode(['errorMsg' => 'Modul sudah di install']);
            exit();
        }
        $route = DIR_MODUL . $id.'/route.txt';
        $constant = DIR_MODUL . $id.'/constant.txt';
        $zip_cont = DIR_MODUL . $id.'/C_'.$id.'.zip';
        $zip_mod = DIR_MODUL . $id.'/M_'.$id.'.zip';
        $zip_view = DIR_MODUL . $id.'/view.zip';
        $zip_dir = DIR_MODUL . $id.'/public.zip';
        if(file_exists($route)){
            rph(ROUTE_WEB,$route);
            if(file_exists($constant)){
                rph(CONSTANT,$constant);
                rpd(CONSTANT,$constant,'//DATA');
            }
            if(rpd(ROUTE_WEB,$route,'//DATA')){
                if(file_exists($zip_cont)){
                    zip_extr($zip_cont,DIR_CON);
                }
                if(file_exists($zip_mod)){
                    zip_extr($zip_mod,DIR_MOD);
                }
                if(file_exists($zip_view)){
                    zip_extr($zip_view,DIR_VIEW.$id);
                }
                if(file_exists($zip_dir)){
                    zip_extr($zip_dir,DIR.$id);
                }
                update('moduls',['status'=>'true'],['id'=>$id]);
            }else{
                echo json_encode(['errorMsg' => 'Route Error']);
                exit();
            }
        }else{
            echo json_encode(['errorMsg' => 'Route not found']);
            exit();
        }
        echo json_encode(['success' => true]);
    }
    public function uninstall(){
        only_admin();
        $id  = request()->input('id');
        $cek = num_rows('moduls',['id'=>$id]);
        if($cek<1){
            echo json_encode(['errorMsg' => 'Id salah']);
            exit();
        }
        if(!true_modul($id)){
            echo json_encode(['errorMsg' => 'Modul sudah Di Uninstall']);
            exit();
        }
        $m = get_row('moduls',['id'=>$id]);
        $route = DIR_MODUL . $id.'/route.txt';
        if(!file_exists($route)){
            echo json_encode(['errorMsg' => 'Modul Error']);
            exit();
        }
        if(!rph(ROUTE_WEB,$route)){
            echo json_encode(['errorMsg' => 'Route Error']);
            exit();
        }
        $constant = DIR_MODUL . $id.'/constant.txt';
        if(file_exists($constant)){
            rph(CONSTANT,$constant);
        }
        if(update('moduls',['status'=>'false'],['id'=>$id])){
            if(file_exists(DIR_CON.'C_'.$id.'.php')){
                 unlink(DIR_CON.'C_'.$id.'.php');
            }
            if(file_exists(DIR_MOD.'M_'.$id.'.php')){
                 unlink(DIR_MOD.'M_'.$id.'.php');
            }
            if(file_exists(DIR_VIEW.$id)){
                File::deleteDirectory(DIR_VIEW.$id);
            }
            delete('sidebars',['m'=>$id]);
            update('incs',['status'=>'false'],['id'=>'web_status']);
        }
        echo json_encode(['success' => true]);
    }
    public function upload(){
        only_admin();
        $id = 'm'.random('naa',9);
        if($_FILES['zip_file']['name'] != ''){ 
            $file_name = $_FILES['zip_file']['name'];   
            $array = explode(".", $file_name);  
            $name = $array[0];  
            $ext = $array[1]; 
            $data['class']='fc';
            $zipf = DIR.'mod/'. $id.'.'.$ext;    
            if($ext!='bin'){
                echo json_encode(['errorMsg' => 'extensi Harus .bin']);
                abort(403);
            }
            if(move_uploaded_file($_FILES['zip_file']['tmp_name'], $zipf))  
            {  
                if(file_exists($zipf)){
                    upload_file_lt($zipf,$id);
                }
            } 
            echo json_encode(['success' => true]);
        }
    }
    public function cek_modul(){
        only_admin();
        $m = glob(DIR."mod/*"); 
        $d = num_rows('moduls');
        if(count($m)>($d+1)) {
            for ($i=0; $i<count($m); $i++){
                $e = str_replace(DIR.'mod/',"", $m[$i]);
                if(file_exists($m[$i])){
                    if(is_file($m[$i])){
                        if($e!='index.html'){
                            $z = explode('.',$e);
                            $id = str_replace('.'.end($z),"", $e);
                            $x = num_rows('moduls',['id'=>$id]);
                            if($x<1){
                                $this->extract($m[$i],$e);
                            }
                        }
                    }
                }
            }
        }
        if(count($m)<($d+1)) {
            // $dd = db('moduls')->get();
            // $o = get_row('moduls',['id'=>'mj3hzgiqp4']);
            // if(base64_to_file($o->base64,DIR.'mod/mj3hzgiqp4.bin')){
            //     $this->extract(DIR.'mod/mj3hzgiqp4.bin','mj3hzgiqp4.bin');
            // }
        }
       echo json_encode(['success' => true]);
    }
    public function delete(){
        only_admin();
        $id  = request()->input('id');
        $o = get_row('moduls',['id'=>$id]);
        $cek = num_rows('moduls',['id'=>$id]);
        if($cek<1){
            echo json_encode(['errorMsg' => 'Id salah']);
            exit();
        }
        if(true_modul($id)){
            echo json_encode(['errorMsg' => 'Modul Terinstall tidak dapat di hapus.']);
            exit();
        }
        $route = DIR_MODUL . $id.'/route.txt';
        if(!file_exists($route)){
            echo json_encode(['errorMsg' => 'Modul Error']);
            exit();
        }
        if(!rph(ROUTE_WEB,$route)){
            echo json_encode(['errorMsg' => 'Route Error']);
            exit();
        }
        $constant = DIR_MODUL . $id.'/constant.txt';
        if(file_exists($constant)){
            rph(CONSTANT,$constant);
        }
        if(delete('moduls',['id'=>$id])){
            if(file_exists(DIR_CON.'C_'.$id.'.php')){
                 unlink(DIR_CON.'C_'.$id.'.php');
            }
            if(file_exists(DIR_MOD.'M_'.$id.'.php')){
                 unlink(DIR_MOD.'M_'.$id.'.php');
            }
            if(file_exists(DIR_VIEW.$id)){
                File::deleteDirectory(DIR_VIEW.$id);
            }
            if(file_exists(DIR.$id)){
                File::deleteDirectory(DIR.$id);
            }
            if(file_exists(DIR.'mod/'.$id.'.bin')){
                unlink(DIR.'mod/'.$id.'.bin');
            }
            File::deleteDirectory(DIR_MODUL.$id);
        }
        if (Schema::hasTable('tb_'.$id)){
            $mig = num_and_get('tb_'.$id);
            if($mig){
                foreach($mig as $g){
                    Schema::dropIfExists($g->id);
                }
            }
            Schema::dropIfExists('tb_'.$id);
        }
        $this->del_sys($id);
        echo json_encode(['success' => true]);
    }
    private function extract($zipf,$file_name){ 
        $array = explode(".", $file_name);  
        $id = $array[0];  
        if(file_exists(DIR_CON.'C_'.$id.'.php')){
            unlink(DIR_CON.'C_'.$id.'.php');
        }
        if(file_exists(DIR_MOD.'M_'.$id.'.php')){
            unlink(DIR_MOD.'M_'.$id.'.php');
        }
        if(file_exists(DIR_VIEW.$id)){
            File::deleteDirectory(DIR_VIEW.$id);
        }
        $name = $array[0];  
        $ext = $array[1];
        $this->del_sys($id); 
        if(is_dir(DIR_MODUL.$id)){
            File::deleteDirectory(DIR_MODUL.$id);
        }
        true_file_lt($zipf,$id);
    }
    private function del_sys($id){
        $x=num_rows('moduls',['class'=>'web','status'=>'true']);
        $y=num_rows('moduls',['class'=>'msg','status'=>'true']);
        $inc=num_rows('incs',['m'=>$id]);
        $col=num_rows('colors',['m'=>$id]);
        if($inc>0){
            delete('incs',['m'=>$id]);
        }
        if($col>0){
            delete('colors',['m'=>$id]);
        }
        if($x<1){
            update('incs',['status'=>'false'],['id'=>'web_status']);
        }
        if($y<1){
            update('incs',['status'=>'false'],['id'=>'app_forgot']);
            update('incs',['status'=>'false'],['id'=>'app_register']);
        }
    }

}
