<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    <style>
              @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-size: 14px
}
        a {
            text-decoration: none;
        }
    
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">@yield('title')</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">Welcome, {{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        <i id="toggleLogout" class="text-danger fas fa-sign-out-alt" style="cursor: pointer"></i>
                    </span>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('assets/images/logo512.png') }}" alt="Saura Logo" class="brand-image">
                <span class="ml-3 h6">Saura Dental Clinic</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                @if ($page_open == 'dashboard') class="nav-link active" @else class="nav-link" @endif>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li @if ($page_title == 'appointment') class="nav-item menu-open" @else class="nav-item" @endif>
                            <a href="#"
                                @if ($page_title == 'appointment') class="nav-link active" @else class="nav-link" @endif>
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Appointments
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('appointment.pending') }}"
                                        @if ($page_open == 'pending') class="nav-link active" @else class="nav-link" @endif>

                                        <div id="pending_tab">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pending Approval</p>

                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('appointment.approved') }}"
                                        @if ($page_open == 'approved') class="nav-link active" @else class="nav-link" @endif>

                                        <div id="approve_tab">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Scheduled</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('appointment.canceled') }}"
                                        @if ($page_open == 'canceled') class="nav-link active" @else class="nav-link" @endif>

                                        <div id="canceled_tab">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Canceled</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('appointment.completed') }}"
                                        @if ($page_open == 'completed') class="nav-link active" @else class="nav-link" @endif>

                                        <div id="completed_tab">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Completed</p>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        @role('Admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.services') }}"
                                    @if ($page_open == 'services') class="nav-link active" @else class="nav-link" @endif>
                                    <i class="nav-icon fas fa-tooth"></i>
                                    <p>
                                        Services
                                    </p>
                                </a>
                            </li>
                           
                        @endrole

                        @role('Admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.users') }}"
                                    @if ($page_open == 'users') class="nav-link active" @else class="nav-link" @endif>
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.patient_list') }}"
                                    @if ($page_open == 'patient_list') class="nav-link active" @else class="nav-link" @endif>
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                       Patient List
                                    </p>
                                </a>
                            </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ route('admin.profile') }}"
                                @if ($page_open == 'profile') class="nav-link active" @else class="nav-link" @endif>
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.review') }}"
                                @if ($page_open == 'review') class="nav-link active" @else class="nav-link" @endif>
                                <i class="nav-icon fas fa-comment"></i>
                                <p>Review</p>
                            </a>
                        </li>
                        @role('Admin')

                        <li @if ($page_title == 'services_content') class="nav-item menu-open" @else class="nav-item" @endif>
                            <a href="#"
                                @if ($page_title == 'services_content') class="nav-link active" @else class="nav-link" @endif>
                                <i class="fa fa-globe nav-icon"></i>
                                <p>
                                    Websites
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('content.services.index') }}"
                                        @if ($page_open == 'services_content') class="nav-link active" @else class="nav-link" @endif>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Services</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('content.footer.index') }}"
                                        @if ($page_open == 'footer') class="nav-link active" @else class="nav-link" @endif>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Footer</p>
                                    </a>
                                </li>

                                
                            </ul>
                        </li>
                        {{-- inventory --}}
                        <li class="nav-item">
                          <a href="{{ route('admin.inventory') }}"
                              @if ($page_open == 'inventory') class="nav-link active" @else class="nav-link" @endif>
                              <i class="nav-icon fas fa-boxes"></i>

                              <p>
                                  Inventory Management
                              </p>
                          </a>
                      </li>
                      <li class="nav-item dropdown @if (in_array($page_open, ['inv_report_generation', 'inv_apt_generation'])) active @endif">
                        <a class="nav-link dropdown-toggle @if (in_array($page_open, ['inv_report_generation', 'inv_apt_generation'])) active @endif" href="#" id="reportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="nav-icon fas fa-file-download"></i>
                            Report Generation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="reportDropdown">
                            <a class="dropdown-item @if ($page_open == 'inv_report_generation') active @endif" href="{{ route('admin.inv_report_generation') }}">Inventory Report</a>
                            <a class="dropdown-item @if ($page_open == 'inv_apt_generation') active @endif" href="{{ route('appointments.filter.form') }}">Appointment Report</a>
                        </div>
                    </li>
                    
                     
                      @endrole
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-4">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <span>Copyright &copy; {{ date('Y') }} <strong><a href="{{ route('home') }}">Saura Dental
                        Clinic</a></strong>.</span>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @yield('footer-script')

    <!-- jQuery -->
    {{-- <script src="plugins/jquery/jquery.min.js"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    {{-- <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script> --}}
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>


</body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#toggleLogout').on('click', function(event) {
        event.preventDefault();

        var url = "{{ route('logout') }}";
        $.ajax({
            type: "POST",
            url: url,
            success: function(response) {
                window.location.href = "/";
            }
        });
    });

    $(document).ready(function() {
        $('#toggleLogout').on('click', function(event) {
            event.preventDefault();

            var url = "{{ route('logout') }}";
            $.ajax({
                type: "POST",
                url: url,
                success: function(response) {
                    window.location.href = "/";
                }
            });
        });

        var url = "{{ route('appointment.getappointmentcounts') }}";

        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response);

                if (response.pending > 0) {
                    let count = response.pending;

                    if (count > 9) {
                        count = "9+";
                    }

                    $('#pending_tab').append('<span class="ms-2 rounded-pill bg-secondary px-2">' +
                        count + '</span>');
                }

                if (response.approve > 0) {
                    let count = response.approve;

                    if (count > 9) {
                        count = "9+";
                    }

                    $('#approve_tab').append('<span class="ms-2 rounded-pill bg-secondary px-2">' +
                        count + '</span>');
                }

                if (response.canceled > 0) {
                    let count = response.canceled;

                    if (count > 9) {
                        count = "9+";
                    }

                    $('#canceled_tab').append('<span class="ms-2 rounded-pill bg-secondary px-2">' +
                        count + '</span>');
                }

                if (response.completed > 0) {
                    let count = response.completed;

                    if (count > 9) {
                        count = "9+";
                    }

                    $('#completed_tab').append(
                        '<span class="ms-2 rounded-pill bg-secondary px-2">' +
                        count + '</span>');
                }

            }
        });
       
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Get all the navigation links
        var navLinks = document.querySelectorAll('.nav-link');

        // Add a click event listener to each link
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                // Remove the 'active' class from all links
                navLinks.forEach(function (navLink) {
                    navLink.classList.remove('active');
                });

                // Add the 'active' class to the clicked link
                link.classList.add('active');
            });
        });
    });
</script>


</html>
