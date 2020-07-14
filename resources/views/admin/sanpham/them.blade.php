@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
                            <small>Thêm sản phẩm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
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

                    @if(session('loi'))
                        <div class="alert alert-danger">
                            {{session('loi')}}
                        </div>
                    @endif

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/sanpham/them" method="POST" enctype="multipart/form-data" id="formThem">
                            
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên sản phẩm" />
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input class="form-control" name="txtGia" placeholder="Nhập giá sản phẩm" />
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="txtMota" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình</label>
                                <input type="file" name="filehinh" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tên loại sản phẩm</label>
                                <select name="txtloaisanpham" id="txtloaisanpham" class="form-control">
                                    @foreach($loaisanpham as $lsp)
                                        <option value="{{$lsp->id}}">{{$lsp->tenloai}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                <label>Tên loại sản phẩm</label>
                                <select name="txtloaisanpham" id="txtloaisanpham" class="form-control">
                                    @foreach($loaisanpham as $lsp)
                                        <option value="{{$lsp->id}}">{{$lsp->tenloaisanpham}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input type="radio" name="noibat" value="1" checked="">Có
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="noibat" value="0">Không
                                </label>
                            </div> --}}
                            
                            <button type="submit" class="btn btn-default">Thêm sản phẩm</button>
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
    <!-- khai báo jquery -->
    {{-- <script type="text/javascript" language="javascript" src="admin_layout/ckeditor/ckeditor.js" ></script> --}}

    <script type="text/javascript">
        $(document).ready(function(){
            $("#txttheloai").change(function(){
                var idtheloai = $(this).val();
                $.get("admin/ajax/loaisanpham/"+idtheloai, function(data){
                    $("#txtloaisanpham").html(data);
                })
            });
        });
    </script>

    <script type="text/javascript">
        var formThem = document.getElementById('formThem');
        var text = 'Bạn có chắc chắn muốn thêm loại dịch vụ này?';
        this.alertBox(formThem, text);
    </script>

@endsection