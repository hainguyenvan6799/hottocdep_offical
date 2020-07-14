<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    //
    protected $table = "sanpham";

    public function loaisanpham(){
    	return $this->belongsTo('App\Loaisanpham','loaisanpham_id', 'id');
    }
}
