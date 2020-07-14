@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhân viên
                            <small>Thêm Nhân viên</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('nhanvien/postThem')}}" method="POST" id="formThem" enctype="multipart/form-data">
                            
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
                                <select name="user_id" class="form-control">
                                    @foreach($users as $u)
                                    <option value="{{$u->id}}">{{$u->name}} - {{$u->email}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chức vụ</label>
                                <input class="form-control" name="txtChucvu" required="" placeholder="Nhập vị trí của nhân viên trong công ty." />
                            </div>

                            <div class="form-group">
                                <label>Chọn nơi làm việc</label>

                                <select name="cuahang_id">
                                    @foreach($cuahang as $ch)
                                        <option value="{{$ch->id}}">{{$ch->tencuahang}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn ảnh đại diện</label>
                                <input type="file" name="filehinh" class="form-control">
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
        var text = 'Bạn có chắc chắn muốn thêm nhân viên này?';
        this.alertBox(formThem, text);
</script>
@endsection