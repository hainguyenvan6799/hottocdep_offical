<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lichlamviec_nhanvien extends Model
{
    //
    protected $table = 'lichlamviec_nhanvien';

    public function nhanvien(){
    	return $this->belongsTo('App\NhanVien', 'nhanvien_id', 'id');
    }
    public function cuahang(){
    	return $this->belongsTo('App\CuaHang', 'cuahang_id', 'id');
    }
}
