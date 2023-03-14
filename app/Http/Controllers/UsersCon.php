<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersCon extends Controller
{
    public function mbook()
    {
        if(inc('mbook_status',1)=='true'){
            $data['o']='';
            return view('users/mbook',$data);
        }else{
            abort(404);
        }
    }
    public function get_mbook()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('manual_books',[me('level')=>'1']);
        $country = db('manual_books')
            ->where([me('level')=>'1'])
            ->where('judul','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    public function profil($id){
        $data['o'] = get_row('users',['id'=>$id]);
        $o = get_row('users',['id'=>$id]);
        $data['x'] = get_row($o->level,['id'=>$o->id]);
        $data['ss'] = db(scm($o->level))->where(['role'=>'0'])->get();
        return view('users/profil',$data);
    }
    public function cetak_profil($id){
        $data['o'] = get_row('users',['id'=>$id]);
        $o = get_row('users',['id'=>$id]);
        $data['x'] = get_row($o->level,['id'=>$o->id]);
        $data['ss'] = db(scm($o->level))->where(['role'=>'0'])->get();
        return view('users/cetak_profil',$data);
    }
    public function me_profil(){
        is_maintenance();
        $data['o'] = get_row('users',['id'=>me('id')]);
        $o = get_row('users',['id'=>me('id')]);
        $data['x'] = get_row($o->level,['id'=>$o->id]);
        $data['ss'] = db(scm($o->level))->where(['role'=>'0'])->get();
        return view('users/me_profil',$data);
    }
    public function profil_post(){
        $o = get_row('users',['id'=>me('id')]);
        $root  = request()->input('root');
        $id  = request()->input('id');
        $val  = request()->input('val');
        if($val==null){
            echo json_encode(['errorMsg' => 'save gagal kolom harus di isi.']);
            exit();
        }
        if($root=='1'){
            $res = update('users',[$id=>$val],['id'=>$o->id]);
        }else{
            $res = update($o->level,[$id=>$val],['id'=>$o->id]);
        }
       if($res){
        echo json_encode(['success' => true]);
       }else{
        echo json_encode(['errorMsg' => 'Gagal Di Save']);
       }
    }
    public function profil_foto(){
        $o = get_row('users',['id'=>me('id')]);
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

            update('users', ['foto' => $foto], ['id'=>$o->id]);
            echo '<img src="/img/avatar/' . $foto . '" width="100%">';
        }
    }
    public function table($level)
    {
        page_autenticate('user_table/'.$level);
        $scm = scm($level);
        $data['l'] = get_row('a_levels',['id'=>$level]);
        $data['scm'] = db($scm)->orderBy('sort','ASC')->get();
        $data['scm1'] = db($scm)->orderBy('sort','ASC')->where('col','1')->get();
        $data['scm2'] = db($scm)->orderBy('sort','ASC')->where('col','2')->get();
        $data['aa'] = db('a_levels')
        ->join('a_akses','a_akses.id_level','=','a_levels.id')
        ->where(['id_level'=>$level])
        ->get();
        // dd($data['aa']);
        return view('users/table',$data);
    }
    public function reset(){
        $id  = request()->input('id');
        $level  = request()->input('level');
        page_autenticate('user_table/'.$level);
        $password = bcrypt(inc('pass_default'));
        update('users',['password'=>$password],['id'=>$id]);
        echo json_encode(['success' => true]);
    }
    public function rpin(){
        $id  = request()->input('id');
        $level  = request()->input('level');
        page_autenticate('user_table/'.$level);
        update('users',['pin'=>base64_encode('0000'),'kunci'=>'false'],['id'=>$id]);
        echo json_encode(array('success' => true));
        exit;
    }
    public function ban(){
        $id  = request()->input('id');
        $level  = request()->input('level');
        page_autenticate('user_table/'.$level);
        $o = get_row('users',['id' => $id]);
        $status = ($o->status=='true')?'false':'true';
        update('users',['status'=>$status],['id'=>$id]);
        echo json_encode(['success' => true]);
    }
    public function crud(){
        $id  = request()->input('id');
        $level  = request()->input('level');
        $akses  = request()->input('akses');
        $sort = time();
        page_autenticate('user_table/'.$level);
        $nama  = request()->input('nama');
        $email  = request()->input('email');
        $hp  = request()->input('hp');
        $jk  = request()->input('jk');
        $scm = db(scm($level))->where('role','0')->get();
        foreach ($scm as $s) {
            sesin($s->name,request()->input($s->name));
        }
        if($id=='insert'){
            $e_ada = email_ada($email);
            if($e_ada){
                echo json_encode(['errorMsg' => 'Email Sudah Terdaftar.']);
                exit();
            }
            $hm = hp_ada($hp);
            if($hm){
                echo json_encode(['errorMsg' => 'No Hp Sudah Terdaftar.']);
                exit();
            }
           $id = idmd5();
           $password = bcrypt(inc('pass_default'));
           $data_u=[
                'id'=>$id,
                'level'=>$level,
                'akses'=>$akses,
                'sort'=>$sort,
                'password'=>$password,
                'pin'=>base64_encode('0000'),
                'nama'=>$nama,
                'email'=>$email,
                'hp'=>$hp,
                'jk'=>$jk,
                'created_at'=>date("Y-m-d H:i:s"),
           ];
           $data_l=[
                'id'=>$id,
                'sort'=>$sort,
                'created_at'=>date("Y-m-d H:i:s"),
           ];
           foreach ($scm as $s) {
            $data_l[$s->name] = sesget($s->name);
            sesdel($s->name);
           }
           insert($level,$data_l);
           insert('users',$data_u);
           echo json_encode(['success' => true]);
        }else{
            $o = get_row('users',['id' => $id]);
            if($o->email!=$email){
                $e_ada = email_ada($email);
                if($e_ada){
                    echo json_encode(['errorMsg' => 'Email Sudah Terdaftar.']);
                    exit();
                }
            }
            if($o->hp!=$hp){
                $hm = hp_ada($hp);
                if($hm){
                    echo json_encode(['errorMsg' => 'No Hp Sudah Terdaftar.']);
                    exit();
                }
            }
            $data_u=[
                'akses'=>$akses,
                'nama'=>$nama,
                'email'=>$email,
                'hp'=>$hp,
                'jk'=>$jk,
                'updated_at'=>date("Y-m-d H:i:s"),
           ];
           $data_l=[
                'updated_at'=>date("Y-m-d H:i:s"),
           ];
           foreach ($scm as $s) {
            $data_l[$s->name] = sesget($s->name);
            sesdel($s->name);
           }
           update($level,$data_l,['id' => $id]);
           update('users',$data_u,['id' => $id]);
           echo json_encode(['success' => true]);
        }
    }
    public function delete(){
        $id  = request()->input('id');
        $level  = request()->input('level');
        page_autenticate('user_table/'.$level);
        $o = get_row('users',['id' => $id]);
        if ($o->foto != null) {
            $path = 'img/avatar/' . $o->foto;
            (!file_exists($path)) ?: unlink($path);
        }
        delete('users',['id'=>$id]);
        delete($level,['id'=>$id]);
        echo json_encode(['success' => true]);
    }
    public function get($level)
    {
        page_autenticate('user_table/'.$level);
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users.sort';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $search = isset($_POST['search']) ? strval($_POST['search']) : '';
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = num_rows('users',['level'=>$level]);
        $country = db('users')
        ->join('a_levels', 'users.level', '=', 'a_levels.id')
            ->join('a_akses', 'users.akses', '=', 'a_akses.id')
            ->join($level, 'users.id', '=', $level.'.id')
            ->where('nama','LIKE','%'.$search.'%')
            ->orWhere('email','LIKE','%'.$search.'%')
            ->orWhere('hp','LIKE','%'.$search.'%')
            ->orWhere('sub','LIKE','%'.$search.'%')
            ->orderBy($sort, $order)
            ->limit($rows)
            ->offset($offset)
            ->get();
        $result = array_merge($result, ['rows' => $country]);
        echo json_encode($result);
    }
    public function crop_img()
    {
        $id  = request()->input('id');
        $level  = request()->input('level');
        page_autenticate('user_table/'.$level);
        if (isset($_POST["image"])) {
            $date = date('Ydmhis');
            $tempdir = 'img/avatar/';
            $o = get_row('users',['id' => $id]);
            if ($o->foto != null) {
                $path = 'img/avatar/' . $o->foto;
                (!file_exists($path)) ?: unlink($path);
            }
            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageName = $tempdir . 'avatar_' . $date . '.png';
            $foto = 'avatar_' . $date . '.png';
            file_put_contents($imageName, $data);

            update('users', ['foto' => $foto], ['id' => $id]);
            echo '<img src="/img/avatar/' . $foto . '" width="100%">';
        }
    }
}
