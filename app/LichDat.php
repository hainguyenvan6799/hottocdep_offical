<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichDat extends Model
{
    //
    protected $table = "lichdat";

    public function khachhang(){
    	return $this->belongsTo('App\NhanVien', 'nhanvien_id', 'id');
    }

    public function nhanvien(){
    	return $this->belongsTo('App\NhanVien', 'nhanvien_id', 'id');
    }
    public function dichvu(){
    	return $this->belongsTo('App\Dichvu', 'dichvu_id', 'id');
    }
    public function cuahang(){
    	return $this->belongsTo('App\CuaHang', 'id_cuahang', 'id');
    }
}

