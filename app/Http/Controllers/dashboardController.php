<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LichDat;

class dashboardController extends Controller
{
    //
    public function getIndex(){
    	return view('admin.dashboard.index');
    }
    public function adminhoantatlichdat($id_lichdat, Request $request)
    {

    		$lichdat = LichDat::find($id_lichdat);
    			if($request->hinhthucthanhtoan == 1)
    			{
    				$lichdat->thanhtoan = 1;	
    			}
    			else
    			{
    				$lichdat->thanhtoan = 2;
    			}
    			$lichdat->hoanthanhlich = 1;
    			$lichdat->dathanhtoan = 1;
                $lichdat->dangthuchien = null;
    			$lichdat->save();
                session()->forget('startService');
    			echo '<script>alert("Hoàn tất lịch đặt.");</script>';
    			echo '<script>
    				window.setTimeout(function(){
	                    window.location.href="../lichdat/danhsach";
	                }, 3000);	
    			</script>';
        }
}
