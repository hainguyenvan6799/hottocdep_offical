<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;

class RatingController extends Controller
{
    //
    public function postRating(Request $request){
    	if(!Auth::check())
    	{
    		return redirect('/login');
    	}	
    	else
    	{
    		$id_user = Auth::user()->id;
    		$diem_dichvu = $request->diem_dichvu;
    		$diem_thaido = $request->diem_thaido;
    		$diem_csvatchat = $request->diem_csvatchat;
    		$diem_wifi = $request->diem_wifi;
    		$rating = new Rating;
    		$rating->id_user = $id_user;
    		$rating->diem_dichvu = $diem_dichvu;
    		$rating->diem_thaido = $diem_thaido;
    		$rating->diem_csvatchat = $diem_csvatchat;
    		$rating->wifi = $diem_wifi;
    		$rating->save();
    		echo '<script>alert("Cảm ơn bạn đã quan tâm đánh giá");window.location.href="index"</script>';
    	}
    }
}
