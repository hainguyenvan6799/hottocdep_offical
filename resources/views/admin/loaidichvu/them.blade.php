@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại dịch vụ
                            <small>Thêm loại dịch vụ</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/loaidichvu/them" method="POST" id="formThem">
                            
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
                            <div class="form-group">
                                <label>Tên loại dịch vụ</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên loại dịch vụ." />
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
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
        var formThem = document.getElementById('formThem');
        var text = 'Bạn có chắc chắn muốn thêm loại dịch vụ này?';
        this.alertBox(formThem, text);
    </script>
@endsection