<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    //
    protected $table = "khachhang";
    public function lichdat(){
    	return $this->hasMany('App\LichDat', 'khachhang_id', 'id');
    }
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
