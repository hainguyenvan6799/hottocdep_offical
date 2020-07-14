@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch làm việc nhân viên
                            <small>Sửa thông tin lịch làm việc nhân viên</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('lichlamviec/postSua', ['id'=>$lichlamviec->id])}}" method="POST" id="formSua">
                            
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
                                <label>Chọn ngày làm việc</label>
                                <input class="form-control" type="date" name="txtNgay" required="" value="{{$lichlamviec->ngay}}">
                            </div>

                            <div class="form-group">
                                <label>Nhập thời gian bắt đầu</label>
                                <input class="form-control" type="text" name="txtStart" placeholder="Nhập thời gian bắt đầu ví dụ như 8:00." required="" value="{{$lichlamviec->start_time}}">
                            </div>

                            <div class="form-group">
                                <label>Nhập thời gian kết thúc</label>
                                <input type="text" class="form-control" name="txtStop" placeholder="Nhập thời gian kết thúc ví dụ như 9:00" required="" value="{{$lichlamviec->stop_time}}">
                            </div>

                            <div class="form-group">
                                <label>Cửa hàng</label>
                                <select name="cuahang_id" class="form-control">
                                    @foreach($cuahang as $ch)
                                    <option value="{{$ch->id}}">{{$ch->tencuahang}}</option>
                                    @endforeach
                                </select>
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