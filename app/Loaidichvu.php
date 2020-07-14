<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaidichvu extends Model
{
    //
    protected $table = "loaidichvu";
    public function dichvu(){
    	return $this->hasMany('App\dichvu', 'id_loaidichvu', 'id');
    }
}
