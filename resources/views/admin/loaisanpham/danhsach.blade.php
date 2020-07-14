@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Danh sách các loại sản phẩm</small>
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
                                <th>ID</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loaisanpham as $lsp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$lsp->id}}</td>
                                <td>{{$lsp->tenloai}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a id="xoa" onclick="xoa({{$lsp->id}}, event);"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaisanpham/sua/{{$lsp->id}}">Edit</a></td>
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
