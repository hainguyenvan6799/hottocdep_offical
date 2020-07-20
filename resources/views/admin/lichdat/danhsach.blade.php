@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch đặt
                            <small>Danh sách lịch đặt</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã lịch đặt</th>
                                <th>Tên nhân viên</th>
                                <th>Tên khách hàng</th>
                                <th>Tên dịch vụ</th>
                                <th>Thời gian</th>
                                <th>Tên cửa hàng</th>
                                <th>Trạng thái</th>
                                <th>Hình thức thanh toán đã chọn</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Nhấn để bắt đầu</th>
                                <th>Nhấn nút để hoàn tất</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lichdat as $ld)
                            <tr class="odd gradeX" align="center">
                                <td>{{$ld->malichdat}}</td>
                                <td>{{$ld->nhanvien->user->name}}</td>
                                <td>{{$ld->tenkhachhang}}</td>
                                <td>{{$ld->dichvu->tendichvu}}</td>
                                <td>{{$ld->thoigian}}</td>
                                <td>{{$ld->cuahang->tencuahang}}</td>
                                @if($ld->khhuydon == 1)
                                <td class="text-danger">Khách hàng hủy lịch</td>
                                @else
                                <td class="text-danger">{{$ld->hoanthanhlich == 1 ? 'Hoàn thành lịch' : 'Chưa hoàn thành lịch'}}</td>
                                @endif

                                <td>{{$ld->thanhtoan == 1 ? 'Thanh toán tại quầy' : 'Thanh toán online'}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a id="xoa" class="xoa" href="{{URL::to('admin/lichdat/xoa/'.$ld->id)}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('lichdat/getSua', ['id'=>$ld->id])}}">Edit</a></td>

                                @if($ld->hoanthanhlich == 0 && $ld->khhuydon == null)
                                <td><a href="admin/startService/{{$ld->malichdat}}">Nhấn để bắt đầu</a></td>
                                @elseif($ld->khhuydon == 1)
                                <td><input type="" name="" disabled="" class="btn btn-danger" value="Đã hủy lịch."></td>
                                @elseif($ld->hoanthanhlich == 0 && $ld->khhuydon == null && $ld->dangthuchien == 1)
                                <td><input type="" name="" disabled="" class="btn btn-success" value="Đang thực hiện."></td>
                                @else
                                <td><input type="" name="" disabled="" class="btn btn-success" value="Đã hoàn thành."></td>
                                @endif

                                @if($ld->hoanthanhlich == 0 && $ld->khhuydon == null)
                                {{-- <td><a href="{{route('adminhoantatlichdat', ['id_lichdat'=>$ld->id])}}">Nhấn để hoàn tất lịch đặt</a></td> --}}
                                <td>
                                <form method="post" action="{{route('adminhoantatlichdat',['id_lichdat'=>$ld->id])}}">
                                    {{csrf_field()}}
                                    <input type="radio" name="hinhthucthanhtoan" value="1" required="">Thanh toán tại chỗ<br>
                                    <input type="radio" name="hinhthucthanhtoan" value="2" required="">Thanh toán online<br>
                                    <input type="submit" name="" value="Nhấn để hoàn thành">
                                </form>
                                </td>
                                @elseif($ld->khhuydon == 1)
                                <td><input type="" name="" disabled="" class="btn btn-danger" value="Đã hủy lịch."></td>
                                @else
                                <td><input type="" name="" disabled="" class="btn btn-success" value="Đã hoàn thành."></td>
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

{{-- @section('script')
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('.xoa').on('click', function(){
                if(confirm("Bạn có chắc chắn muốn xóa lịch đặt này?"))
            {
                return true;
            }
            else
            {
                return false;
            }
            });
            
        });
            
    </script>
@endsection --}}


