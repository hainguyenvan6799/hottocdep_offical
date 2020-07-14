<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaidichvu;

class loaidichvuController extends Controller
{
    //get các trang
    public function danhsach(){
    	$loaidichvu = Loaidichvu::all();
    	return view('admin.loaidichvu.danhsach', ['loaidichvu'=>$loaidichvu]);
    }
    public function getThem(){
    	return view('admin.loaidichvu.them');
    }
    public function getSua($id)
    {
    	$loaidichvu = Loaidichvu::find($id);
    	return view('admin.loaidichvu.sua', ['loaidichvu'=>$loaidichvu]);
    }

    //post dữ liệu lên các trang
    public function postThem(Request $request){
        $this->validate($request, 
            [
                'txtTen'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên loại dịch vụ.'
            ]
        );
        $loaidichvu = new Loaidichvu;
        $loaidichvu->tenloai = $request->txtTen;
        $loaidichvu->tenloai_khongdau = utf8tourl($request->txtTen);
        $loaidichvu->save();
        return redirect('admin/loaidichvu/danhsach')->with('thongbao', 'Thêm loại dịch vụ thành công.');
    }
    // Định dạng cho tên không dấu
    
// Định dạng cho tên không dấu

    public function postSua($id, Request $request)
    {
        $loaidichvu = Loaidichvu::find($id);
        $this->validate($request,
        [
            'txtTen'=>'required'
        ],
        [
            'txtTen.required'=>'Bạn cần nhập tên loại để chỉnh sửa.'
        ]
    );
        $loaidichvu->tenloai = $request->txtTen;
        $loaidichvu->tenloai_khongdau = utf8tourl($request->txtTen);
        $loaidichvu->save();
        return redirect('admin/loaidichvu/danhsach')->with('thongbao','Sửa thông tin loại dịch vụ thành công.');
    }

    public function xoa($id){
        if($id != '')
        {
            Loaidichvu::destroy($id);
        }
        return redirect('admin/loaidichvu/danhsach')->with('thongbao', 'Xóa loại dịch vụ thành công.');
    }
}
