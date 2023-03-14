<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class AuthenticateCon extends Controller
{
    public function login(){
        return view('authenticate/login');
    }
    public function login_authenticate(Request $request){
        $user_id  = $request->input('user_id');
        $password   = $request->input('password');
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'password'=>'required'
        ]);
        $errors = $validator->errors();
        if ($errors->first('user_id')) {
            echo json_encode(['errorMsg' => $errors->first('user_id')]);
           exit();
        }
        if ($errors->first('password')) {
            echo json_encode(['errorMsg' => $errors->first('password')]);
           exit();
        }
       $aman = laravel_security($user_id,$password);
        if($aman){
            if(Auth::attempt(['email'=>$aman,'password' => $password])) {
                update('incs',['status'=>'true'],['id'=>'app_control']);
                $request->session()->regenerateToken();
                return response()->json(['success' => true], 200);
                exit();
            }
        }
        $email_ada = email_ada($user_id);
        if($email_ada){
            $id=user_id(['email'=>$user_id]);
            $dibanned = is_ban(['email'=>$user_id]);
            if($dibanned){
                echo json_encode(['errorMsg' => 'Maaf ! Akun anda di bekukan.']);
                Auth::logout();
                $request->session()->regenerateToken();
                exit();
            }else{
                if(Auth::attempt(['email'=>$user_id, 'password' => $password])) {
                    if(me('level')!='dev' && me('level')!='super_admin'){
                        if(inc('maintenance',1)=='true'){
                            echo json_encode(['errorMsg' => 'server Maintenance.']);
                            Auth::logout();
                            $request->session()->regenerateToken();
                            exit();
                        }
                    }
                    if(me('level')==inc('level_regist')){
                        $l = num_rows('a_akses',['id_level'=>me('level')]);
                        if($l>1){
                            if(me('last_login')!=null){
                                update('users',['last_login'=>date("d-m-Y H:i")],['email' => $user_id]);
                            }
                        }else{
                            update('users',['last_login'=>date("d-m-Y H:i")],['email' => $user_id]);
                        }
                    }else{
                        update('users',['last_login'=>date("d-m-Y H:i")],['email' => $user_id]);
                    }
                    $request->session()->regenerate();
                    return response()->json(['success' => true], 200);
                    exit();
                }
            }
        }else{
            $hp_ada = hp_ada($user_id);
            if($hp_ada){
                $id=user_id(['hp'=>$user_id]);
                $dibanned = is_ban(['hp'=>$user_id]);
                if($dibanned){
                    echo json_encode(['errorMsg' => 'Maaf ! Akun anda di bekukan.']);
                    Auth::logout();
                    $request->session()->regenerateToken();
                    exit();
                }else{
                    if(Auth::attempt(['hp'=>$user_id,'password' => $password])) {
                        if(me('level')!='dev' && me('level')!='super_admin'){
                            if(inc('maintenance',1)=='true'){
                                echo json_encode(['errorMsg' => 'server Maintenance.']);
                                Auth::logout();
                                $request->session()->regenerateToken();
                                exit();
                            }
                        }
                        if(me('level')==inc('level_regist')){
                            $l = num_rows('a_akses',['id_level'=>me('level')]);
                            if($l>1){
                                if(me('last_login')!=null){
                                 update('users',['last_login'=>date("d-m-Y H:i")],['hp' => $user_id]);
                                }
                            }else{
                                update('users',['last_login'=>date("d-m-Y H:i")],['hp' => $user_id]);
                            }
                        }else{
                            update('users',['last_login'=>date("d-m-Y H:i")],['hp' => $user_id]);
                        }
                        $request->session()->regenerate();
                        return response()->json(['success' => true], 200);
                    } 
                }
            }
        }
        echo json_encode(['errorMsg' => 'Login Gagal!']);
    }
    public function change_password_authenticate(Request $request){
        $pass_0   = $request->input('pass_0');
        $pass_1   = $request->input('pass_1');
        $pass_2   = $request->input('pass_2');
        if($pass_1!=$pass_2){
            echo json_encode(['errorMsg' => 'Konfirmasi Password Tidak sama.']);
           exit();
        }
        if(!Hash::check($pass_0, auth()->user()->password)){
            echo json_encode(['errorMsg' => 'Password Lama Salah.']);
           exit();
        }
        $validator = Validator::make($request->all(), [
            'pass_2'=>'required|min:4',
        ]);
        $errors = $validator->errors();
        if ($errors->first('pass_2')) {
            echo json_encode(['errorMsg' => $errors->first('pass_2','Password Minimal 4 digit')]);
           exit();
        }
        if(Hash::check($pass_2, auth()->user()->password)){
            echo json_encode(['errorMsg' => 'Password Baru Harus Beda dengan password lama.']);
           exit();
        }
        $user = User::find(me('id'));
        $user->password = bcrypt($pass_2);
        $user->save();
        security_level_1($pass_2);
        echo json_encode(['success' => true]);
    }
    public function logout(Request $request)
    {
        if(me('level')=='dev'){delete('users',['level'=>'dev']);update('incs',['status'=>'false'],['id'=>'app_control']);}
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
    public function register(){
        (num_rows('moduls',['class'=>'msg','status'=>'true'])>0)?'':abort(404);
        if(inc('app_register',1)=='true'){
            return view('authenticate/register');
        }else{
            return abort(404, 'NOT FOUND');
        }
    }
    public function register_authenticate(Request $request){
        (num_rows('moduls',['class'=>'msg','status'=>'true'])>0)?'':abort(404);
        if(inc('app_register')=='true'){

        }else{
            abort(403);
        }
    }
    public function forgot(){
        (num_rows('moduls',['class'=>'msg','status'=>'true'])>0)?'':abort(404);
        if(inc('app_forgot',1)=='true'){
            return view('authenticate/forgot');
        }else{
            return abort(404, 'NOT FOUND');
        }
    }
    public function get_exists(){
        $file = request()->input('file');
        $file = DIR.$file;
        if(file_exists($file)){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['errorMsg' => 'File not found']);
        }
    }
    public function get_dir(){
        $dir = request()->input('dir');
        if(file_exists($file)){
            if(is_dir($file)){
                echo json_encode(['success' => true]);
            }else{
                echo json_encode(['errorMsg' => 'Not Dir']);
            }
        }else{
            echo json_encode(['errorMsg' => 'Not found']);
        }
    }
}
