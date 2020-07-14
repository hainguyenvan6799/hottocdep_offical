	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		    <div class="container">
		      <a class="navbar-brand" href="index.html"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Haircare</a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>

		      <div class="collapse navbar-collapse" id="ftco-nav">
		        <ul class="navbar-nav ml-auto">
		        	<li class="nav-item active"><a href="{{URL::to('index')}}" class="nav-link">Trang chủ</a></li>
		        	<li class="nav-item"><a href="{{URL::to('services')}}" class="nav-link">Dịch vụ</a></li>
		        	<li class="nav-item"><a href="{{URL::to('gallery')}}" class="nav-link">Cửa hàng</a></li>
		        	<li class="nav-item"><a href="{{URL::to('about')}}" class="nav-link">About</a></li>
		        	<li class="nav-item"><a href="{{URL::to('blog')}}" class="nav-link">Blog</a></li>
		          	<li class="nav-item"><a href="{{URL::to('contact')}}" class="nav-link">Liên hệ</a></li>
		          	@if(Auth::check())
		          	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="position: relative;">
				      Tài khoản
				    </button>
				    <div class="dropdown-menu" style="border: 2px solid yellow; position: absolute; top: 90px; right: 15px; left: 1100px;">
				    	@if(Auth::user()->quyen == 1)
				      <a href="{{URL::to('admin/dashboard/index')}}" class="dropdown-item btn btn-warning">Quản Lý</a>
				      @endif
				      <a href="#" class="dropdown-item btn btn-warning">Xin chào {{Auth::user()->name}}</a>
				      <a href="{{URL::to('logout')}}" class="dropdown-item btn btn-warning">Đăng xuất</a>
				      {{-- <a href="admin/dashboard/index" class="dropdown-item btn btn-warning">Quản Lý</a>
				      <a href="admin/dashboard/index" class="dropdown-item btn btn-warning">Quản Lý</a> --}}
				    </div>
		          		
		          	@else
		          		<li class="nav-item"><a type="button" class="nav-link btn btn-warning" data-toggle="modal" data-target="#mymodal">Đăng nhập</a></li>
		          	@endif
		          	
		        </ul>
		      </div>
		    </div>
		  </nav>



		  {{-- modal --}}
		  	<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Đăng nhập nào</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<form action="{{URL::to('login')}}" method="post">
	      		{{csrf_field()}}
	      		<div class="form-group">
	      			<label for="dangnhap" class="text-danger">Nhập SĐT/Email</label>
	      			<input type="text" name="txtusername" id="dangnhap" class="form-control"><br>
	      		</div>
	      		<div class="form-group">
	      			<label for="password" class="text-danger">Nhập mật khẩu</label>
	      			<input type="password" name="txtPW" id="password" class="form-control"><br>
	      		</div>
	      		<input type="submit" name="submitbtn" value="Tiếp tục" class="btn btn-success">
	      		<a href="register">Chưa có Tài khoản, đăng ký tại đây.</a>
	      	</form>
	        
	      </div>
	    </div>
	  </div>
	</div>
		  {{-- modal --}}