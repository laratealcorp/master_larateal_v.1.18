<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncCon extends Controller
{
    // public function __construct(){}

    // APPS START
    public function mbook(){
        only_admin(1);
        if(me('level')=='dev'){
            $data['lvl'] = db('a_levels')->get();
        }else{
            $data['lvl'] = db('a_levels')->whereNotIn('id',['dev'])->get();
        }
        return view('inc/mbook',$data);
    }
    public function get_mbook()
    {
        only_admin(1);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('manual_books');
        $country = db('manual_books')
            ->where('judul','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
        // return response()->json($result, 200);
    }
    public function check_mbook()
    {
        only_admin(1);
        $db = 'manual_books';
        $id = htmlspecialchars($_REQUEST['id']);
        $row = htmlspecialchars($_REQUEST['row']);
        $o = get_row($db,['id' => $id]);
        $val = ($o->$row == '0') ? '1' : '0';
        update($db, [$row => $val], ['id' => $id]);
        echo json_encode(['success' => true]);
    }
    public function crud_mbook()
    {
        only_admin(1);
        $db = 'manual_books';
        $res = false;
        $name = '';
        $id = htmlspecialchars($_REQUEST['id']);
        $role = htmlspecialchars($_REQUEST['role']);
        if ($role == 'delete'){
            $o = get_row($db,['id' => $id]);
            if ($o->role == 'PDF'){
                $path = 'file/pdf/' . $o->content;
                (!file_exists($path)) ?: unlink($path);
            }
            delete($db, ['id' => $id]);
            echo json_encode(['success' => true]);
            exit();
        }
        $judul = htmlspecialchars($_REQUEST['judul']);
        $text = $_REQUEST['text'];
        $data_in = [
            'role' => $role,
            'judul' => $judul,
        ];
        if ($id == 'insert') {
            $data_in['id'] = time();
            $data_in['created_at'] = date("Y-m-d H:i:s");
            if ($role == 'PDF') {
                if ($_FILES['file']['name'] != '') {
                    $test = explode('.', $_FILES['file']['name']);
                    $extension = end($test);
                    if ($extension != 'pdf') {
                        echo json_encode(['errorMsg' => 'Gagal Di Save Extensi Salah. Hanya PDF']);
                        exit;
                    }
                    $name = $db . '_' . time() . '.' . $extension;
                    $location = 'file/pdf/' . $name;
                    $res = move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    $data_in['content'] = ($res) ? $name : '';
                }
            }else{
                $data_in['content'] = $text;
            }
            insert($db, $data_in);
        } else {
            $o = get_row($db,['id' => $id]);
            $data_in['updated_at'] = date("Y-m-d H:i:s");
            if ($role == 'PDF') {
                if ($_FILES['file']['name'] != '') {
                    $test = explode('.', $_FILES['file']['name']);
                    $extension = end($test);
                    if ($extension != 'pdf') {
                        echo json_encode(['errorMsg' => 'Gagal Di Save Extensi Salah. Hanya PDF']);
                        exit;
                    }
                    $name = $db . '_' . time() . '.' . $extension;
                    $location = 'file/pdf/' . $name;
                    $res = move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    $data_in['content'] = ($res) ? $name : '';
                }
            }else{
                $data_in['content'] = $text;
            }
            $path = 'file/pdf/' . $o->content;
            (!file_exists($path)) ?: unlink($path);
            update($db, $data_in, ['id' => $id]);
        }
        echo json_encode(['success' => true, 'id' => $id, 'file' => $res, 'con' => $name]);
    }
    public function apps(){
        only_admin(1);
        $data['o'] ='';
        return view('inc/apps',$data);
    }
    public function upload_logo()
    {
        $id  = request()->input('id');
        $root = ($id=='login_wave')?'img/dev/':'img/';
        if ($_FILES['file']['name'] != '') {
            $test = explode('.', $_FILES['file']['name']);
            $extension = end($test);
            $name = $id . '_' . time() . '.' . $extension;

            $logo = inc($id);
            $location = $root. $name;

            $res = move_uploaded_file($_FILES['file']['tmp_name'], $location);
            if ($res) {
                if ($logo) {
                    $path = $root. $logo;
                    (!file_exists($path)) ?: unlink($path);
                }
                update('incs', ['code' => $name], ['id' => $id]);
                echo '<img src="'. $location . '" width="100%" />';
            }
        }
    }
    // APPS END
    // STYLE START
    public function style(){
        only_admin(1);
        $data['frame'] = db('frame_uis')->orderBy('id','DESC')->where('status','true')->get();
        return view('inc/style',$data);
    }
    public function update_color(){
        only_admin(1);
        $id  = request()->input('id');
        $col  = request()->input('col');
        $val  = request()->input('val');
        if($val==null){
            return response()->json([
                'errorMsg' => 'save gagal kolom harus di isi.'
            ], 200);
            exit();
        }
       $res = update('colors',[$col=>$val],['id'=>$id]);
       if($res){
            return response()->json([
                'success' => true
            ], 200);
       }else{
            return response()->json([
                'errorMsg' => 'Gagal Di Save'
            ], 200);
       }
    }
    // STYLE END
    // CONTROL START
    public function control(){
        only_admin(1);
        $data['lvl'] = db('a_levels')->where('role','0')->get();
        $x=num_rows('moduls',['class'=>'web','status'=>'true']);
        if($x==1){
            $data['web_modul']=true;
        }else{
            update('incs',['status'=>'false'],['id'=>'web_status']);
            $data['web_modul'] = false;
        }
        $y=num_rows('moduls',['class'=>'msg','status'=>'true']);
        if($y>0){
            $data['msg_modul']=true;
        }else{
            update('incs',['status'=>'false'],['id'=>'app_forgot']);
            update('incs',['status'=>'false'],['id'=>'app_register']);
            $data['msg_modul'] = false;
        }
        return view('inc/control',$data);
    }
    public function update_inc(){
        only_admin(1);
        $id  = request()->input('id');
        $col  = request()->input('col');
        $val  = request()->input('val');
        if($val==null){
            return response()->json([
                'errorMsg' => 'save gagal kolom harus di isi.'
            ], 200);
            exit();
        }
       $res = update('incs',[$col=>$val],['id'=>$id]);
       if($res){
            return response()->json([
                'success' => true
            ], 200);
       }else{
            return response()->json([
                'errorMsg' => 'Gagal Di Save'
            ], 200);
       }
    }
    // CONTROL END


}
