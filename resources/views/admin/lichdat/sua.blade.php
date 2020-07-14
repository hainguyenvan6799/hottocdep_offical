@extends('admin.layout.index')

<?php
    $now = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour;
?>

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch đặt
                            <small>Sửa lịch đặt</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('lichdat/postThem')}}" method="POST" id="formThem">
                            
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
                                <label>Nhập tên khách hàng</label>
                                <input type="text" class="form-control" name="txtTen" value="{{$lichdat->tenkhachhang}}" />
                            </div>

                            <div class="form-group">
                                <label>Chọn Cửa hàng</label>

                                <select name="chon_cuahang" id="chon_cuahang">
                                    <option>Chọn cửa hàng</option>
                                    @foreach($cuahang as $ch)
                                        <option value="{{$ch->id}}">{{$ch->tencuahang}} - {{'Đường ' . $ch->duong . ', Phường ' . $ch->phuong . ', Quận ' . $ch->quan . ', TP ' . $ch->thanhpho}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="chon_nhanvien">
                                
                                
                            </div>

                            <div class="form-group" id="chon_lichlamviecnhanvien">

                            </div>

                            <div class="form-group" id="chon_khunggio">

                            </div>

                            <button type="submit" class="btn btn-default">Sửa lịch đặt</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#chon_cuahang').on('change', function(){
                $.get('getNhanvienCuahang/'+$('#chon_cuahang').val(), function(data){
                    $('#chon_nhanvien').html(data);
                });
            });
        });
    </script>
    <script type="text/javascript">
        var formThem = document.getElementById('formThem');
        var text = 'Bạn có chắc chắn muốn thêm lịch đặt này?';
        this.alertBox(formThem, text);
    </script>
@endsection