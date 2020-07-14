<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Sanpham;

class sanphamController extends Controller
{
    //get
    public function danhsach(){
    	$sanpham = Sanpham::all();
    	return view('admin.sanpham.danhsach', ['sanpham'=>$sanpham]);
    }
    public function getThem(){
        $loaisanpham = Loaisanpham::all();
    	return view('admin.sanpham.them', ['loaisanpham'=>$loaisanpham]);
    }
    public function getSua($id)
    {
    	$sanpham = Sanpham::find($id);
    	return view('admin.sanpham.sua', ['sanpham'=>$sanpham]);
    }

    //post
    public function postThem(Request $request)
    {
        $this->validate($request, 
            [
                'txtTen'=>'required',
                'txtGia'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên sản phẩm.',
                'txtGia.required'=>'Bạn cần nhập giá'
            ]
        );
        $sanpham = new Sanpham;
        $sanpham->tensanpham = $request->txtTen;
        $sanpham->gia = $request->txtGia;
        $sanpham->mota = $request->txtMota;
        $sanpham->luotyeuthich = 0;
        $sanpham->tensanpham_khongdau = utf8tourl($request->txtTen);
        $sanpham->loaisanpham_id = $request->txtloaisanpham;
        if(!$request->hasFile('filehinh'))
        {
            return redirect('admin/sanpham/them')->with('loi','Bạn cần thêm hình ảnh đại diện cho sản phẩm.');
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalname = $filehinh->getClientOriginalName();
            $extendoffile = $filehinh->getClientOriginalExtension();
            if($extendoffile != 'jpg' && $extendoffile != 'png')
            {
                return redirect('admin/sanpham/them')->with('loi','Chỉ được nhập file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalname;
                while(file_exists("images/sanpham/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalname;
                }
                $filehinh->move('images/sanpham', $newname);
                $sanpham->hinhdaidien = $newname;
            }
        }
        $sanpham->save();
        return redirect('admin/sanpham/danhsach')->with('thongbao','Thêm sản phẩm thành công.');
    }
    public function postSua($id, Request $request)
    {
        $this->validate($request, 
            [
                'txtTen'=>'required',
                'txtGia'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên sản phẩm.',
                'txtGia.required'=>'Bạn cần nhập giá'
            ]
        );
        $sanpham = Sanpham::find($id);
        $sanpham->tensanpham = $request->txtTen;
        $sanpham->gia = $request->txtGia;
        $sanpham->mota = $request->txtMota;
        $sanpham->tensanpham_khongdau = utf8tourl($request->txtTen);
        if(!$request->hasFile('filehinh'))
        {
            $sanpham->hinhdaidien = $sanpham->hinhdaidien;
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalname = $filehinh->getClientOriginalName();
            $extendoffile = $filehinh->getClientOriginalExtension();
            if($extendoffile != 'jpg' && $extendoffile != 'png')
            {
                return redirect('admin/sanpham/sua/'.$id)->with('loi','Chỉ được nhập file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalname;
                while(file_exists("images/sanpham/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalname;
                }
                $filehinh->move('images/sanpham', $newname);
                $sanpham->hinhdaidien = $newname;
            }
        }
        $sanpham->save();
        return redirect('admin/sanpham/danhsach')->with('thongbao','Sửa thông tin sản phẩm thành công.');   
    }
}
