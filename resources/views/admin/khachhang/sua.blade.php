@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khách hàng
                            <small>Sửa thông tin khách hàng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <form action="admin/khachhang/sua/{{$khachhang->id}}" method="POST" id="formSua">
                            {{csrf_field()}}
                            @if(count($errors)>0)
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

                            {{-- <div class="form-group">
                                <label>Tên Khách hàng</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên Khách hàng muốn chỉnh sửa..." value="{{$loaidichvu->tenloai}}" />
                            </div> --}}
                            
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
        var formSua = document.getElementById('formSua');
        var text = 'Bạn có chắc chắn muốn sửa thông tin loại dịch vụ này?';
        this.alertBox(formSua, text);
    </script>
@endsection