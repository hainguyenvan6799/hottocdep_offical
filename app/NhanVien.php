<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    //
    protected $table = "nhanvien";
    public function lichdat(){
    	return $this->hasMany('App\LichDat', 'nhanvien_id', 'id');
    }
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function cuahang(){
    	return $this->belongsTo('App\CuaHang', 'cuahang_id', 'id');
    }
}
