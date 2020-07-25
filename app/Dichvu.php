<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dichvu extends Model
{
    //
    protected $table = "dichvu";

    public function loaidichvu(){
    	return $this->belongsTo('App\Loaidichvu', 'id_loaidichvu', 'id');
    }
}
