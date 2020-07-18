<?php

namespace App\Http\Controllers;
use App\User;
use App\Loaidichvu;
use App\LichDat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Exception;


class UserController extends Controller
{
    //
	// function signin(Request $request){
	// 	$sdt = $request->input('txtSDT');
	// 	$password = $request->input('txtPW');
	// 	if(Auth::attempt(['sdt'=>$sdt, 'password'=>$password]))
	// 	{
	// 		echo 'Yes';
	// 	}
	// 	else
	// 	{
	// 		echo 'No';
	// 	}
	// }
	// public function getlogin(){
	// 	return view('pages.login');
	// }
	// public function postlogin(Request $request)
	// {
	// 	$this->validate($request, 
	// 		[
	// 			'txtSDT'=>'required|regex:/[0-9]{10}/',
	// 			'txtPW'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
	// 			'txtRPW'=>'required|same:txtPW',
	// 			'txtE'=>'required',
	// 			'txtTen'=>'required'
	// 		],
	// 		[
	// 			'txtSDT.required' => 'Bạn cần nhập số điện thoại.',
	// 			'txtSDT.regex' => 'Số điện thoại gồm 10 chữ số.',
	// 			'txtPW.required' => 'Bạn cần nhập mật khẩu.',
	// 			'txtPW.regex' => 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm cả chữ cái và chữ số.',
	// 			'txtRPW.required' => 'Bạn cần nhập lại mật khẩu một lần nữa.',
	// 			'txtRPW.same' => 'Nhập lại mật khẩu cần phải giống mật khẩu.',
	// 			'txtE.required' => 'Bạn cần nhập email.',
	// 			'txtTen' => 'Bạn cần nhập họ và tên.'
	// 		]
	// 	);
	// 	$user = new User;
	// 	$sdt = $request->txtSDT;
	// 	$password = bcrypt($request->txtPW);
	// 	$user->sdt = $sdt;
	// 	$user->password = $password;
	// 	$user->save();
	// }

	public function danhsach(){
		$users = User::all();
		return view('admin.users.danhsach',['users'=>$users]);
	}

