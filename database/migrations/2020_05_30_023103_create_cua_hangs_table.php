<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuaHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cua_hang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tencuahang');
            $table->string('lat');
            $table->string('lng');
            $table->string('duong');
            $table->string('phuong');
            $table->string('quan');
            $table->string('thanhpho');
            $table->string('sdt')->nullable();
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
        Schema::dropIfExists('cua_hang');
    }
}
