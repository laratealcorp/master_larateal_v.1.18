<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use File;
use ZipArchive;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DevCon extends Controller
{
    // public function __construct(){}

    // ENGINE START
    public function easyui(){
        only_admin();
        $data['t1'] = color('pri_a');
        $data['t2'] = color('pri_b');
         // $data['images'] = glob(public_path()."/css_js/easyui/tema/*", GLOB_BRACE); 
         $data['images'] = db('frame_uis')->whereNotIn('id',['default'])->get();
        return view('develope/easyui',$data);
    }
    public function upload_easyui(){
        only_admin(); 
        $id  = request()->input('id');
        $path = 'css_js/easyui/tema/'; 
        if($id=='ui'){
            if($_FILES['zip_file']['name'] != ''){ 
                $file_name = $_FILES['zip_file']['name'];  
                $file_name = str_replace(" ","-",strtolower($file_name));  
                $array = explode(".", $file_name);  
                $name = $array[0];  
                $ext = $array[1];   
                $zipf = $path . $name .'.zip';  
                $ui = $path . $name .'.ui';  
                $r = num_rows('frame_uis',['id'=>$name]);
                if($r>0){
                    echo json_encode(['errorMsg' => 'File sudah ada.']);
                    exit(); 
                }
                if($ext == 'ui')  
                {  
                    if(move_uploaded_file($_FILES['zip_file']['tmp_name'], $zipf))  
                    {  
                        if(zip_extr($zipf,$path.$name)){
                            if(file_exists($path.$name)){
                                insert('frame_uis',['id'=>$name]);
                                rename($zipf, $ui);
                                echo json_encode(['success' => true]);
                                exit();
                            }else{
                                unlink($zipf); 
                                echo json_encode(['errorMsg' => 'Format zip salah.']);
                               exit(); 
                            }
                        } 
                    }  
                } else{
                echo json_encode(['errorMsg' => 'Extensi harus ui.']);
                exit();
                } 
            } 
        }else{
            $id = preg_replace('/\s+/', '', $id);
            if(file_exists($path.$id)){
                File::deleteDirectory($path.$id);
                if(file_exists($path.$id.'.ui')){
                    unlink($path.$id.'.ui');
                }
                delete('frame_uis',['id'=>$id]);
                if($id==inc('frame_ui')){
                    update('incs',['code'=>'default'],['id'=>'frame_ui']);
                }
                echo json_encode(['success' => true]);
                exit();
            }else{
                echo json_encode(['errorMsg' => 'Server Error.']);
                exit();
            }

        }
    }
    public function file($id=null){
        only_admin();
        $data['t1'] = color('pri_a');
        $data['t2'] = color('pri_b');
        $data['images'] = glob("file".u2(u())."/*"); 
        return view('develope/file',$data);
    }
    public function file_dir(){
        only_admin();
        $id  = request()->input('id');
        $dir  = u2(request()->input('dir'));
        $act  = request()->input('act');
        $id = preg_replace('/\s+/', '_', $id);
        $path = 'file'.$dir.'/'.$id;
        if($act=='insert'){
            if(file_exists($path)){
                echo json_encode(['errorMsg' => 'Sudah ada']);
                exit();
            }else{
                File::makeDirectory($path, $mode = 0777, true, true);
            }
        }elseif($act=='arzip'){
            $zip_path = 'file'.$dir.'/'; 
            zip_create($zip_path,$id);
        }else{
                $act = preg_replace('/\s+/', '_', $act);
                $path2 = 'file'.$dir.'/'.$act;
            if(file_exists($path)){
                if($path2!=$path){
                    echo json_encode(['errorMsg' => 'Sudah ada']);
                    exit();
                }
            }else{
                rename($path2, $path);
                // File::copyDirectory($path2, $path);
            }
        }
        echo json_encode(['success' => true]);
    }
    public function file_del(){
        only_admin();
        $id  = request()->input('id');
        $dir  = u2(request()->input('dir'));
        $e = explode(".",$id);
        $path = 'file'.$dir.'/'.$id;
        if($id=='index.html' || $id=='index.php'){
            echo json_encode(['errorMsg' => 'Error']);
            exit(); 
        }
        if(file_exists($path)){
            if(count($e)==1){
                File::deleteDirectory($path);
            }else{
                unlink($path);
            }
            echo json_encode(['success' => true]);
            exit();
        }else{
            echo json_encode(['errorMsg' => 'Gagal Dihapus']);
            exit();
        }
        
    }
    public function upload_zip()
    {
        only_admin(); 
        $id  = request()->input('id');
        $dir  = u2(request()->input('dir'));
                $path = 'file'.$dir.'/';  
        if($id=='zip'){
            if($_FILES['zip_file']['name'] != ''){  
                $file_name = $_FILES['zip_file']['name'];  
                $array = explode(".", $file_name);  
                $name = $array[0];  
                $ext = $array[1];  
                $location = $path . $file_name;  
                $stor = DIR_COM;  
                if($ext == 'zip')  
                {  
                    if(move_uploaded_file($_FILES['zip_file']['tmp_name'], $location))  
                    {  
                        if(zip_extr($location,$path)){
                            unlink($location);  
                            // rmdir($path . $name);  
                            echo json_encode(['success' => true]);
                            exit();
                        }
                    }  
                } else{
                echo json_encode(['errorMsg' => 'Extensi harus zip.']);
                exit();
                } 
            }
        }else{
            if($_FILES['file']['name'] != ''){ 
            $file_name = $_FILES['file']['name'];  
            $file_name = preg_replace('/\s+/', '-', $file_name);    
            if($file_name=='index.html' || $file_name=='index.php'){
                echo json_encode(['errorMsg' => 'File Ini Dilarang']);
                exit(); 
            }
            $array = explode(".", $file_name);  
            $name = $array[0];  
            $ext = $array[1];  
                $location = $path . $file_name;
                if(file_exists($location)){
                    $location = $path .$name.'_'.time().'.'.$ext;
                }  
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $location))  
                    {  
                        echo json_encode(['success' => true]);
                        exit();
                    }
            }
        }
    }
    public function fontawesome(){
        return view('develope/fontawesome');
    }
    public function engine(){
        only_admin();
        $data['side'] = db('sidebars')->get();
        $data['lvl'] = db('a_levels')->get();
        return view('develope/engine',$data);
    }
    public function input($id){
        only_admin();
        if($id=='a_super_admin' || $id=='a_dev'){
            abort(404);
        }
        $a = get_row('a_akses', ['id'=>$id]);
        $l = get_row('a_levels', ['id'=>$a->id_level]);
        $data['level'] = $l->id;
        $data['akses'] = $a->id;
        $data['root'] = $l->name.'.'.$a->sub;
        $scm = scm($a->id_level);
        return view('develope/input',$data);
    }
    public function crud_input($level)
    {
        only_admin();
        $scm = scm($level);
        $id  = request()->input('id');
        $col  = request()->input('col');
        if($col=='delete'){
            $o=get_row($scm,['id'=>$id]);
            sesin('name', $o->name);
            Schema::table($level, function (Blueprint $table) {
                $table->dropColumn(sesget('name'));
                sesdel('name');
            });
            delete($scm,['id'=>$id]);
            echo json_encode(['success' => true]);
            exit();
        }
        $sort  = request()->input('sort');
        $tag  = request()->input('tag');
        $class  = request()->input('class');
        $label  = request()->input('label');
        $type  = request()->input('type');
        $wajib  = request()->input('wajib');
        $code  = request()->input('code');
        $script  = request()->input('script');
        $init  = request()->input('init');
        $validasi  = request()->input('validasi');
        $at = date("Y-m-d H:i:s");
        $dt = [
            'col'=>$col,
            'sort'=>$sort,
            'tag'=>$tag,
            'class'=>$class,
            'label'=>$label,
            'type'=>$type,
            'wajib'=>$wajib,
            'code'=>$code,
            'script'=>$script,
            'init'=>$init,
        ];
        if($id=='insert'){
              $n=strtolower($label);
              $m=str_replace(' ','_',$n);
              $name=str_replace('-','_',$m);
              $dt['id']=time();
              $dt['created_at']=$at;
              $dt['name']=$name;
              if($wajib=='YA'){
                  $dt['validasi']=validasi($name);
              }else{
                $dt['validasi']='';
              }
              insert($scm,$dt);
              sesin('name', $name);
              Schema::table($level, function (Blueprint $table) {
                $table->text(sesget('name'))->nullable();
                sesdel('name');
              });
        }else{
            $o=get_row($scm,['id'=>$id]);
            if($wajib!=$o->wajib){
                if($wajib=='YA'){
                    $dt['validasi']=validasi($o->name);
                }else{
                    $dt['validasi']='';
                }
            }
            $dt['updated_at']=$at;
            update($scm,$dt,['id'=>$id]);
        }
        echo json_encode(['success' => true]);
    }
    public function get_input($level,$col)
    {
        only_admin();
        $scm = scm($level);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sort';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows($scm);
        $country = db($scm)
            ->where('col',$col)
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    public function set_side($id){
        only_admin();
        $a = get_row('a_akses', ['id'=>$id]);
        $l = get_row('a_levels', ['id'=>$a->id_level]);
        $data['side'] = db('sidebars')->get();
        $data['lvl'] = db('a_levels')->get();
        $data['level'] = $l->id;
        $data['akses'] = $a->id;
        $data['root'] = $l->name.'.'.$a->sub;
        return view('develope/sidebar_a',$data);
    }
    public function cr_sidebar($level)
    {
        only_admin();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'col1';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('sidebars',[$level=>'1']);
        $country = db('sidebars')
        ->where([$level=>'1'])
        ->orderBy($sort, $order)
        ->orderBy('col2', $order)
        ->orderBy('col3', $order)
        ->limit($rows)
        ->offset($offset)
        ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    public function get_engine()
    {
        only_admin();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('a_levels');
        $country = db('a_levels')
            ->join('a_akses', 'a_levels.id', '=', 'a_akses.id_level')
            ->where('name','LIKE','%'.$search.'%')
            ->orderBy('a_akses.id_level', $order)
            ->orderBy('a_akses.sort', $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    private function ida(){
        return 'a_'.time();
    }
    private function idl(){
        return 'users_'.time();
    }
    function crud_engine(){
        only_admin();
        $id  = request()->input('id');
        $act  = request()->input('act');
        $name  = request()->input('name');
        if($name==null){
            echo json_encode(['errorMsg' => 'Title harus di isi.']);
            exit();
        }
        if($act=='insert_level'){
            new_id();
            $idl='users_'.inc("new_id");
            $scm='schema_'.inc("new_id");
            $ida='a_'.inc("new_id");
            $data_level=[
                'id'=>$idl,
                'name'=>sto('_',hb($name)),
                'role'=>'0',
                'created_at'=>date("Y-m-d H:i:s"),
            ];
            $data_akses=[
                'id'=>$ida,
                'id_level'=>$idl,
                'sub'=>hb('Default'),
                'role'=>'primary',
                'sort'=>time(),
                'created_at'=>date("Y-m-d H:i:s"),
            ];
            $rs=num_rows('a_levels',['role'=>'0']);
            $data_side=[
                'id'=>time(),
                'group_1' => inc('side_us'),
                'group_2' => '0000000000',
                'colum' => '2',
                'role' => '1',
                'col1' => inc('side_col'),
                'col2' => ($rs+1),
                'col3' => '0',
                'nama' => sto('_',hb($name)),
                'url' => 'user_table/'.$idl,
                'icon' => 'fa fa-adjust',
                'ket' => '',
                'a_dev' => '1',
                'dev' => '1',
                'a_super_admin' => '1',
                'super_admin' => '1',
                'created_at'=>date("Y-m-d H:i:s"),
            ];
            insert('a_akses',$data_akses);
            insert('sidebars',$data_side);
           $res = insert('a_levels',$data_level);
           if($res){
                Schema::create($idl, function (Blueprint $table) {
                    $table->string('id');
                    $table->string('sort');
                    $table->timestamps();
                    $table->primary('id');
                });
                Schema::create($scm, function (Blueprint $table) {
                    $table->string('id');
                    $table->enum('col', ['1', '2']);
                    $table->string('sort');
                    $table->string('tag');
                    $table->string('class');
                    $table->string('label');
                    $table->string('type');
                    $table->string('name')->unique();
                    $table->enum('wajib', ['YA', 'TIDAK']);
                    $table->longText('code')->nullable();
                    $table->longText('script')->nullable();
                    $table->longText('init')->nullable();
                    $table->longText('validasi')->nullable();
                    $table->enum('role', ['0', '1']);
                    $table->timestamps();
                    $table->primary('id');
                });
                Schema::table('sidebars', function (Blueprint $table) {
                    $table->enum('users_'.inc("new_id"), ['0', '1']);
                    $table->enum('a_'.inc("new_id"), ['0', '1']);
                });
                Schema::table('manual_books', function (Blueprint $table) {
                    $table->enum('users_'.inc("new_id"), ['0', '1']);
                });
                scm_data($scm);
           }else{
            echo json_encode(['success' => true]);
            exit();
           }
        }elseif($act=='update_level'){
            $o = get_row('a_akses', ['id'=>$id]);
            $res = update('a_levels',['name'=>sto('_',hb($name))],['id'=>$o->id_level]);
            update('sidebars',['nama'=>sto('_',hb($name))],['url'=>'user_table/'.$o->id_level]);
            if(!$res){
                echo json_encode(['errorMsg' => 'Gagal di save.']);
                exit();
            }
        }elseif($act=='insert_akses'){
            new_id();
            $ida='a_'.inc("new_id");
            $o = get_row('a_akses', ['id'=>$id]);
            if($o->id_level=='dev' || $o->id_level=='super_admin'){
                echo json_encode(['errorMsg' => 'Error.']);
              exit();
            }
        $data_akses=[
            'id'=>$ida,
            'id_level'=>$o->id_level,
            'sub'=>sto('_',hb($name)),
            'role'=>'secondary',
            'sort'=>time(),
            'created_at'=>date("Y-m-d H:i:s"),
        ];
        $res = insert('a_akses',$data_akses);
        if($res){
            Schema::table('sidebars', function (Blueprint $table) {
                $table->enum('a_'.inc("new_id"), ['0', '1']);
            });
        }else{
            echo json_encode(['errorMsg' => 'Gagal di save.']);
            exit();
        }
        }elseif($act=='update_akses'){
            $res = update('a_akses',['sub'=>sto('_',hb($name))],['id'=>$id]);
            if(!$res){
                echo json_encode(['errorMsg' => 'Gagal di save.']);
                exit();
            }
        }elseif($act=='del_level'){
            $o = get_row('a_akses', ['id'=>$id]);
            if($o->id_level=='dev' || $o->id_level=='super_admin'){
                echo json_encode(['errorMsg' => 'Level ini tidak boleh di hapus.']);
                exit();
            }
            sesin('idl', $o->id_level);
            Schema::table('sidebars', function (Blueprint $table) {
                $idl = sesget('idl');
                $idll = db('a_akses')->where(['id_level'=>$idl])->get();
                foreach($idll as $o){
                    $table->dropColumn($o->id);
                }
                $table->dropColumn($idl);
            });
            Schema::table('manual_books', function (Blueprint $table) {
                $idl = sesget('idl');
                $table->dropColumn($idl);
            });
            Schema::dropIfExists($o->id_level);
            Schema::dropIfExists(scm($o->id_level));
            sesdel('idl');
            delete('sidebars',['url'=>'user_table/'.$o->id_level]);
            delete('users',['level'=>$o->id_level]);
            delete('a_akses',['id_level'=>$o->id_level]);
            $res = delete('a_levels',['id'=>$o->id_level]);
            if(!$res){
                echo json_encode(['errorMsg' => 'Error DataBase.']);
                exit();
            }
        }else{
            $o = get_row('a_akses', ['id'=>$id]);
            $x = get_row('a_akses', ['id_level'=>$o->id_level,'role'=>'primary']);
            if($id=='a_dev' || $id=='a_super_admin'){
                echo json_encode(['errorMsg' => 'Level ini tidak boleh di hapus.']);
                exit();
            }
            sesin('ida', $id);
            $res = delete('a_akses',['id'=>$id]);
            update('users',['akses'=>$x->id],['akses'=>$id]);
            if($res){
                Schema::table('sidebars', function (Blueprint $table) {
                    $table->dropColumn(sesget('ida'));
                    sesdel('ida');
                });
            }else{
                echo json_encode(['errorMsg' => 'Error DataBase.']);
                exit();
            }
        }
        echo json_encode(['success' => true]);
    }
    // ENGINE END
    // SIDEBAR START
    public function sidebar(){
        only_admin();
        $data['side'] = db('sidebars')->get();
        $data['lvl'] = db('a_levels')->get();
        return view('develope/sidebar',$data);
    }
    function sidebar_checked(){
        only_admin();
        $id  = request()->input('id');
        $col  = request()->input('col');
        $o = get_row('sidebars', ['id'=>$id]);
        $val = ($o->$col=='0')?'1':'0';
        update('sidebars',[$col=>$val], ['id'=>$id]);
        echo json_encode(['success' => true]);
    }
    public function get_sidebar()
    {
        only_admin();
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'col1';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('sidebars');
        $country = db('sidebars')
            ->where('nama','LIKE','%'.$search.'%')
            ->orWhere('url','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->orderBy('col2', $order)
            ->orderBy('col3', $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
        // return response()->json($result, 200);
    }
    function crud_sidebar(){
        only_admin();
        $id  = request()->input('id');
        $nama  = request()->input('nama');
        $role  = request()->input('role');
        $colum  = request()->input('colum');
        $col1  = request()->input('col1');
        $col2  = request()->input('col2');
        $col3  = request()->input('col3');
        $url  = request()->input('url');
        $icon  = request()->input('icon');
        $ket  = request()->input('ket');
        $gp1  = request()->input('gp1');
        $idx  = request()->input('idx');
        if($role=='del'){
            delete('sidebars',['id'=>$id]);
            delete('sidebars',['group_1' => $id]);
            delete('sidebars',['group_2' => $id]);
            echo json_encode(['success' => true]);
            exit();
        }
        $url = ($role == '1') ? $url: "#";
        if($id=='insert'){
            if ($colum == '1') {
                $ckgrup = num_rows('sidebars', ['col1'=>$col1]);
                if ($ckgrup > 0) {
                    echo json_encode(['errorMsg' => 'No. Sudah ada']);
                    exit();
                }
                if ($icon == null) {
                    $icon = 'far fa-circle';
                };
                $group_1 = '0000000000';
                $group_2 = '0000000000';
            }
            if ($colum == '2') {
                $ckgrup = num_rows('sidebars',  ['col1'=>$col1,'col2'=>$col2]);
                if ($ckgrup > 0) {
                    echo json_encode(['errorMsg' => 'No. Sudah ada']);
                    exit();
                }
                if ($icon == null) {
                    $icon = 'fa fa-adjust';
                };
                $group_1 = $idx;
                $group_2 = '0000000000';
            }
            if ($colum == '3') {
                $ckgrup = num_rows('sidebars', ['col1'=>$col1,'col2'=>$col2,'col3'=>$col3]);
                    if ($ckgrup > 0) {
                        echo json_encode(['errorMsg' => 'No. Sudah ada']);
                        exit();
                    }
                if ($icon == null) {
                    $icon = 'fa fa-circle';
                };
                $group_1 = $idx;
                $group_2 = $gp1;
            }
            $data = [
                'id'=>time(),
                'group_1' => $group_1,
                'group_2' => $group_2,
                'colum' => $colum,
                'role' => $role,
                'col1' => $col1,
                'col2' => $col2,
                'col3' => $col3,
                'nama' => strtoupper($nama),
                'url' => $url,
                'icon' => $icon,
                'ket' => $ket,
                'created_at'=>date("Y-m-d H:i:s"),
            ];
            insert('sidebars',$data);
            echo json_encode(['success' => true]);
        }else{
            $o = get_row('sidebars', ['id'=>$id]);
            if ($o->colum == '1') {
                if ($o->col1 != $col1) {
                    $ckgrup = num_rows('sidebars', ['col1'=>$col1]);
                    if ($ckgrup > 0) {
                        echo json_encode(['errorMsg' => 'No. Sudah ada']);
                        exit();
                    }
                    update('sidebars', ['col1' => $col1], ['group_1' => $id]);
                    update('sidebars', ['col1' => $col1], ['group_2' => $id]);
                }
            }
            if ($o->colum == '2') {
                if ($o->col2 != $col2) {
                    $ckgrup = num_rows('sidebars',  ['col1'=>$col1,'col2'=>$col2]);
                    if ($ckgrup > 0) {
                        echo json_encode(['errorMsg' => 'No. Sudah ada']);
                        exit();
                    }
                    update('sidebars', ['col2' => $col2], ['group_1' => $id]);
                }
            }
            if ($o->colum == '3') {
                if ($o->col2 != $col2) {
                    $ckgrup = num_rows('sidebars', ['col1'=>$col1,'col2'=>$col2,'col3'=>$col3]);
                    if ($ckgrup > 0) {
                        echo json_encode(['errorMsg' => 'No. Sudah ada']);
                        exit();
                    }
                }
            }
            $data = [
                'role' => $role,
                'col1' => $col1,
                'col2' => $col2,
                'col3' => $col3,
                'nama' => strtoupper($nama),
                'url' => $url,
                'icon' => $icon,
                'ket' => $ket,
                'updated_at'=>date("Y-m-d H:i:s"),
            ];
            if($id==inc('side_us')){
                update('incs',['code'=>$col1],['id'=>'side_col']);
            }
            update('sidebars',$data,['id'=>$id]);
            echo json_encode(['success' => true]);
        }
    }
    // SIDEBAR END
    // SUPER ADMIN START
    public function super_admin(){
        only_admin();
        $data['o'] = get_row('users',['id'=>'is_super_admin']);
        return view('develope/super_admin',$data);
    }
    public function super_admin_foto(){
        only_admin();
        $o = find_user('is_super_admin');
        if (isset($_POST["image"])) {
            $date = date('Ydmhis');
            $tempdir = 'img/avatar/';
            if ($o->foto != null) {
                $path = 'img/avatar/' . $o->foto;
                if($o->foto!='admin_w.png'){
                    (!file_exists($path)) ?: unlink($path);
                }
            }
            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageName = $tempdir . 'avatar_' . $date . '.png';
            $foto = 'avatar_' . $date . '.png';
            file_put_contents($imageName, $data);

            update('users', ['foto' => $foto], ['id' => 'is_super_admin']);
            echo '<img src="img/avatar/' . $foto . '" width="100%">';
        }
    }
    public function super_admin_post(){
        only_admin();
        $id  = request()->input('id');
        $val  = request()->input('val');
        if($val==null){
            echo json_encode(['errorMsg' => 'save gagal kolom harus di isi.']);
            exit();
        }
        $d = User::find('is_super_admin');
        if($id=='email'){
            if($d->email!=$val){
                $e_ada = email_ada($val);
                if($e_ada){
                    echo json_encode(['errorMsg' => 'Email Sudah Ada.']);
                    exit();
                }
            }
        }
        if($id=='hp'){
            if($d->hp!=$val){
                $e_ada = hp_ada($val);
                if($e_ada){
                    echo json_encode(['errorMsg' => 'No Hp Sudah Ada.']);
                    exit();
                }
            }
        }
        if($id=='password'){
            $val = bcrypt($val);
        }
        if($id=='pin'){
            $val = base64_encode($val);
        }
       $res = update('users',[$id=>$val],['id'=>'is_super_admin']);
       if($res){
        echo json_encode(['success' => true]);
       }else{
        echo json_encode(['errorMsg' => 'Gagal Di Save']);
       }
    }
    // SUPER ADMIN END

}
