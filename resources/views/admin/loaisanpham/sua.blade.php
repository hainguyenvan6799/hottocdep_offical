@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Sửa thông tin loại sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <form action="admin/loaisanpham/sua/{{$loaisanpham->id}}" method="POST" id="formSua">
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

                            <div class="form-group">
                                <label>Tên loại sản phẩm</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên loại sản phẩm muốn chỉnh sửa..." value="{{$loaisanpham->tenloai}}" />
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
        var formSua = document.getElementById('formSua');
        var text = 'Bạn có chắc chắn muốn sửa thông tin loại dịch vụ này?';
        this.alertBox(formSua, text);
    </script>
@endsection