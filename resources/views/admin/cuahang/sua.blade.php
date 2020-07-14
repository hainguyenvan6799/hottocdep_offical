@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cửa hàng
                            <small>Sửa thông tin Cửa hàng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('cuahang/postSua', ['id'=>$cuahang->id])}}" method="POST" id="formSua">
                            
                            {{csrf_field()}}
                            
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                            @endif

                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                            @if(session('loi'))
                                <div class="alert alert-danger">
                                    {{session('loi')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Tên cửa hàng</label>
                                <input type="text" name="txtTen" value="{{$cuahang->tencuahang}}" required="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Đường</label>
                                <input class="form-control" type="text" name="txtDuong" value="{{$cuahang->duong}}" required="">
                            </div>

                            <div class="form-group">
                                <label>Phường</label>
                                <input class="form-control" type="text" name="txtPhuong" value="{{$cuahang->phuong}}" required="">
                            </div>

                            <div class="form-group">
                                <label>Quận</label>
                                <input type="text" class="form-control" name="txtQuan" value="{{$cuahang->quan}}" required="">
                            </div>

                            <div class="form-group">
                                <label>Thành phố</label>
                                <input type="text" name="txtTP" class="form-control" value="{{$cuahang->thanhpho}}" required="">
                            </div>

                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" name="txtlat" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Longtitude</label>
                                <input type="text" name="txtlng" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-default">Sửa thông tin</button>
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
        var formSua = document.getElementById('formSua');
        var text = 'Bạn có chắc chắn muốn sửa thông tin cửa hàng này?';
        this.alertBox(formSua, text);
    </script>
@endsection