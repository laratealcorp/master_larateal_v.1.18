<p align="center">
    <img src="https://user-images.githubusercontent.com/127891037/225124851-a0b010d3-ff8f-4b30-a1ed-c3ba1dddfdca.png" width="100"><br>
    LaraTeal V.1.18
</p>

![ice_screenshot_20230315-055108](https://user-images.githubusercontent.com/127891037/225153749-e006549b-e3ab-417c-b6ad-af664754b6ac.png)

- [Detail UI](https://github.com/laratealcorp/detail_master) 
- [Dokumentasi](https://github.com/laratealcorp/doc) 
- login awal untuk akun Develop ,Username : cpanel ,password : cpanel ,PIN : 1180
- Hanya akun develope yang automatis meminta PIN setiap login
- login awal untuk akun super admin ,Username : root ,password : root ,PIN : 0000

## Tentang LaraTeal V.1.18

Larateal merupakan system operasi berbasis web yg di buat dengan firmwork : [Laravel](https://laravel.com/) Yang dirancang se dinamis mungkin untuk memudahkan membuat aplikasi berbasis web tanpa skill coding, 

### Fitur Antara lain

- Upload Modul Sesuai keinginan.
- Install and uninstall Modul Yang di upload.
- lock screen dengan pin
- Ganti logo 
- Ganti nama aplikasi dan biodata yg lain
- system user dinamis yang meliputi Hak akses masing-masing level pengguna / user DLL
- edit dan tambah Manualbook untuk pengguna / user sesuai level
- maintenance untuk pengguna / user
- Ubah UI Login 
- Ubah Warna dan UI dashboard / template admin
- Tambah Sidebar costume
- Upload dan download Public File sejenis Drive tapi bersifat public
- DLL.

### NB :

Untuk Versi Local Diatas adalah versi gratis yang hanya bisa di akses pada Url :

Local : http://localhost:8000 or http://127.0.0.1:8000

Valet : http://LaraTeal_V.1.18.test

### List Modul
Modul dibagi atas empat class Yaitu :

- Modul Website [Go Modul](https://github.com/laratealcorp/modul_web)
- Modul Function [Go Modul](https://github.com/laratealcorp/modul_function)
- Modul Message [Go Modul](https://github.com/laratealcorp/modul_msg)
- Modul API [Go Modul](https://github.com/laratealcorp/modul_api)

### Cara Pakai Untuk Local

- Download File dan Extract
- Buat database mysql 
- cari file .env lalu edit
- isi kan informasi database yg dibuat sebelumnya pada kolom database pada .env
- Buka Cmd Dan arahkan ke Folder Master larateal_v.1.18 yang telah di download
- Lalu ketikkan Perintah :
```
php artisan migrate:fresh --seed
```
untuk Mingisi database bawaan Larateal

- lalu jalankan aplikasi dengan perintah :
```
php artisan serve
```
- Buka Browser lalu ketikkan 
- http://localhost:8000/
- login awal untuk akun Develop ,Username : cpanel ,password : cpanel ,PIN : 1180
- login awal untuk akun super admin ,Username : root ,password : root ,PIN : 0000
- Proses selesai
- Untuk Modul silahkan memilih modul sesuai keinginan pada list modul di atas
- Untuk cara pakai via valet silahkan lihat dokumentasi [Disini](https://laravel.com/docs/10.x/valet)


### Untuk Request Modul Costume dan Versi Online silahkan Hubungi (chat only) : [Whatsapp](https://wa.me/083136245050)
