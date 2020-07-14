<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichDatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichdat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nhanvien_id');
            $table->integer('khachhang_id');
            $table->float('gia');
            $table->datetime('thoigian');
            $table->string('diadiem');
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
        Schema::dropIfExists('lichdat');
    }
}
