@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>Chỉnh sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    @if(count($errors)>0)
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}<br>
                            </div>
                        @endforeach
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/sua/{{$user->id}}" method="POST" id="formSua">
                           {{csrf_field()}}
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên người dùng..." value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="txtEmail" placeholder="Nhập địa chỉ email..." value="{{$user->email}}" readonly="readonly" />
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="txtSdt" placeholder="Nhập số điện thoại..." value="{{$user->sdt}}" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Password</label>
                                <input type="password" class="form-control txtPass" name="txtPass" placeholder="Nhập mật khẩu tại đây..." disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control txtPass" name="txtPassagain" placeholder="Nhập lại mật khẩu tại đây..." disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Loại người dùng </label>
                                <select class="form-control" name="txtloainguoidung">
                                    <option value="1">1-Nhân viên</option>
                                    <option value="2">2-Khách hàng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="txtQuyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="txtQuyen" value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked"))
                {
                    $(".txtPass").removeAttr('disabled');
                }
                else
                {
                    $(".txtPass").attr('disabled','');
                }
            }); 
        });


    </script>

    
    <script type="text/javascript">
        var formSua = document.getElementById('formSua');
        var text = 'Bạn có chắc chắn muốn sửa thông tin loại dịch vụ này?';
        this.alertBox(formSua, text);
    </script>
@endsection
