<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            {!! HTML::image('public/backend/dist/img/user2-160x160.jpg', 'User Image', ['class' => 'img-circle']) !!}
        </div>
        <div class="pull-left info">
            <p>Họ tên</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.getIndex'), '<i class="fa fa-tachometer"></i><span>Trang chủ</span>')) !!}
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.categories.getIndex'), '<i class="fa fa-th-large"></i><span>QL Danh mục</span>')) !!}
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.products.getIndex'), '<i class="fa  fa-th-list"></i><span>QL Sản phẩm</span>')) !!}
        </li>
       
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>QL Chi tiết SP</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu menu-open">
                <li>
                    {!! HTML::decode(HTML::link(URL::route('admin.parameters.getIndex'), '<i class="fa fa-barcode"></i><span>QL Thông số kỹ thuật</span>')) !!}
                </li>
                <li>
                    {!! HTML::decode(HTML::link(URL::route('admin.colors.getIndex'), '<i class="fa  fa-delicious"></i><span>QL Color</span>')) !!}
                </li>
                <li>
                    {!! HTML::decode(HTML::link(URL::route('admin.sizes.getIndex'), '<i class="fa  fa-text-width"></i><span>QL Kích thước (size)</span>')) !!}
                </li>
                
            </ul>
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.searchs.getIndex'), '<i class="fa  fa-text-width"></i><span>Thiết lập tìm kiếm</span>')) !!}
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.users.getIndex'), '<i class="fa  fa-text-width"></i><span>Quản lý nhân viên</span>')) !!}
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.orders.getIndex'), '<i class="fa  fa-text-width"></i><span>Quản lý đặt hàng</span>')) !!}
        </li>
        <li>
            {!! HTML::decode(HTML::link(URL::route('admin.users.getIndex'), '<i class="fa  fa-text-width"></i><span>Quản lý người dùng</span>')) !!}
        </li>
    </ul> 
</section>