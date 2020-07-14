<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanvienlichlamviecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichlamviec_nhanvien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nhanvien_id');
            $table->datetime('ngay');
            $table->text('start_time');
            $table->text('stop_time');
            $table->integer('cuahang_id');
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
        Schema::dropIfExists('nhanvienlichlamviec');
    }
}
