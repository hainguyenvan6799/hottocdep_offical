@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Hủy khóa người dùng</small>
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
                        <form action="{{route('postHuykhoataikhoan')}}" method="POST" id="formHuykhoa">
                            {{csrf_field()}}
                            
                            <div class="form-group">
                                <label>Nhập Số điện thoại</label>
                                <input class="form-control" name="txtsdt" placeholder="Nhập số điện thoại..." />
                            </div>

                            {{-- <div class="form-group">
                                <label>Tesst</label>
                                <input name="txtTest">
                            </div> --}}
                            <button type="submit" class="btn btn-default">Hủy khóa người dùng</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection 

<script type="text/javascript">
        var formHuykhoa = document.getElementById('formHuykhoa');
        var text = 'Bạn có chắc chắn muốn thêm loại dịch vụ này?';
        this.alertBox(formHuykhoa, text);
    </script>