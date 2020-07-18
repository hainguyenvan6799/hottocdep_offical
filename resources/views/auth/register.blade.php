@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                    @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                    @endif
                

                <div class="card-header">{{ __('Đăng ký hớt tóc nào!') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="formdk">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Họ và Tên') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                            <div class="col-md-6">
                                <input id="sdt" type="tel" class="form-control @error('sdt') is-invalid @enderror" name="sdt" value="{{ old('sdt') }}" required autocomplete="sdt">

                                @error('sdt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận đăng ký bằng: ') }}</label>

                            <div class="col-md-6">
                                <select name="xacthuc" id="xacthuc" class="form-control">
                                    <option value="email">Email</option>
                                    <option value="sdt">OTP số điện thoại</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                                <input type="submit" class="btn btn-primary col-md-4 ml-5" value="{{ __('Nhanh tay đăng ký nào!!') }}">
                                    
                                <a type="button" class="nav-link btn btn-warning col-md-4 ml-5" data-toggle="modal" data-target="#mymodal">Kích hoạt tài khoản</a></li>
                                    
                        </div>



                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- modal --}}
                        <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác thực tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form action="{{route('resendVerify')}}" method="post" id="formResend">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="dangnhap" class="text-danger">Nhập SĐT/Email</label>
                                <input type="text" name="txtresend" id="dangnhap" class="form-control"><br>
                            </div>

                            <div class="form-group">
                                <label class="text-danger">Hình thức xác thực</label>
                                <select name="xacthuc" id="xacthuc" class="form-control">
                                    <option value="email">Email</option>
                                    <option value="sdt">OTP số điện thoại</option>
                                </select>
                            </div>
                            
                            <input type="submit" name="submitbtn" value="Tiếp tục" class="btn btn-success">
                        </form>
                        
                      </div>
                    </div>
                  </div>
                </div>
          {{-- modal --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    // function xacthuc(){
    //     var a = $('#xacthuc').val();
    //     var name = $('#name').val();
    //     var email = $('#email').val();
    //     if(a == 'email')
    //     {
    //         $.get('/HotToc/public/xacthucEmail', function(data){
    //             alert(data);
    //         });
    //     }
    //     else
    //     {
    //        $.get('/HotToc/public/xacthucOTP', function(){
    //             alert('Vui lòng nhập mã OTP trên điện thoại để xác nhận.');
    //        });
    //     }
    // }
</script>
