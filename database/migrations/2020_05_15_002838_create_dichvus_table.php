<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDichvusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dichvu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tendichvu');
            $table->integer('id_loaidichvu')->references('id')->on('loaidichvu');
            $table->float('gia');
            $table->text('mota');
            $table->string('anhdaidien');
            $table->integer('luotyeuthich');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dichvu');
    }
}
