<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dichvu;
use App\Loaidichvu;

class dichvuController extends Controller
{
    //get
    public function danhsach(){
    	$dichvu = Dichvu::all();
    	return view('admin.dichvu.danhsach', ['dichvu'=>$dichvu]);
    }
    public function getThem(){
    	$loaidichvu = Loaidichvu::all(); 
    	return view('admin.dichvu.them', ['loaidichvu'=>$loaidichvu]); 
    }
    public function getSua($iddv)
    {
    	$dichvu = Dichvu::find($iddv);
    	return view('admin.dichvu.sua', ['dichvu'=>$dichvu]);
    }

    //post
    public function postThem(Request $request){
        $ktradichvu = Dichvu::where('tendichvu', $request->txtTen)->get();
        foreach($ktradichvu as $kt)
        {
            if($kt->id)
            {
                return redirect()->route('dichvu/getThem')->with('loi', 'Tên dịch vụ đã tồn tại.');
            }
        }
        $this->validate($request,
            [
                // 'txtTen'=>['regex:/^[_A-z0-9]*((-|\s)*[_A-z0-9])*$/'],// chứa chữ cái, số, không chứa kí tự đặc biệt
                'txtGia'=>'gt:0|numeric'// Thêm vào kiểm tra phải là số và lớn hơn 0
            ],
            [
                // 'txtTen.required'=>'Bạn cần nhập tên dịch vụ.',
                // 'txtTen.regex'=>'Tên dịch vụ không được chứa các ký tự đặc biệt.',
                'txtGia.gt'=>'Bạn cần nhập giá là một số > 0.',
                'txtGia.numeric'=>'Bạn cần nhập giá là một chữ số.'
            ]
        );
        
        
        $dichvu = new Dichvu;
        $dichvu->tendichvu = $request->txtTen;
        $dichvu->gia = $request->txtGia;
        $dichvu->tendichvu_khongdau = utf8tourl($request->txtTen);
        $dichvu->id_loaidichvu = $request->txtloaidichvu;
        $dichvu->mota = $request->txtMota;
        $dichvu->luotyeuthich = 0;
        if(!$request->hasFile('filehinh'))
        {
            return redirect()->route('dichvu/getDanhsach')->with('loi','Dịch vụ chưa có ảnh đại diện.');
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect()->route('dichvu/getThem')->with('loi','Bạn chỉ được thêm file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/dichvu/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move('images/dichvu/',$newname);
                $dichvu->anhdaidien = $newname;
            }
        }
        $dichvu->hienthi = 1;
        $dichvu->save();
        return redirect()->route('dichvu/getDanhsach')->with('thongbao','Thêm dịch vụ thành công.');
    }

    public function postSua($id, Request $request)
    {
        $ktradichvu = Dichvu::where('tendichvu', $request->txtTen)->get();
        foreach($ktradichvu as $kt)
        {
            if($kt->id)
            {
                return redirect()->route('dichvu/getThem')->with('loi', 'Tên dịch vụ đã tồn tại.');
            }
        }
        $this->validate($request,
            [
                'txtGia'=>'gt:0|numeric'
            ],
            [
                'txtGia.gt'=>'Bạn cần nhập giá là một số > 0.',
                'txtGia.numeric'=>'Bạn cần nhập giá là một số.'
            ]
        );
        $dichvu = Dichvu::find($id);
        $dichvu->tendichvu = $request->txtTen;
        $dichvu->gia = $request->txtGia;
        $dichvu->mota = $request->txtMota;
        if(!$request->hasFile('filehinh'))
        {
            $dichvu->anhdaidien = $dichvu->anhdaidien;
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect()->route('dichvu/getSua', ['id'=>$id])->with('loi', 'Chỉ được phép chọn file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/dichvu/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move("images/dichvu",$newname);
                $dichvu->anhdaidien = $newname;
            }
        }
        $dichvu->save();
        return redirect()->route('dichvu/getDanhsach')->with('thongbao','Chỉnh sửa thông tin dịch vụ thành công.');
    }
    public function getXoa($id)
    {
        $dichvu = Dichvu::find($id);
        $dichvu->hienthi = 0;
        $dichvu->save();
        return redirect()->route('dichvu/getDanhsach')->with('thongbao', 'Xóa dịch vụ thành công.');
    }
}
