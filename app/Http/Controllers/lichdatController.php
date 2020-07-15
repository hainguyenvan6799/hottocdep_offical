<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;
use App\NhanVien;
use App\LichDat;
use App\Dichvu;
use App\Loaidichvu;
use App\lichlamviec_nhanvien;
use Illuminate\Http\Request;
use App\Http\Controllers\CalendarController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//thanhtoan
use Stripe\Stripe;
use Stripe\Refund;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
// use Cartalyst\Stripe\Stripe;


class lichdatController extends Controller
{
    //
    public function lichdat1(){
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
        $cuahang = CuaHang::all();
    	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho, 'cuahang'=>$cuahang]);
    }

    public function lichdat2($id_cuahang){
        session()->put('id_cuahang', $id_cuahang);
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        return view('datlich.lichdat2', ['nhanvien'=>$nhanvien]);
    }
    public function lichdat3($id_nhanvien)
    {
        $dichvu = Dichvu::all();
        $loaidichvu = Loaidichvu::all();
        return view('datlich.lichdat3', ['id_nhanvien'=>$id_nhanvien, 'dichvu'=>$dichvu, 'loaidichvu'=>$loaidichvu]);
    }
    public function hienthicacdichvu($idloaidichvu){
        $dichvu = Dichvu::where('id_loaidichvu', $idloaidichvu)->get();
        foreach($dichvu as $dv)
        {
            echo '<option value="'.$dv->id.'">'.$dv->tendichvu.'</option>';    
        }
        
    }

    public function lichdat4(){
        $dichvu = Dichvu::all();
        return view('datlich.lichdat4', ['dichvu'=>$dichvu]);
    }
    public function formBooking(Request $request){
        $datebook = $request->datebook;
        $tenkhachhang = $request->ten;
        $id_nhanvien = $request->id_nhanvien;
        $timeslot = $request->timeslot;
        $id_cuahang = session()->get('id_cuahang');
        $email = $request->email;
        $sdt = Auth::user()->sdt;
        $id_dichvu = $request->dichvu;


        $lichdat = new LichDat;
        $lichdat->ngay = $datebook;
        $lichdat->nhanvien_id = $id_nhanvien;
        $lichdat->tenkhachhang = $tenkhachhang;
        $lichdat->dichvu_id = $id_dichvu;
        $lichdat->thoigian = $timeslot;
        $lichdat->id_cuahang = $id_cuahang;
        $lichdat->hienthi = 1;
        $lichdat->sdt = $sdt;
        $lichdat->thanhtoan = $request->hinhthucthanhtoan;
        $lichdat->save();

        $arr1 = str_split((string)$lichdat->id);
        $arr2 = str_split($lichdat->dichvu->tendichvu_khongdau);
        $arr3 = str_split((string)$lichdat->sdt);
        $lichdat->malichdat = $arr2[0] . $arr2[count($arr2)-1] .$arr3[count($arr3)-2] . $arr3[count($arr3)-1];
        $lichdat->save();

        if($lichdat->thanhtoan == 1) // thanh toán tại cửa hàng.
        {
            echo '<script>
        alert("Đặt lịch thành công. Vui lòng thanh toán tại cửa hàng sau khi hoàn tất dịch vụ.");
        window.setTimeout(function(){
            
            window.location.href="index";
        }, 3000);</script>';
        }
        elseif($lichdat->thanhtoan == 2){ // thanh toán bằng hình thức online
            echo '<script>
        if(confirm("Đặt lịch thành công. Bấm OK để chuyển đến trang thanh toán?")){
            window.setTimeout(function(){
            
            window.location.href="thanhtoan/'.$lichdat->id.'";
        }, 3000);
        }
        else{
            window.setTimeout(function(){
            
            window.location.href="index";
        }, 3000);
        }
        </script>';
        }
    }

    // khách hàng
    public function xemlailich($sdt)
    {
        $lichdat = LichDat::where('sdt',$sdt)->get();
        // foreach($lichdat as $ld)
        // {
        //     echo '<div class="border border-success rounded p-3 my-3">';
        //     echo '<h3>'.$ld->tenkhachhang.'</h3>';
        //     echo '<p>Ngày: '.$ld->ngay. ' Thời gian: ' . $ld->thoigian .'</p>';
        //     echo '<input type="button" class="btn btn-warning mr-2" readonly="readonly" value="'.$ld->cuahang->tencuahang.'" />';
        //     echo '<input type="button" class="btn btn-warning mr-2" readonly="readonly" value="Nhân viên: '.$ld->nhanvien->user->name.'"/>';
        //     echo '<a href="#" class="btn btn-primary mr-2">Sửa</a>';
        //     echo '<a class="btn btn-danger khhuylich" href="khachhang/huylich/'.$ld->id.'">Hủy</a>';
        //     echo '</div>';
        // }
        return view('khachhang.khxemlich', ['lichdat'=>$lichdat]);
    }

    public function khachthaydoilichdat($id_lichdat)
    {
        $lichdat = LichDat::find($id_lichdat);
        return view('khachhang.khthaydoilich', ['lichdat'=>$lichdat]);
    }

    public function postKhsualich(Request $request)
    {
        $stripe = Stripe::setApiKey('sk_test_KEGrVZIG4Ea4SJ9O6N1jzIhd00keMDnAz1');
        //sk_test_KEGrVZIG4Ea4SJ9O6N1jzIhd00keMDnAz1
        $id_lichdat = session()->get('id_lichsua');
        $lichdat = LichDat::find($id_lichdat);
        $lichdat->ngay = $request->datebook;
        $lichdat->nhanvien_id = $request->id_nhanvien;
        $lichdat->thoigian = $request->timeslot;
        $lichdat->id_cuahang = session()->get('id_cuahang');
        $lichdat->dichvu_id = $request->dichvu;
        if($lichdat->dathanhtoan == 1 && $lichdat->thanhtoan == 2)
        {
             $refund = \Stripe\Refund::create([
                'charge' => $lichdat->charge_id,
                'amount' => $lichdat->dichvu->gia,  // For 10 $
                'reason' => 'requested_by_customer'
            ]);
            $lichdat->dathanhtoan = 0;
            $lichdat->charge_id = null;
        }
        $lichdat->save();
        session()->forget('sualich');
        session()->forget('id_lichsua');
        if($lichdat->thanhtoan == 1) // thanh toán tại cửa hàng.
        {
            echo '<script>
        alert("Bạn đã thay đổi lịch. Vui lòng thanh toán tại cửa hàng sau khi hoàn tất dịch vụ.");
        window.setTimeout(function(){
            
            window.location.href="index";
        }, 3000);</script>';
        }
        elseif($lichdat->thanhtoan == 2){ // thanh toán bằng hình thức online
            echo '<script>
        if(confirm("Thay đổi lịch thành công. Bấm OK để chuyển đến trang thanh toán?")){
            window.setTimeout(function(){
            
            window.location.href="thanhtoan/'.$lichdat->id.'";
        }, 3000);
        }
        else{
            window.setTimeout(function(){
            
            window.location.href="index";
        }, 3000);
        }
        </script>';
        }
    }

    public function khachhuylichdat($id_lichdat){
        $lichdat = LichDat::find($id_lichdat);
        $lichdat->hienthi = 0;
        $lichdat->khhuydon = 1;
        if($lichdat->dathanhtoan == 1 && $lichdat->thanhtoan == 2)
        {
            $stripe = Stripe::setApiKey('sk_test_KEGrVZIG4Ea4SJ9O6N1jzIhd00keMDnAz1');

             $refund = \Stripe\Refund::create([
                'charge' => $lichdat->charge_id,
                'amount' => 0.8 * $lichdat->dichvu->gia,  // For 10 $
                'reason' => 'requested_by_customer'
            ]);
            $lichdat->dathanhtoan = 0;
            // $lichdat->charge_id = null;
        }
        
        $lichdat->save();
        echo '<script>
        alert("Bạn đã hủy lịch.");
        window.setTimeout(function(){
            window.location.href="https://hottocdep.herokuapp.com"; 
        }, 3000);</script>';
    }
    //xem lại chỗ này

    //admin
    public function getDanhsach(){
        $lichdat = LichDat::all();
        return view('admin.lichdat.danhsach', ['lichdat'=>$lichdat]);
    }

    public function getThem(){
        $lichdat = LichDat::all();
        $cuahang = CuaHang::all();
        return view('admin.lichdat.them', ['lichdat'=>$lichdat, 'cuahang'=>$cuahang]);
    }

    public function postThem(Request $request)
    {
        $lichdat = new LichDat;
        $lichdat->tenkhachhang = $request->txtTen;
        $lichdat->nhanvien_id = $request->chonnhanvien;
        $lichdat->dichvu_id = 1;
        $lichdat->ngay = $request->chon_ngaylamviec;
        $lichdat->thoigian = $request->chon_khunggio;
        $lichdat->id_cuahang = $request->chon_cuahang;
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Thêm mới lịch đặt thành công.');
    }

    public function getXoa($id){ // khi ma` admin chọn hủy lịch đặt thì bên phía ng dùng không nhìn thấy, admin vẫn nhìn thấy
        $lichdat = LichDat::find($id);
        $lichdat->hienthi = 0;
        if($lichdat->dathanhtoan == 1 && $lichdat->thanhtoan == 2)
        {
            $stripe = Stripe::setApiKey('sk_test_KEGrVZIG4Ea4SJ9O6N1jzIhd00keMDnAz1');

             $refund = \Stripe\Refund::create([
                'charge' => $lichdat->charge_id,
                'amount' => 0.8 * $lichdat->dichvu->gia,  // For 10 $
                'reason' => 'requested_by_customer'
            ]);
            $lichdat->dathanhtoan = 0;
            // $lichdat->charge_id = null;
        }
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Xóa lịch đặt thành công.');
    }

    public function getSua($id)
    {
        $lichdat = LichDat::find($id);
        $cuahang = CuaHang::all();
        return view('admin.lichdat.sua', ['lichdat'=>$lichdat, 'cuahang'=>$cuahang]);
    }
    public function postSua(Request $request, $id)
    {
        $lichdat = LichDat::find($id);
        $lichdat->tenkhachhang = $request->txtTen;
        $lichdat->nhanvien_id = $request->chonnhanvien;
        $lichdat->dichvu_id = 1;
        $lichdat->ngay = $request->chon_ngaylamviec;
        $lichdat->thoigian = $request->chon_khunggio;
        $lichdat->id_cuahang = $request->chon_cuahang;
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Sửa lịch đặt thành công.');
    }


    // -------------------////////////////////////////////
    public function getNhanvienCuahang($id_cuahang)
    {
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        echo '<select id="chonnhanvien" name="chonnhanvien"><option>Chọn nhân viên</option>';
        foreach($nhanvien as $nv){
          echo '<option value="'.$nv->id.'">'.$nv->user->name .' - ' . $nv->id.'</option>';
        }  
        echo '</select>';


        //phần script
        echo '<script type="text/javascript">$("#chonnhanvien").on("change", function(){
                $.get("getLichlamviecNhanvien/"+$(this).val(), function(data){
                    $("#chon_lichlamviecnhanvien").html(data);
                });
            });</script>';
    }
    public function getLichlamviecNhanvien($id_nhanvien)
    {
        $lichlamviec = lichlamviec_nhanvien::where('nhanvien_id', $id_nhanvien)->get();
        echo '<select id="chon_ngaylamviec" data-idnv="'.$id_nhanvien.'" name="chon_ngaylamviec"><option>Chọn ngày làm việc</option>';
            foreach($lichlamviec as $llv)
            {   
                if($llv->ngay >= date('Y-m-d')){
                    echo '<option value="'.$llv->ngay.'">'.$llv->ngay.'</option>';
                }
            }
        echo '</select>';

        //phần script
        echo '<script type="text/javascript">
            $("#chon_ngaylamviec").on("change", function(){
                $.get("getKhunggio/"+$(this).val()+"/"+$(this).attr("data-idnv"), function(data){
                    $("#chon_khunggio").html(data);
                });
            });
        </script>';
    }

    public function getKhunggio($ngay, $idnv){
        $duration = 60;
        $cleanup = 0;
        $giolamviec = lichlamviec_nhanvien::where('nhanvien_id', $idnv)->where('ngay', $ngay)->get();
        if(!$giolamviec)
        {
          $start = '0:0';
          $end = '0:0';
        }
        foreach($giolamviec as $g)
        {
          $start = $g->start_time;
          $end = $g->stop_time;
        }

        $timeslot = CalendarController::timeslot($duration, $cleanup, $start, $end);
        echo '<select name="chon_khunggio">';
        foreach($timeslot as $t)
        {
            $giolamviec_daduocdangky = LichDat::where('nhanvien_id', $idnv)->where('ngay', $ngay)->where('thoigian', $t)->get()->toArray();
            if($t > Carbon::now('Asia/Ho_Chi_Minh')->hour || $ngay != Carbon::now())
            {
                if(!$giolamviec_daduocdangky)
                {
                    echo '<option value="'.$t.'">'.$t.'</option>';
                }
                
            }
        }
        echo '</select>';
    }

    public function googlemap($ch_lat, $ch_lng)
    {
        return view('googlemap', ['ch_lat'=>$ch_lat, 'ch_lng'=>$ch_lng]);
    }


    //Thanh toán online
    public function thanhtoan($lichdat_id){
        if(Auth::check()){

            $lichdat = LichDat::find($lichdat_id);
            // dd($lichdat);
            return view('pages.thanhtoan', ['lichdat'=>$lichdat]);
            
        }
        else
        {
            return redirect('/login');
        }
    }
    public function postThanhtoan($lichdat_id, Request $request){
        Stripe::setApiKey('sk_test_KEGrVZIG4Ea4SJ9O6N1jzIhd00keMDnAz1');
        
            $customer = Customer::create(array(
                "email"=>$request->email,//sesion()->get('email');
                "source"=>$request->stripeToken
            ));
            // dd($customer);
            $a = Charge::create(array(
                "amount"=>$request->gia,
                "currency"=>"vnd",
                "description"=>"Test Charge",
                "customer"=>$customer->id
            ));
            $lichdat = LichDat::find($lichdat_id);
            $lichdat->dathanhtoan = 1;
            $lichdat->thanhtoan = 2; // thanh toán online
            $lichdat->charge_id = $a->id;
            $lichdat->save();
            echo '<script>
                alert("Bạn đã thanh toán thành công.");
                window.setTimeout(function(){
                    window.location.href="../index";
                }, 3000);
            </script>';
            // dd($a);
    }
}

