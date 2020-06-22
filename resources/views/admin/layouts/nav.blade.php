<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    @include('admin.layouts.menu')
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{url('design/adminpanel')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('design/adminpanel')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{active_menu('admin')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{trans('admin.admin_account')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('admin')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/admin')}}" class="nav-link">
                                <i class="fas fa-users"></i>
                                {{trans('admin.admin_account')}}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('user')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            {{trans('user.user_account')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('user')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/user')}}" class="nav-link">
                                <i class="fas fa-user"></i>
                                {{trans('user.user_account')}}
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{url('admin/user')}}?level=user" class="nav-link">
                                <i class="fas fa-user"></i>
                                {{trans('user.user')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/user')}}?level=vendor" class="nav-link">
                                <i class="fas fa-user"></i>
                                {{trans('user.vendor')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/user')}}?level=company" class="nav-link">
                                <i class="fas fa-user"></i>
                                {{trans('user.company')}}
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item has-treeview {{active_menu('countries')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            {{trans('admin.countries')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('countries')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/countries')}}" class="nav-link">
                                <i class="fa fa-flag"></i>
                                {{trans('admin.countries')}}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('cities')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            {{trans('admin.cities')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('cities')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/cities')}}" class="nav-link">
                                <i class="fas fa-city"></i>
                                {{trans('admin.cities')}}
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{active_menu('states')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-street-view"></i>
                        <p>
                            {{trans('admin.states')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('states')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/states')}}" class="nav-link">
                                <i class="fa fa-street-view"></i>
                                {{trans('admin.states')}}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('posts')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-poo-storm"></i>
                        <p>
                            Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('posts')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/posts')}}" class="nav-link">
                                <i class="fas fa-poo-storm"></i>
                                Posts
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('departments')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Departments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('departments')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/departments')}}" class="nav-link">
                                <i class="fas fa-list"></i>
                                Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/departments/create')}}" class="nav-link">
                                <i class="fas fa-list"></i>
                                Create
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('brands')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-trademark"></i>
                        <p>
                            Brands
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('brands')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/brands')}}" class="nav-link">
                                <i class="fa fa-trademark"></i>
                                Brands
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('manufacturers')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            Manufacturers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('manufacturers')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/manufacturers')}}" class="nav-link">
                                <i class="fa fa-industry"></i>
                                Manufacturers
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('shippings')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>
                            Shippings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('shippings')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/shippings')}}" class="nav-link">
                                <i class="fas fa-shipping-fast"></i>
                                Shippings
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('malls')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Malls
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('malls')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/malls')}}" class="nav-link">
                                <i class="fa fa-building"></i>
                                Malls
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('colors')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fa fa-paint-brush"></i>
                        <p>
                            Colors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('colors')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/colors')}}" class="nav-link">
                                <i class="fas fa-paint-roller"></i>
                                Colors
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('sizes')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fa fa-long-arrow-down"></i>
                        <p>
                            Size
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('sizes')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/sizes')}}" class="nav-link">
                                <i class="fas fa-arrow-circle-left"></i>
                                Size
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('weights')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-weight-hanging"></i>
                        <p>
                            Weight
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('weights')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/weights')}}" class="nav-link">
                                <i class="fas fa-weight-hanging"></i>
                                Weight
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{active_menu('products')[0]}}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{active_menu('products')[1]}}">
                        <li class="nav-item">
                            <a href="{{url('admin/products')}}" class="nav-link">
                                <i class="fa fa-tags"></i>
                                Products
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{route('admin.logout')}}" class="nav-link">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Logot</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>