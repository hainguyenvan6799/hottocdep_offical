<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NhanVien;
use App\CuaHang;
use App\User;
class nhanvienController extends Controller
{
    //get
    public function danhsach(){
    	$nhanvien = NhanVien::all();
    	return view('admin.nhanvien.danhsach', ['nhanvien'=>$nhanvien]);
    }
    public function getThem(){
        $cuahang = CuaHang::all();
        $users = User::where('active', 1)->get();
    	return view('admin.nhanvien.them', ['cuahang'=>$cuahang, 'users'=>$users]);
    }
    public function postThem(Request $request){
        if(!empty(Nhanvien::where('user_id', $request->user_id)->get()->toArray()))
        {
            return redirect()->route('nhanvien/getThem')->with('loi','Nhân viên hiện đã có trong danh sách. Vui lòng nhập tên khác.');
        }
        $nhanvien = new NhanVien;
        $nhanvien->user_id = $request->user_id;
        $nhanvien->chucvu = $request->txtChucvu;
        $nhanvien ->cuahang_id = $request->cuahang_id;
        if(!$request->hasFile('filehinh'))
        {
            return redirect()->route('nhanvien/getThem')->with('loi','Nhân viên chưa có ảnh đại diện.');
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect()->route('nhanvien/getThem')->with('loi','Bạn chỉ được thêm file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/nhanvien/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move('images/nhanvien/',$newname);
                $nhanvien->anhdaidien = $newname;
            }
        }
        $nhanvien->save();
        return redirect()->route('nhanvien/getDanhsach')->with('thongbao', 'Thêm mới nhân viên thành công.');
    }
    public function getSua($id)
    {
        if(!NhanVien::find($id))
        {
            return redirect('index');
        }
    	$nhanvien = NhanVien::find($id);
        $cuahang = CuaHang::all();
    	return view('admin.nhanvien.sua', ['nhanvien'=>$nhanvien, 'cuahang'=>$cuahang]);
    }

    //post
    public function postSua($id, Request $request)
    {
        if(!NhanVien::find($id))
        {
            return redirect('index');
        }
        $nhanvien = NhanVien::find($id);
        $nhanvien->chucvu = $request->txtChucvu;
        $nhanvien->cuahang_id = $request->cuahang_id;

        if(!$request->hasFile('filehinh'))
        {
            return redirect()->route('nhanvien/getSua', ['id'=>$id])->with('loi','Nhân viên chưa có ảnh đại diện.');
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect()->route('nhanvien/getSua',['id'=>$id])->with('loi','Bạn chỉ được thêm file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/nhanvien/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move('images/nhanvien/',$newname);
                $nhanvien->anhdaidien = $newname;
            }
        }
        $nhanvien->save();
        return redirect()->route('nhanvien/getDanhsach')->with('thongbao', 'Sửa thông tin nhân viên thành công.');
    }

    public function xoa($id){
        if(!NhanVien::find($id))
        {
            return redirect('index');
        }
        $nhanvien = NhanVien::find($id);
        $nhanvien->destroy($id);
        return redirect()->route('nhanvien/getDanhsach')->with('thongbao', 'Xóa nhân viên thành công.');
    }

}
