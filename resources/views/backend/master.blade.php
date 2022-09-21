<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} | Dashboard </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition     sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        @can('Change Password')
                            
                        <a href="{{route('AdminChangePassword')}}" class="dropdown-item">
                            <i class="fas fa-tools mr-2"></i> Change Password
                        </a>
                        @endcan
                        <a class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('from_logout').submit()"
                            href="{{ route('logout') }}"><i class="fa fa-key mr-2"></i>Log
                            out</a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('dashboard.index')}}" class="brand-link">
                <span class="brand-text pl-5 font-weight-light">{{config('app.name')}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('Frontendhome')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Home Page
                                </p>
                            </a>
                        </li>
                        {{-- @can('Admin Dashboard') --}}

                        <li class="nav-item">
                            <a href="{{route('dashboard.index')}}" class="nav-link @yield('dashboard_active')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        {{-- @endcan --}}

                        {{-- @if (auth()->user()->can('View Category') || auth()->user()->can('Create Category'))
                        <li class="nav-item @yield('cat_dropdown_active') ">
                            <a href="#" class="nav-link @yield('cat_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Catagory
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('View Category')

                                <li class="nav-item">
                                    <a href="{{route('catagory.index')}}" class="nav-link  @yield('cat_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Catagory</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create Category')
                                <li class="nav-item">
                                    <a href="{{route('catagory.create')}}" class="nav-link @yield('cat_add-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Catagory</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif --}}

                        {{-- Depot create Start --}}
                        @if (auth()->user()->can('View Depot') || auth()->user()->can('Create Depot'))
                        <li class="nav-item @yield('depot_dropdown_active') ">
                            <a href="#" class="nav-link @yield('depot_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Depot
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('View Depot')

                                <li class="nav-item">
                                    <a href="{{route('depot.index')}}" class="nav-link  @yield('depot_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Depot</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create Depot')
                                <li class="nav-item">
                                    <a href="{{route('depot.create')}}" class="nav-link @yield('depot_add-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Depot</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        {{-- Depot create End --}}

                        {{-- Payment Method Sart --}}
                        @if (auth()->user()->can('View Paymentmethod') || auth()->user()->can('Create Paymentmethod'))
                        <li class="nav-item @yield('Paymentmethod_dropdown_active') ">
                            <a href="#" class="nav-link @yield('Paymentmethod_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Payment Method
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('View Paymentmethod')

                                <li class="nav-item">
                                    <a href="{{route('payment-method.index')}}"
                                        class="nav-link  @yield('Paymentmethod_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Payment Method</p>
                                    </a>
                                </li>
                                @endcan

                                @can('Create Paymentmethod')
                                <li class="nav-item">
                                    <a href="{{route('payment-method.create')}}"
                                        class="nav-link @yield('Paymentmethod_add-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Payment Method</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        {{-- Payment Method End --}}
                        {{-- Bank Start --}}

                        @if (auth()->user()->can('View Bank') || auth()->user()->can('Create Bank'))
                        <li class="nav-item @yield('bank_dropdown_active') ">
                            <a href="#" class="nav-link @yield('bank_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Bank
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('View Bank')

                                <li class="nav-item">
                                    <a href="{{route('bank.index')}}" class="nav-link  @yield('bank_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Banks</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create Bank')
                                <li class="nav-item">
                                    <a href="{{route('bank.create')}}" class="nav-link @yield('bank_add-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Banks</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif

                        {{-- Bank End --}}
                       
                        {{-- Start Payment --}}
                        @if (auth()->user()->can('View Payment') || auth()->user()->can('Create Payment'))
                        <li class="nav-item @yield('payment_dropdown_active') ">
                            <a href="#" class="nav-link @yield('payment_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    All Collection 
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('View Payment')

                                <li class="nav-item">
                                    <a href="{{route('coll.index')}}" class="nav-link  @yield('payment_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Collections</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create Payment')
                                <li class="nav-item">
                                    <a href="{{route('coll.create')}}" class="nav-link @yield('payment_add-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Collections</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif

                        {{-- End Payment --}}


                        @if (auth()->user()->can('Create Role') || auth()->user()->can('View Role') ||
                        auth()->user()->can('Assign User') || auth()->user()->can('Reset Password') ||
                        auth()->user()->can('Add User'))
                        <li class="nav-item @yield('role_dropdown_active')">
                            <a href="#" class="nav-link @yield('role_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Role Managements
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Create Role')
                                <li class="nav-item">
                                    <a href="{{route('roles.create')}}" class="nav-link @yield('add_role-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Role</p>
                                    </a>
                                </li>
                                @endcan
                                @can('View Role')
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link @yield('role_view-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Role</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Assign User')
                                <li class="nav-item">
                                    <a href="{{route('AssignUser')}}" class="nav-link @yield('assign_user_active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assign User</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Add User')
                                <li class="nav-item">
                                    <a href="{{route('CreateUser')}}" class="nav-link @yield('add_user_active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Reset Password')
                                <li class="nav-item">
                                    <a href="{{route('ResetPass')}}" class="nav-link @yield('reset_active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Password</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                       
                        @can('Order')
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link @yield('view_order-active')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Payment
                                </p>
                            </a>
                        </li>
                        @endcan
                        {{-- @if (auth()->user()->can('Setting') || auth()->user()->can('Banner') ||
                        auth()->user()->can('About'))
                        <li class="nav-item @yield('Site_setting_active')">
                            <a href="#" class="nav-link @yield('site-setting_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Site Setting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            @can('Banner')

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('SiteBanner')}}" class="nav-link @yield('banner-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banner</p>
                                    </a>
                                </li>
                            </ul>
                            @endcan
                            @can('About')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{Illuminate\Support\Facades\URL::signedRoute('SiteAbout',1)}}"
                                        class="nav-link @yield('about-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>About</p>
                                    </a>
                                </li>
                            </ul>
                            @endcan
                            @can('Setting')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{Illuminate\Support\Facades\URL::signedRoute('settings.edit',1)}}"
                                        class="nav-link @yield('setting-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Settings</p>
                                    </a>
                                </li>
                            </ul>
                            @endcan
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('settings.create')}}" class="nav-link @yield('subs-active')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Subscribers</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif --}}
                        <form id="from_logout" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <!-- Bootstrap -->
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('backedn/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('backend/dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>
    
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

  

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
   

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    @yield('script_js')
</body>

</html>