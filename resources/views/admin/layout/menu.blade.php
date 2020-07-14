<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Loại dịch vụ<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/loaidichvu/danhsach">Danh sách Loại dịch vụ</a>
                                </li>
                                <li>
                                    <a href="admin/loaidichvu/them">Thêm loại dịch vụ</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Dịch vụ<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('dichvu/getDanhsach')}}">Danh sách dịch vụ</a>
                                </li>
                                <li>
                                    <a href="{{route('dichvu/getThem')}}">Thêm dịch vụ</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i>User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/user/danhsach">Danh sách User</a>
                                </li>
                                <li>
                                    <a href="admin/user/them">Thêm user</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        {{-- <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Loại sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/loaisanpham/danhsach">Danh sách Loại sản phẩm</a>
                                </li>
                                <li>
                                    <a href="admin/loaisanpham/them">Thêm loại sản phẩm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/sanpham/danhsach">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="admin/sanpham/them">Thêm sản phẩm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> --}}

                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Nhân viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('nhanvien/getDanhsach')}}">Danh sách Nhân viên</a>
                                </li>
                                <li>
                                    <a href="{{route('nhanvien/getThem')}}">Thêm Nhân viên</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Cửa hàng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('cuahang/getDanhsach')}}">Danh sách Cửa hàng</a>
                                </li>
                                <li>
                                    <a href="{{route('cuahang/getThem')}}">Thêm Cửa hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                         <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Lịch làm việc nhân viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('lichlamviec/getDanhsach')}}">Danh sách lịch làm việc nhân viên</a>
                                </li>
                                <li>
                                    <a href="{{route('lichlamviec/getThem')}}">Thêm lịch làm việc</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        {{-- <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Khách hàng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/khachhang/danhsach">Danh sách Khách hàng</a>
                                </li>
                                <li>
                                    <a href="admin/khachhang/them">Thêm Khách hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> --}}

                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Lịch đặt<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('lichdat/getDanhsach')}}">Danh sách Lịch đặt</a>
                                </li>
                                <li>
                                    <a href="{{route('lichdat/getThem')}}">Thêm Lịch đặt</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
