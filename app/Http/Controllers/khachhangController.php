<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhachHang;

class khachhangController extends Controller
{
    //
     public function danhsach(){
    	$khachhang = KhachHang::all();
    	return view('admin.khachhang.danhsach', ['khachhang'=>$khachhang]);
    }
    public function getThem(){
    	return view('admin.khachhang.them');
    }
    public function getSua($id)
    {
    	$khachhang = KhachHang::find($id);
    	return view('admin.khachhang.sua', ['khachhang'=>$khachhang]);
    }
}
