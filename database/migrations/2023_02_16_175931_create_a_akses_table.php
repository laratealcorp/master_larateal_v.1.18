<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_akses', function (Blueprint $table) {
            $table->string('id', 100);
            $table->string('id_level', 100);
            $table->string('sort', 100);
            $table->enum('role', ['primary', 'secondary']);
            $table->string('sub',20);
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
        Schema::dropIfExists('a_akses');
    }
}
