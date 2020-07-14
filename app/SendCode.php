<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendCode extends Model
{
    //
    public static function sendcode($sdt){
    	$code = rand(1111,9999);
    	$nexmo = app('Nexmo\Client');
    	$nexmo->message()->send(
    		[
    			'to'=>'+84'.(int)$sdt,
    			'from'=>'Hai Nguyen Van',
    			'text'=>'Verify Code:'.$code
    		]
    	);
    	return $code;
    }
}
