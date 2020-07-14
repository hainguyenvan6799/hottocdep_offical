@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhân viên
                            <small>Sửa thông tin nhân viên</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <form action="{{route('nhanvien/postSua',['id'=>$nhanvien->id])}}" method="POST" id="formSua" enctype="multipart/form-data">
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
                                <label>Tên nhân viên</label>
                                <input class="form-control" value="{{$nhanvien->user->name}}" readonly="" />
                            </div>

                            <div class="form-group">
                                <label for="txtChucvu">Nhập lại chức vụ</label>
                                <input type="text" name="txtChucvu" id="txtChucvu" value="{{$nhanvien->chucvu}}" required="">
                            </div>

                            <div class="form-group">
                                <label>Chọn nơi làm việc</label>

                                <select name="cuahang_id">
                                    <option value="{{$nhanvien->cuahang_id}}">{{$nhanvien->cuahang->tencuahang}}(Nơi làm việc cũ)</option>
                                    @foreach($cuahang as $ch)
                                        @if($ch->id != $nhanvien->cuahang_id)
                                        <option value="{{$ch->id}}">{{$ch->tencuahang}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn ảnh đại diện</label>
                                <input type="file" name="filehinh" class="form-control">
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
        var text = 'Bạn có chắc chắn muốn sửa thông tin nhân viên này?';
        this.alertBox(formSua, text);
    </script>
@endsection