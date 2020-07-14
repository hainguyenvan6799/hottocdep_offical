@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch làm việc của nhân viên
                            <small>Danh sách lịch làm việc của nhân viên</small>
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
                                <th>ID lịch làm việc</th>
                                <th>Tên nhân viên</th>
                                <th>Ngày làm việc</th>
                                <th>Thời gian làm việc</th>
                                <th>Nơi làm việc</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lichlamviec as $llv)
                            <tr class="odd gradeX" align="center">
                                <td>{{$llv->id}}</td>
                                <td>{{$llv->nhanvien['user']['name']}}</td>
                                <td>{{$llv->ngay}}</td>
                                <td>{{$llv->start_time}} - {{$llv->stop_time}}</td>
                                <td>{{$llv->cuahang->tencuahang}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class="xoa" id="xoa" href="{{route('lichlamviec/xoa', ['id'=>$llv->id])}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('lichlamviec/getSua', ['id'=>$llv->id])}}">Edit</a></td>
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

@section('script')
    <script type="text/javascript">
        function xoa(id, event){
            if(confirm("Bạn có chắc chắn muốn xóa loại dịch vụ này?"))
            {
                document.getElementById('xoa').setAttribute('href',"/HotToc/public/admin/loaidichvu/xoa/"+id);
            }
            else
            {
                document.getElementById('xoa').removeAttribute('href');
            }
        }
    </script>
@endsection
