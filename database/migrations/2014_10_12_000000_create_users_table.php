<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id');
            $table->string('sort');
            $table->string('level');
            $table->string('akses');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('hp')->unique();
            $table->enum('jk', ['L', 'P']);
            $table->string('password');
            $table->string('pin')->nullable();
            $table->string('old_password')->nullable();
            $table->string('old_password_date')->nullable();
            $table->longText('foto')->nullable();
            $table->enum('status', ['true', 'false']);
            $table->enum('kunci', ['false', 'true']);
            $table->string('last_login')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
