<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inc;
use App\Models\Color;
use App\Models\User;
use App\Models\A_level;
use App\Models\A_akses;
use App\Models\Sidebar;
use App\Models\Frame_ui;
use App\Models\Moduls;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $app_desk = '<div style="margin: 0px; padding: 0px;"><pre style="margin: 0px; padding: 0px;">Menuju Website Dengan cara<br>Scan QRcode Pada Kolom Qrcode<br>Atau Menuju Link Dengan Cara</pre><pre style="margin: 0px; padding: 0px;">Klick Qrcode</pre></div>';
        $play_desk = '<pre>Download App Android Dengan cara<br>Scan QRcode Pada Kolom Qrcode<br>Atau Menuju Link Dengan Cara <br>Klick Qrcode</pre>';
        // INC SEED START
        Inc::create(['id'=>'tema','code'=>'dark','status'=>'true']);
        Inc::create(['id'=>'login_wave','code'=>'','status'=>'true']);
        Inc::create(['id'=>'login_desk','code'=>'<p><br></p>','status'=>'true']);
        Inc::create(['id'=>'app_start','code'=>date("Y").','.time(),'status'=>'true']);
        Inc::create(['id'=>'app_register','code'=>'','status'=>'false']);
        Inc::create(['id'=>'app_control','code'=>'','status'=>'false']);
        Inc::create(['id'=>'app_forgot','code'=>'','status'=>'false']);
        Inc::create(['id'=>'app_name','code'=>'LaraTeal V.1.18','status'=>'true']);
        Inc::create(['id'=>'app_logo','code'=>'','status'=>'true']);
        Inc::create(['id'=>'app_logo_n','code'=>'','status'=>'true']);
        Inc::create(['id'=>'app_desk','code'=>$app_desk,'status'=>'true']);
        Inc::create(['id'=>'app_instansi','code'=>'LaraTeal Corp','status'=>'true']);
        Inc::create(['id'=>'app_title','code'=>'--','status'=>'true']);
        Inc::create(['id'=>'app_key','code'=>enkey('cpanel'),'status'=>'true']);
        Inc::create(['id'=>'app_token','code'=>enkey('1180'),'status'=>'true']);
        Inc::create(['id'=>'show_analog','code'=>'','status'=>'true']);
        Inc::create(['id'=>'show_digital','code'=>'','status'=>'true']);
        Inc::create(['id'=>'web_status','code'=>'','status'=>'false']);
        Inc::create(['id'=>'play_status','code'=>'','status'=>'false']);
        Inc::create(['id'=>'play_desk','code'=>$play_desk,'status'=>'true']);
        Inc::create(['id'=>'play_url','code'=>'https://play.google.com/store/apps','status'=>'true']);
        Inc::create(['id'=>'url_whatsapp','code'=>'https://wa.me/','status'=>'true']);
        Inc::create(['id'=>'url_facebook','code'=>'','status'=>'true']);
        Inc::create(['id'=>'url_instagram','code'=>'','status'=>'true']);
        Inc::create(['id'=>'url_chanel_youtube','code'=>'','status'=>'true']);
        Inc::create(['id'=>'url_video_youtube','code'=>'','status'=>'true']);
        Inc::create(['id'=>'url_tiktok','code'=>'','status'=>'true']);
        Inc::create(['id'=>'url_google_map','code'=>'','status'=>'true']);
        Inc::create(['id'=>'maintenance','code'=>'','status'=>'false']);
        Inc::create(['id'=>'alamat','code'=>'Jl.Bitoa Lama No.25','status'=>'true']);
        Inc::create(['id'=>'email','code'=>'admin@app.com','status'=>'true']);
        Inc::create(['id'=>'hp','code'=>'0852-0000-0000','status'=>'true']);
        Inc::create(['id'=>'telp','code'=>'(0411)-28071986','status'=>'true']);
        Inc::create(['id'=>'pass_default','code'=>'@123','status'=>'true']);
        Inc::create(['id'=>'level_regist','code'=>'null','status'=>'true']);
        Inc::create(['id'=>'frame_ui','code'=>'black','status'=>'true']);
        Inc::create(['id'=>'slogan','code'=>'--','status'=>'true']);
        Inc::create(['id'=>'new_id','code'=>'','status'=>'true']);
        Inc::create(['id'=>'mbook_status','code'=>'','status'=>'true']);
        // INC SEED END
        // COLOR SEED START
        Color::create(['id'=>'qr_dot','code'=>'#064745','status'=>'true','ket'=>'warna titik Qrcode yg di generate dalam aplikasi']);
        Color::create(['id'=>'pri_a','code'=>'#898b8b','status'=>'true','ket'=>'warna part1 pada background']);
        Color::create(['id'=>'pri_b','code'=>'#ffffff','status'=>'true','ket'=>'warna part1 pada Text']);
        Color::create(['id'=>'pri_c','code'=>'#064745','status'=>'true','ket'=>'warna part1 pada hover']);
        Color::create(['id'=>'sec_a','code'=>'#000000','status'=>'true','ket'=>'warna part2 pada background']);
        Color::create(['id'=>'sec_b','code'=>'#ffffff','status'=>'true','ket'=>'warna part2 pada Text']);
        Color::create(['id'=>'sec_c','code'=>'#999000','status'=>'true','ket'=>'warna part2 pada hover']);
        Color::create(['id'=>'wid_a','code'=>'#ffffff','status'=>'true','ket'=>'warna Tombol Widget pada background']);
        Color::create(['id'=>'wid_b','code'=>'#000000','status'=>'true','ket'=>'warna Tombol Widget pada Text']);
        Color::create(['id'=>'wid_c','code'=>'#999000','status'=>'true','ket'=>'warna Tombol Widget pada hover']);
        // COLOR SEED END
        // FRAME UI START
        Frame_ui::create(['id'=>'default','status'=>'true']);
        Frame_ui::create(['id'=>'ui-sunny','status'=>'true']);
        Frame_ui::create(['id'=>'ui-pepper-grinder','status'=>'true']);
        Frame_ui::create(['id'=>'ui-dark-hive','status'=>'true']);
        Frame_ui::create(['id'=>'ui-cupertino','status'=>'true']);
        Frame_ui::create(['id'=>'metro-red','status'=>'true']);
        Frame_ui::create(['id'=>'metro-orange','status'=>'true']);
        Frame_ui::create(['id'=>'metro-green','status'=>'true']);
        Frame_ui::create(['id'=>'metro-gray','status'=>'true']);
        Frame_ui::create(['id'=>'metro-blue','status'=>'true']);
        Frame_ui::create(['id'=>'black','status'=>'true']);
        Frame_ui::create(['id'=>'bootstrap','status'=>'true']);
        Frame_ui::create(['id'=>'gray','status'=>'true']);
        Frame_ui::create(['id'=>'light-blue','status'=>'true']);
        Frame_ui::create(['id'=>'material','status'=>'true']);
        Frame_ui::create(['id'=>'metro','status'=>'true']);
        Frame_ui::create(['id'=>'material-blue','status'=>'true']);
        Frame_ui::create(['id'=>'material-teal','status'=>'true']);
        // FRAME UI END
        // LEVEL SEED START
        A_level::create(['id'=>'super_admin','name'=>'ADMIN_PUSAT','role'=>'1']);
        A_level::create(['id'=>'dev','name'=>'DEVELOP','role'=>'1']);
        A_akses::create(['id'=>'a_super_admin','sort'=>'0','id_level'=>'super_admin','sub'=>'DEFAULT']);
        A_akses::create(['id'=>'a_dev','sort'=>'1','id_level'=>'dev','sub'=>'DEFAULT']);
        // LEVEL SEED END
        // USER SEED START
        User::create([
            'id'=>'is_super_admin',
            'sort'=>'1000',
            'level'=>'super_admin',
            'akses'=>'a_super_admin',
            'nama'=>'ADMIN PUSAT',
            'email'=>'root',
            'hp'=>'root',
            'password'=>bcrypt('root'),
            'pin'=>base64_encode('0000'),
            'jk'=>'P',
            'foto'=>'admin_w.png',
            'status'=>'true'
        ]);
        // USER SEED END
        // SIDEBAR SEED START
        $id = time();
        Inc::create(['id'=>'side_us','code'=>$id,'status'=>'true']);
        Inc::create(['id'=>'side_col','code'=>'99','status'=>'true']);
        Sidebar::create([
            'id'=>$id,
            'group_1' => '0000000000',
            'group_2' => '0000000000',
            'colum' => '1',
            'role' => '0',
            'col1' => '99',
            'col2' => '0',
            'col3' => '0',
            'nama' => strtoupper('User'),
            'url' => '#',
            'icon' => 'far fa-user',
            'ket' => '',
            'a_dev' => '1',
            'dev' => '1',
            'a_super_admin' => '1',
            'super_admin' => '1',
            'created_at'=>date("Y-m-d H:i:s"),
        ]);
        // SIDEBAR SEED END
    }
}
