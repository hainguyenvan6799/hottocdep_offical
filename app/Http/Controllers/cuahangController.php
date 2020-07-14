<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NhanVien;
use App\CuaHang;
use App\User;
class cuahangController extends Controller
{
    //get
    public function danhsach(){
    	$cuahang = CuaHang::all();
    	return view('admin.cuahang.danhsach', ['cuahang'=>$cuahang]);
    }
    public function getThem(){
    	return view('admin.cuahang.them');
    }
    public function postThem(Request $request){
        $cuahang = new CuaHang;
        $cuahang->tencuahang = $request->txtTen;
        $cuahang->duong = $request->txtDuong;
        $cuahang->phuong = $request->txtPhuong;
        $cuahang->quan = $request->txtQuan;
        $cuahang->thanhpho = $request->txtTP;
        
        $cuahang->save();
        return redirect()->route('cuahang/getDanhsach')->with('thongbao', 'Thêm mới cửa hàng thành công, vui lòng bổ sung Latitude và Lengtitude để hoàn tất thiết lập vị trí trên bản đồ.');
    }
    public function getSua($id)
    {
        if(!CuaHang::find($id))
        {
            return redirect('index');
        }
    	$cuahang = CuaHang::find($id);
    	return view('admin.cuahang.sua', ['cuahang'=>$cuahang]);
    }

    //post
    public function postSua($id, Request $request)
    {
        if(!CuaHang::find($id))
        {
            return redirect('index');
        }
        $cuahang = CuaHang::find($id);
        $cuahang->tencuahang = $request->txtTen;
        $cuahang->duong = $request->txtDuong;
        $cuahang->phuong = $request->txtPhuong;
        $cuahang->quan = $request->txtQuan;
        $cuahang->thanhpho = $request->txtTP;
        $cuahang->lat = $request->txtlat;
        $cuahang->lng = $request->txtlng;

        $cuahang->save();
        return redirect()->route('cuahang/getDanhsach')->with('thongbao', 'Sửa thông tin cửa hàng thành công.');
    }

    public function xoa($id){
        if(!CuaHang::find($id))
        {
            return redirect('index');
        }
        $cuahang = CuaHang::find($id);
        $cuahang->destroy($id);
        return redirect()->route('cuahang/getDanhsach')->with('thongbao', 'Xóa cửa hàng thành công.');
    }

}
