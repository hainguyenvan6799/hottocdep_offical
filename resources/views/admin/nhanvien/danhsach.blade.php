@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhân viên
                            <small>Danh sách các nhân viên</small>
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
                                <th>ID nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Địa chỉ Email</th>
                                <th>Chức vụ</th>
                                <th>Ảnh đại diện</th>
                                <th>Nơi làm việc</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nhanvien as $nv)
                            <tr class="odd gradeX" align="center">
                                <td>{{$nv->id}}</td>
                                <td>{{$nv->user->name}}</td>
                                <td>{{$nv->user->email}}</td>
                                <td>{{$nv->chucvu}}</td>
                                <td><img src="images/nhanvien/{{$nv->anhdaidien}}"></td>
                                <td>{{$nv->cuahang->tencuahang}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class="xoa" id="xoa" href="{{route('nhanvien/xoa', ['id'=>$nv->id])}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('nhanvien/getSua', ['id'=>$nv->id])}}">Edit</a></td>
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
