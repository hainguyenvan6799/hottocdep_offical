@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cửa hàng
                            <small>Thêm Cửa hàng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('cuahang/postThem')}}" method="POST" id="formThem">
                            
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
                                <input type="text" name="txtTen" placeholder="Nhập tên cửa hàng." required="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Đường</label>
                                <input class="form-control" type="text" name="txtDuong" placeholder="Nhập đường." required="">
                            </div>

                            <div class="form-group">
                                <label>Phường</label>
                                <input class="form-control" type="text" name="txtPhuong" placeholder="Nhập phường." required="">
                            </div>

                            <div class="form-group">
                                <label>Quận</label>
                                <input type="text" class="form-control" name="txtQuan" placeholder="Nhập quận." required="">
                            </div>

                            <div class="form-group">
                                <label>Thành phố</label>
                                <input type="text" name="txtTP" class="form-control" placeholder="Nhập thành phố." required="">
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