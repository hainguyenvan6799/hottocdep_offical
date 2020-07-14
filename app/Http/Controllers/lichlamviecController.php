<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NhanVien;
use App\CuaHang;
use App\User;
use App\lichlamviec_nhanvien;
class lichlamviecController extends Controller
{
    //get
    public function danhsach(){
    	$lichlamviec = lichlamviec_nhanvien::all();
    	return view('admin.lichlamviec_nhanvien.danhsach', ['lichlamviec'=>$lichlamviec]);
    }
    public function getThem(){
        $nhanvien = NhanVien::all();
        $cuahang = CuaHang::all();
    	return view('admin.lichlamviec_nhanvien.them', ['nhanvien'=>$nhanvien, 'cuahang'=>$cuahang]);
    }
    public function postThem(Request $request){
        if(!empty(lichlamviec_nhanvien::where('ngay', str_replace('/', '-', $request->txtNgay))->where('nhanvien_id', $request->nhanvien_id)->get()->toArray()))
        {
            return redirect()->route('lichlamviec/getThem')->with('loi', 'Đã tồn tại lịch làm việc nhân viên này.');
        }
        if((int)$request->txtStart >= (int)$request->txtStop){
            return redirect()->route('lichlamviec/getThem')->with('loi', 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc.');
        }
        $lichlamviec = new lichlamviec_nhanvien;
        $lichlamviec->nhanvien_id = $request->nhanvien_id;
        $lichlamviec->ngay = str_replace('/', '-', $request->txtNgay);
        $lichlamviec->start_time = $request->txtStart;
        $lichlamviec->stop_time = $request->txtStop;
        $lichlamviec->cuahang_id = $request->cuahang_id;
        
        $lichlamviec->save();
        return redirect()->route('lichlamviec/getDanhsach')->with('thongbao', 'Thêm mới lịch làm việc nhân viên thành công.');
    }
    public function getSua($id)
    {
        if(!lichlamviec_nhanvien::find($id))
        {
            return redirect('index');
        }
    	$lichlamviec = lichlamviec_nhanvien::find($id);
    	return view('admin.lichlamviec_nhanvien.sua', ['lichlamviec'=>$lichlamviec]);
    }

    //post
    public function postSua($id, Request $request)
    {
        if(!lichlamviec_nhanvien::find($id))
        {
            return redirect('index');
        }
        $lichlamviec = lichlamviec_nhanvien::find($id);
        $lichlamviec->ngay = str_replace('/', '-', $request->txtNgay);
        $lichlamviec->start_time = $request->txtStart;
        $lichlamviec->stop_time = $request->txtStop;
        $lichlamviec->cuahang_id = $request->cuahang_id;

        $lichlamviec->save();
        return redirect()->route('lichlamviec/getDanhsach')->with('thongbao', 'Sửa lịch làm việc của nhân viên thành công.');
    }

    public function xoa($id){
        if(!lichlamviec_nhanvien::find($id))
        {
            return redirect('index');
        }
        $lichlamviec = lichlamviec_nhanvien::find($id);
        $lichlamviec->destroy($id);
        return redirect()->route('lichlamviec/getDanhsach')->with('thongbao', 'Xóa lịch làm việc thành công.');
    }

}
