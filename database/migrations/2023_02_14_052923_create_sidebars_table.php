<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->string('id', 100);
            $table->string('m')->nullable();
            $table->string('group_1', 100)->nullable();
            $table->string('group_2', 100)->nullable();
            $table->enum('colum', ['1', '2', '3']);
            $table->enum('role', ['0', '1']);
            $table->integer('col1');
            $table->integer('col2');
            $table->integer('col3');
            $table->string('nama',50);
            $table->Text('url');
            $table->Text('icon');
            $table->Text('ket')->nullable();
            $table->enum('status', ['true', 'false']);
            $table->enum('a_dev', ['0', '1']);
            $table->enum('dev', ['1', '0']);
            $table->enum('a_super_admin', ['0', '1']);
            $table->enum('super_admin', ['0', '1']);
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
        Schema::dropIfExists('sidebars');
    }
}
