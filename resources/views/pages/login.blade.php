<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="alert alert-danger">
		@foreach($errors->all() as $err)
			{{$err . '<br>'}}
		@endforeach
	</div>
	<form action="login" method="post">
		{{csrf_field()}}
		Nhập số điện thoại:
		<input type="tel" name="txtSDT">
		<br>
		Nhập password:
		<input type="password" name="txtPW">
		<br>
		Nhập lại password:
		<input type="password" name="txtRPW">
		<br>
		Nhập Email:
		<input type="email" name="txtE">
		<br>
		Nhập họ và tên:
		<input type="text" name="txtTen">
		<br>

		<input type="submit" name="submit" value="Đăng ký tài khoản">
	</form>
</body>
</html>