	public function getThem(){
		return view('admin.users.them');
	}
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'txtTen'=>'required',
			'txtEmail'=>'required|regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/',
			'txtPass'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
			'txtPassagain'=>'required|same:txtPass'
		],
		[
			'txtTen.required'=>'Bạn cần nhập thông tin về Họ và Tên',
			'txtEmail.required'=>'Bạn cần nhập email để đăng ký.',
			'txtEmail.regex'=>'Email của bạn phải có định dạng sau abc123@gmail.com',
			'txtPass.required'=>'Bạn cần nhập password.',
			'txtPass.regex'=>'Mật khẩu của bạn phải nhiều hơn 8 ký tự, có thể là chữ hoặc số.',
			'txtPassagain.required'=>'Bạn cần nhập lại mật khẩu.',
			'txtPassagain.same'=>'Nhập lại mật khẩu phải giống với mật khẩu.'
		]
	);
		$user = new User;
		$user->name = $request->txtTen;
		$user->email = $request->txtEmail;
		$user->password = bcrypt($request->txtPass);
		$user->quyen = $request->txtQuyen;
		$user->active = 1;
		$user->sdt = $request->txtSdt;
		$user->save();
		return redirect('admin/user/danhsach')->with('thongbao','Thêm mới người dùng thành công.');
	}

	public function getSua($iduser)
	{
		$user = User::find($iduser);
		return view('admin.users.sua', ['user'=>$user]);
	}
	public function postSua($iduser, Request $request)
	{
		$this->validate($request, [
			'txtTen'=>'required',
			'txtEmail'=>'required|regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/'
		],
		[
			'txtTen.required'=>'Bạn cần nhập thông tin về Họ và Tên',
			'txtEmail.required'=>'Bạn cần nhập email để đăng ký.',
			'txtEmail.regex'=>'Email của bạn phải có định dạng sau abc123@gmail.com'
		]
	);
		
	if($request->changePassword == "on")
	{
		$this->validate($request, 
			[
				'txtPass'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
				'txtPassagain'=>'required|same:txtPass'
			],

			[
				'txtPass.required'=>'Bạn cần nhập password.',
				'txtPass.regex'=>'Mật khẩu của bạn phải nhiều hơn 8 ký tự, có thể là chữ hoặc số.',
				'txtPassagain.required'=>'Bạn cần nhập lại mật khẩu.',
				'txtPassagain.same'=>'Nhập lại mật khẩu phải giống với mật khẩu.'
			]
		);
	}
	$user = User::find($iduser);
		$user->name = $request->txtTen;
		$user->email = $request->txtEmail;
		$user->sdt = $request->txtSdt;
		$request->changePassword == "on" ? $user->password = bcrypt($request->txtPass) : $user->password;
		$user->quyen = $request->txtQuyen;
		$user->loainguoidung = $request->txtloainguoidung;
		$user->save();
		return redirect('admin/user/danhsach')->with('thongbao','Sửa thông tin người dùng thành công.');
	}

	public function getXoa($id){
		if(!User::find($id))
		{
			return redirect('index');
		}
		User::destroy($id);
		return redirect('admin/user/danhsach')->with('thongbao','Xóa người dùng thành công.');
	}
	public function huykhoataikhoan(){
		return view('admin.users.huykhoataikhoan');
	}
	public function postHuykhoataikhoan(Request $request){
		//kiểm tra có tồn tại email đó trong bảng users
		if(!User::where('sdt', $request->txtsdt)->get()->toArray())
		{
			return redirect()->route('huykhoataikhoan')->with('thongbao', 'Số điện thoại không tồn tại.');
		}
		else
		{
			$solanhuy = count(LichDat::where('sdt',$request->txtsdt)->where('khhuydon', 1)->get());
			if($solanhuy < 2)
			{
				return redirect()->route('huykhoataikhoan')->with('thongbao','Tài khoản đã hủy ' . $solanhuy .' lần.');
			}
			else
			{
				LichDat::where('sdt', $request->txtsdt)->delete();
				return redirect()->route('huykhoataikhoan')->with('thongbao', 'Đã mở khóa tài khoản ' .$request->txtsdt);
			}
		}
	}
	// public function test(){
	// 	$loaidv = Loaidichvu::find(1)->get();
	// 	foreach($loaidv as $l)
	// 	{
	// 		dd($l->dichvu);
	// 	}
	// }


	//xác thực tài khoản
	public function resendVerify(Request $request){
		if($request->xacthuc == "sdt")
		{
			return redirect('resendcodeotp/'.$request->txtresend);
		}
		else
		{
			if(!empty(User::where('email', $request->txtresend)->where('active', 0)->get()->toArray()))
			{
				$user = User::where('email', $request->txtresend)->get()->first();
					$data = array(
	                'name'=>$user['name'],
	                'message'=>'Vui lòng nhấn vào đường link để xác thực Email.',
	                'email'=>$user['email']
	            );
	            Mail::to($user['email'])->send(new SendMail($data));
	                return redirect('register')->with('thongbao', 'Vui lòng kiểm tra email để hoàn tất đăng ký.');
			}
			elseif(!empty(User::where('email', $request->txtresend)->where('active', 1)->get()->toArray()))
			{
				echo '<script>alert("Email đã được kích hoạt. vui lòng đăng nhập.");
					window.setTimeout(function(){
						window.location.href = "index";
						}, 3000);
				</script>';
			}
			else
			{
				echo '<script>alert("Không có email.");
					window.setTimeout(function(){
						window.location.href = "https://hottocdep.herokuapp.com/";
						}, 3000);
				</script>';
			}
		}
	}

	public function getxacthucEmail($email){
		return view('mails.xacthucEmail', ['email'=>$email]);
	}
	public function postxacthucEmail(Request $request, $email)
	{
		if($request->xacthucEmail == 1)
		{
			User::where('email', $email)->update(['active'=>1]);
			echo '<script>alert("Xác thực Email thành công.");
			window.setTimeout(function(){
            
	            window.location.href="https://hottocdep.herokuapp.com/";
	        }, 3000);
			</script>';
		}
		else
		{
			$user = User::where('email', $email)->get();
			User::destroy($user[0]['id']);
			// User::destroy($id);
			echo '<script>alert("Thông tin tài khoản chưa được lưu.");
			window.setTimeout(function(){
            
	            window.location.href="https://hottocdep.herokuapp.com/";
	        }, 3000);
			</script>';
		}
	}
	public function getxacthucOTP($sdt){
		return view('SDT.xacthucOTP', ['sdt'=>$sdt]);
	}
	public function postxacthucOTP(Request $request){
		$sdt = $request->txtsdt; 
		$user = User::where('sdt', $sdt)->get()->toArray();
		foreach($user as $u)
		{
			if($u['code'] != $request->code)
			{
				return redirect('xacthucOTP/'.$sdt)->with('loi', 'Bạn đã nhập sai. Vui lòng nhập lại');
			}
			User::where('sdt', $sdt)->update(['code'=>null, 'active'=>1]);
		}
		echo '<script>alert("Bạn đã đăng ký tài khoản thành công.");
		window.setTimeout(function(){
            
            window.location.href="https://hottocdep.herokuapp.com/";
        }, 3000);
		</script>';

	}

	public function newtest(){
		$user = new User;
			$user->email = 'acc@gmail.com';
			$user->name = 'nguyenvanhai';
			$user->password = '123456789';
			$user->active = 0;
			$wasclean = $user->isClean();
			$result = $user->save() || $wasclean;
	}

	public function testPopup(){
		return view('testpopup');
	}
}
