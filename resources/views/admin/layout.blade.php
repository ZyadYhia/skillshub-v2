<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <title>SkillsHub - {{ __('web.dashboard') }}</title>
    @if (App::getLocale() == 'ar')
        <style>
            html {
                direction: rtl;
            }
        </style>
    @else
        <style>
            html {
                direction: ltr;
            }
        </style>
    @endif

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/css/fontawesome.all.css') }}" />
    <!-- Select2 style -->
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav
            class="
                        main-header
                        navbar navbar-expand navbar-white navbar-light
                    ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="badge badge-warning navbar-badge">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">

                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="dropdown-item dropdown-header">
                                {{ Auth::user()->unreadNotifications->count() }} Notifications
                            </span>
                        @endif
                        <div class="dropdown-divider"></div>
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $notification->data['subject'] }}
                                <span class="float-right text-muted text-sm">
                                    {{ $notification->created_at->diffForHumans(\Carbon\Carbon::now()) }}
                                </span>
                            </a>
                        @endforeach
                        {{-- <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div> --}}
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('admin/img/user-profile.jpg') }}" class="img-circle elevation-2"
                            alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin user</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @role('superadmin')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/roles') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('dashboard/permissions') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('dashboard/categories') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ url('dashboard/skills') }}" class="nav-link">
                                <i class="nav-icon fas fa-brain"></i>
                                <p>Skills</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard/exams') }}" class="nav-link">
                                <i class="nav-icon far fa-clipboard"></i>
                                <p>Exams</p>
                            </a>
                        </li>
                        @role('superadmin')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/admins') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ url('dashboard/students') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard/messages') }}" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('main')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019
                <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/js/bootstrap.bundle.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/js/adminlte.js') }}"></script>
    <!-- Select2 App -->
    <script src="{{ asset('admin/js/select2.full.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
