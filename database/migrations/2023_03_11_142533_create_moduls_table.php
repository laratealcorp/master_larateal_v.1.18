<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->string('id');
            $table->string('sort');
            $table->enum('status', ['false', 'true']);
            $table->enum('class', ['fc', 'web', 'msg', 'api']);
            $table->string('name');
            $table->enum('model', ['false', 'true']);
            $table->enum('view', ['false', 'true']);
            $table->enum('control', ['false', 'true']);
            $table->enum('tb', ['false', 'true']);
            $table->enum('sidebar', ['false', 'true']);
            $table->enum('dir', ['false', 'true']);
            $table->text('url')->nullable();
            $table->longText('desk')->nullable();
            $table->longText('license')->nullable();
            $table->string('autor')->nullable();
            $table->string('mit')->nullable();
            $table->string('sub')->nullable();
            $table->string('version')->nullable();
            $table->string('date')->nullable();
            $table->longText('base64')->nullable();
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
        Schema::dropIfExists('moduls');
    }
}
