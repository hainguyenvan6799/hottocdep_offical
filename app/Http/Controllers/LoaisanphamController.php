<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Sanpham;

class LoaisanphamController extends Controller
{
    //get
    public function danhsach(){
    	$loaisanpham = Loaisanpham::all();
    	return view('admin.loaisanpham.danhsach', ['loaisanpham'=>$loaisanpham]);
    }
    public function getThem(){
    	return view('admin.loaisanpham.them');
    }
    public function getSua($id)
    {
    	$loaisanpham = Loaisanpham::find($id);
    	return view('admin.loaisanpham.sua', ['loaisanpham'=>$loaisanpham]);
    }

    //post
    public function postThem(Request $request)
    {
        $this->validate($request, 
            [
                'txtTen'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên loại sản phẩm.'
            ]
        );
        $loaisanpham = new Loaisanpham;
        $loaisanpham->tenloai = $request->txtTen;
        $loaisanpham->tenloai_khongdau = utf8tourl($request->txtTen);
        $loaisanpham->save();
        return redirect('admin/loaisanpham/danhsach')->with('thongbao', 'Thêm loại sản phẩm thành công.');
    }
    public function postSua($id, Request $request)
    {
        $this->validate($request, 
            [
                'txtTen'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên loại sản phẩm.'
            ]
        );
        $loaisanpham = Loaisanpham::find($id);
        $loaisanpham->tenloai = $request->txtTen;
        $loaisanpham->tenloai_khongdau = utf8tourl($request->txtTen);
        $loaisanpham->save();
        return redirect('admin/loaisanpham/danhsach')->with('thongbao', 'Bạn đã chỉnh sửa thông tin loại sản phẩm thành công.');
    }
}
