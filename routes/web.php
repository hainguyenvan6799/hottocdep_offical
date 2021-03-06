<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\CuaHang;
use App\LichDat;
use App\Dichvu;
use App\Loaidichvu;
use App\SendCode;
use App\User;
use App\Mail\verifybooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
	$loaidichvu = Loaidichvu::all();
	$dichvu = Dichvu::all();
    return view('pages.index', ['dichvu'=>$dichvu, 'loaidichvu'=>$loaidichvu]);
});
Route::get('/index', function(){
	$loaidichvu = Loaidichvu::all();
	$dichvu = Dichvu::all();
	return view('pages.index', ['dichvu'=>$dichvu, 'loaidichvu'=>$loaidichvu]);
});
Route::view('/about', 'pages.about');
Route::view('/blog-single', 'pages.blog-single');
Route::view('/blog', 'pages.blog');
Route::view('/contact', 'pages.contact');
Route::view('/gallery', 'pages.gallery');
Route::view('/services', 'pages.service');
Route::view('/rating', 'pages.rating');

// thanh toán nào
Route::get('/thanhtoan/{lichdat_id}', 'lichdatController@thanhtoan')->name('getThanhtoan');
Route::post('/thanhtoan/{lichdat_id}','lichdatController@postThanhtoan')->name('postThanhtoan');
// thanh toán nào


//đăng nhập và đăng ký tài khoản để tiến hành đặt lịch
// Route::post('/signin', 'UserController@signin');
// //đăng ký nè
// Route::get('/login', 'UserController@getlogin');
// Route::post('/login', 'UserController@postlogin');
Auth::routes();

