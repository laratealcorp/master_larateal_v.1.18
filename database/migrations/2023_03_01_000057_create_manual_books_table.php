<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_books', function (Blueprint $table) {
            $table->string('id');
            $table->enum('role', ['EDITOR', 'PDF']);
            $table->string('judul');
            $table->longText('content')->nullable();
            $table->enum('status', ['true', 'false']);
            $table->timestamps();
            $table->enum('dev', ['0', '1']);
            $table->enum('super_admin', ['0', '1']);
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
        Schema::dropIfExists('manual_books');
    }
}