Route::get('logout', function(){
	if(Auth::check())
	{
		Auth::logout();
		session()->flush();
	}
	return redirect('/index');
});
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('test', function(){
// 	$ratings = App\Rating::all();
// 	foreach($ratings as $r)
// 	{
// 		echo $r->user->name;
// 	}
// });

//post Rating form
Route::post('postRating', 'RatingController@postRating');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function(){
	// Route::group(['prefix'=>'theloai'], function(){
	// 	//thêm vào danh sách thể loại
	// 	Route::get('them', 'theloaiController@getThem');
	// 	Route::post('them', 'theloaiController@postThem');

	// 	//Hiển thị danh sách thể loại
	// 	Route::get('danhsach', 'theloaiController@danhsach');

	// 	//Sửa 1 thể loại
	// 	Route::get('sua/{id}','theloaiController@getSua');
	// 	Route::post('sua/{id}','theloaiController@postSua');

	// 	//Xóa 1 thể loại
	// 	Route::get('xoa/{id}', 'theloaiController@xoa');

	// });

	//Bắt đầu lịch đặt
	Route::get('startService/{malichdat}', function($malichdat){
		if(empty(LichDat::where('malichdat',$malichdat)->get()->toArray()))
		{
			return redirect('index');
		}
		$lichdats = LichDat::where('malichdat',$malichdat)->get();
		foreach($lichdats as $lichdat)
		{
			$lichdat->dangthuchien = 1;
			$lichdat->save();
		}
		
		echo '<script>alert("Bắt đầu dịch vụ của lịch đặt '.$malichdat.'");
			window.setTimeout(function(){
            
            window.location.href="https://hottocdep.herokuapp.com/admin/lichdat/danhsach";
        	}, 3000);
		</script>';

	});

	//hoàn thành lịch nào đó
	Route::post('adminhoantatlichdat/{malichdat}', 'dashboardController@adminhoantatlichdat')->name('adminhoantatlichdat');
	
	Route::group(['prefix'=>'dashboard'], function(){
		Route::get('index', 'dashboardController@getIndex')->name('indexDashboard');
	});

	Route::group(['prefix'=>'loaidichvu'], function(){
		//thêm vào danh sách loại sản phẩm
		Route::get('them', 'loaidichvuController@getThem');
		Route::post('them', 'loaidichvuController@postThem');

		//danh sách các loại sản phẩm của cửa hàng
		Route::get('danhsach', 'loaidichvuController@danhsach');

		//sửa 1 loại sản phẩm
		Route::get('sua/{id}', 'loaidichvuController@getSua');
		Route::post('sua/{id}', 'loaidichvuController@postSua');

		Route::get('xoa/{id}', 'loaidichvuController@xoa');

	});

	Route::group(['prefix'=>'dichvu'], function(){
		// thêm vào danh sách sản phẩm
		Route::get('them', 'dichvuController@getThem')->name('dichvu/getThem');
		Route::post('them', 'dichvuController@postThem')->name('dichvu/postThem');

		// //danh sách các loại sản phẩm
		Route::get('danhsach', 'dichvuController@danhsach')->name('dichvu/getDanhsach');

		// //sửa 1 sản phẩm
		Route::get('sua/{id}', 'dichvuController@getSua')->name('dichvu/getSua');
		Route::post('sua/{id}', 'dichvuController@postSua')->name('dichvu/postSua');

		Route::get('xoa/{id}', 'dichvuController@getXoa')->name('dichvu/getXoa');

	});

	Route::group(['prefix'=>'lichdat'], function(){
		Route::get('them', 'lichdatController@getThem')->name('lichdat/getThem');
		Route::post('them', 'lichdatController@postThem')->name('lichdat/postThem');

		// //danh sách các loại sản phẩm
		Route::get('danhsach', 'lichdatController@getDanhsach')->name('lichdat/getDanhsach');

		// //sửa 1 sản phẩm
		Route::get('sua/{id}', 'lichdatController@getSua')->name('lichdat/getSua');
		Route::post('sua/{id}', 'lichdatController@postSua')->name('lichdat/postSua');

		Route::get('xoa/{id}', 'lichdatController@getXoa')->name('lichdat/getXoa');
	});

	Route::group(['prefix'=>'user'], function(){
		Route::get('danhsach', 'UserController@danhsach');

		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');

		Route::get('sua/{iduser}', 'UserController@getSua');
		Route::post('sua/{iduser}', 'UserController@postSua');

		Route::get('xoa/{id}' , 'UserController@getXoa');

		Route::get('huykhoataikhoan', 'UserController@huykhoataikhoan')->name('huykhoataikhoan');
		Route::post('huykhoataikhoan', 'UserController@postHuykhoataikhoan')->name('postHuykhoataikhoan');
	});

	Route::group(['prefix'=>'loaisanpham'], function(){
		Route::get('danhsach', 'LoaisanphamController@danhsach');

		Route::get('them', 'LoaisanphamController@getThem');
		Route::post('them', 'LoaisanphamController@postThem');

		Route::get('sua/{id}', 'LoaisanphamController@getSua');
		Route::post('sua/{id}', 'LoaisanphamController@postSua');
	});

	Route::group(['prefix'=>'sanpham'], function(){
		Route::get('danhsach', 'sanphamController@danhsach');

		Route::get('them', 'sanphamController@getThem');
		Route::post('them', 'sanphamController@postThem');

		Route::get('sua/{id}', 'sanphamController@getSua');
		Route::post('sua/{id}', 'sanphamController@postSua');
	});

	Route::group(['prefix'=>'nhanvien'], function(){
		Route::get('danhsach', 'nhanvienController@danhsach')->name('nhanvien/getDanhsach');

		Route::get('them', 'nhanvienController@getThem')->name('nhanvien/getThem');
		Route::post('them', 'nhanvienController@postThem')->name('nhanvien/postThem');
		//Route::post('them', 'nhanvienController@postThem');

		Route::get('sua/{id}', 'nhanvienController@getSua')->name('nhanvien/getSua');
		Route::post('sua/{id}', 'nhanvienController@postSua')->name('nhanvien/postSua');
		// Route::post('sua/{id}', 'nhanvienController@postSua');

		Route::get('xoa/{id}', 'nhanvienController@xoa')->name('nhanvien/xoa');
	});

	Route::group(['prefix'=>'cuahang'], function(){
		Route::get('danhsach', 'cuahangController@danhsach')->name('cuahang/getDanhsach');

		Route::get('them', 'cuahangController@getThem')->name('cuahang/getThem');
		Route::post('them', 'cuahangController@postThem')->name('cuahang/postThem');
		//Route::post('them', 'nhanvienController@postThem');

		Route::get('sua/{id}', 'cuahangController@getSua')->name('cuahang/getSua');
		Route::post('sua/{id}', 'cuahangController@postSua')->name('cuahang/postSua');
		// Route::post('sua/{id}', 'nhanvienController@postSua');

		Route::get('xoa/{id}', 'cuahangController@xoa')->name('cuahang/xoa');
	});

	Route::group(['prefix'=>'lichlamviec'], function(){
		Route::get('danhsach', 'lichlamviecController@danhsach')->name('lichlamviec/getDanhsach');

		Route::get('them', 'lichlamviecController@getThem')->name('lichlamviec/getThem');
		Route::post('them', 'lichlamviecController@postThem')->name('lichlamviec/postThem');
		//Route::post('them', 'nhanvienController@postThem');

		Route::get('sua/{id}', 'lichlamviecController@getSua')->name('lichlamviec/getSua');
		Route::post('sua/{id}', 'lichlamviecController@postSua')->name('lichlamviec/postSua');
		// Route::post('sua/{id}', 'nhanvienController@postSua');

		Route::get('xoa/{id}', 'lichlamviecController@xoa')->name('lichlamviec/xoa');
	});


	Route::group(['prefix'=>'khachhang'], function(){
		Route::get('danhsach', 'khachhangController@danhsach');

		Route::get('them', 'khachhangController@getThem');
		// Route::post('them', 'khachhangController@postThem');

		Route::get('sua/{id}', 'khachhangController@getSua');
		// Route::post('sua/{id}', 'khachhangController@postSua');
	});

	// Route::('taikhoan/huykhoa', 'dashboardController@huykhoa')->name('taikhoan/huykhoa');



	// Route::group(['prefix'=>'ajax'], function(){
	// 	Route::get('loaisanpham/{idtheloai}', 'ajaxController@getLoaidichvu');
	// });
});

Route::get('test', 'UserController@test');

//Xác thực email và OTP và lịch đặt
//resend verify
Route::post('resendVerify', 'UserController@resendVerify')->name('resendVerify');

Route::get('/xacthucEmail/{email}', 'UserController@getxacthucEmail');
Route::post('/xacthucEmail/{email}', 'UserController@postxacthucEmail');

Route::get('/xacthucOTP/{sdt}', 'UserController@getxacthucOTP');
Route::get('/xacthucOTPlichdat/{malichdat}', 'lichdatController@getxacthucOTPlichdat');
Route::post('/xacthucOTP', 'UserController@postxacthucOTP');
Route::post('/xacthucOTPlichdat', 'lichdatController@postxacthucOTPlichdat');

Route::get('resendcodeotp/{sdt}', function($sdt){
	$code = SendCode::sendcode($sdt);
    User::where('sdt',$sdt)->update(['code'=>$code]);
	return redirect('xacthucOTP/'.$sdt);
});

Route::get('resendcodeotplichdat/{malichdat}', function($malichdat){
	$sdt = '';
	$lichdat = LichDat::where('malichdat', $malichdat)->get();
	foreach($lichdat as $ld)
	{
		if(!empty(LichDat::where('nhanvien_id', $ld->nhanvien_id)->where('ngay', $ld->ngay)->where('thoigian', $ld->thoigian)->where('hienthi', 1)->get()->toArray()))
		{
			// echo '<script>alert("Khung thời gian này đã có khách đặt, bạn hãy thay đổi khung giờ khác.");
			// </script>';
			return redirect('formDatLich/'.$malichdat)->with('thongbaotontai', 'Khung thời gian này đã có khách đặt, bạn hãy thay đổi khung giờ khác.');

		}
		if($ld->thoigian <= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour && $ld->ngay == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
		{
			return redirect('formDatLich/'.$malichdat)->with('thongbaotontai', 'Khung thời gian này đã qua, bạn hãy thay đổi khung giờ khác.');
		}
		$sdt = $ld->sdt;
	}
	$code = SendCode::sendcode($sdt);
    LichDat::where('malichdat',$malichdat)->update(['code'=>$code]);
	return redirect('xacthucOTPlichdat/'.$malichdat);
});
Route::get('resendemaillichdat/{malichdat}', function($malichdat){

	$lichdats = LichDat::where('malichdat', $malichdat)->get();
	foreach($lichdats as $lichdat)
	{
		if(!empty(LichDat::where('nhanvien_id', $lichdat->nhanvien_id)->where('ngay', $lichdat->ngay)->where('thoigian', $lichdat->thoigian)->where('hienthi', 1)->get()->toArray()))
		{
			return redirect('formDatLich/'.$malichdat)->with('thongbaotontai', 'Khung thời gian này đã có khách đặt, bạn hãy thay đổi khung giờ khác.');

		}
		if($lichdat->thoigian <= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour && $lichdat->ngay == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
		{
			return redirect('formDatLich/'.$malichdat)->with('thongbaotontai', 'Khung thời gian này đã qua, bạn hãy thay đổi khung giờ khác.');
		}
		$data = array(
                'name'=>$lichdat->tenkhachhang,
                'message'=>'Vui lòng nhấn vào đường link để xác thực lịch đặt của bạn.',
                'malichdat'=>$lichdat->malichdat
            );
            Mail::to(Auth::user()->email)->send(new verifybooking($data));
	}
	echo '<script>
        alert("Vui lòng kiểm tra email để hoàn tất đặt lịch");
        window.setTimeout(function(){
            
            window.location.href="https://hottocdep.herokuapp.com/";
        }, 3000);</script>';
});

Route::get('xacnhanlichdat/{malichdat}', function($malichdat)
{
	LichDat::where('malichdat', $malichdat)->update(['hienthi'=>1]);
	echo '<script>
		alert("Bạn đã xác nhận lịch đặt thành công.");
		window.setTimeout(function(){
            
            window.location.href="https://hottocdep.herokuapp.com/";
        },3000);
	</script>';
});

//newtest
Route::get('newtest', 'UserController@newtest');

Route::get('googlemap/{ch_lat}/{ch_lng}', 'lichdatController@googlemap');

//đặt lịch nào

Route::get('formDatLich', function(){
	$countHuy = session()->get('countHuy');
	if($countHuy > 2)
	{
		return redirect('index');
	}
	if(!Auth::check())
	{
		return redirect('index');
	}
	session()->forget('sualich');
	session()->forget('id_lichsua');
	return view('datlich.datlich');
});


//sửa lịch đặt
Route::get('formDatLich/{malichdat}', function($malichdat){
	if(empty(LichDat::where('malichdat',$malichdat)->get()->toArray()))
	{
		return redirect('index');
	}
	$lichdat = LichDat::where('malichdat',$malichdat)->get();
	session()->put('sualich', $malichdat);
	session()->put('id_lichsua', $malichdat);
	return view('datlich.datlich', ['lichdat'=>$lichdat]);
});

Route::post('postSualich', 'lichdatController@postKhsualich');

Route::get('lichdat1', function(){
	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho]);
});

Route::get('lichdat2/{id_cuahang}', 'lichdatController@lichdat2');
Route::get('lichdat3/{id_nhanvien}', 'lichdatController@lichdat3');
Route::get('lichdat4', 'lichdatController@lichdat4');

Route::get('hienthicacdichvu/{idloaidichvu}', 'lichdatController@hienthicacdichvu');

//khách hàng thay đổi, xem lịch đặt, hủy lịch đặt

Route::get('xemlailich/{sdt}', 'lichdatController@xemlailich');
Route::get('khachhang/huylich/{malichdat}', 'lichdatController@khachhuylichdat');

//ajax nào các bạn
Route::get('ajax/chonthanhpho/{tp}', 'ajaxController@chonquan');
Route::get('ajax/choncuahang/{tp}/{q}/{lat}/{lng}', 'ajaxController@choncuahang');

Route::post('formBooking', 'lichdatController@formBooking');

Route::get('dbtable', function(){
	$a = DB::table('users')->get();
	foreach($a as $data)
	{
		dd($data);
	}
});


//get nhân viên của cửa hàng
Route::get('getNhanvienCuahang/{id_cuahang}', 'lichdatController@getNhanvienCuahang')->name('getNhanvienCuahang');
//get lịch làm việc của nhân viên nào đó
Route::get('getLichlamviecNhanvien/{id_nhanvien}', 'lichdatController@getLichlamviecNhanvien')->name('getLichlamviecNhanvien');
//get khung giờ làm việc của nhân viên trong ngày đó
Route::get('getKhunggio/{ngay}/{idnv}', 'lichdatController@getKhunggio')->name('getKhunggio');

// Route::get('multistepform', function(){
// 	return view('datlich.datlichnhieubuoc');
// });


Route::get('abctest',function(){
	if(2+3 == 6)
	{
		echo 'a';
	}
	elseif(2+3 == 5 && 6+4==10)
	{
		echo 'b';
	}
});