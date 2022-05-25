<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo tab browser.ico') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app_content.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style type="text/css">
        {{-- Datepicker CSS --}} .datepicker td,
        .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker {
            margin-bottom: 1rem;
        }

        .datepicker-dropdown {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .isDisabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
        }

        .collapse-inner {
            background-color: rgb(245, 229, 187) !important;
        }

    </style>
    @yield('css')


</head>

<body id="page-top" class="___class_+?0___">
    {{-- <body id="page-top" class="sidebar-toggled"> --}}

    <!-- Page Wrapper -->
    <div id="wrapper">
        @if (Auth::check())

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar"
                style="">

                {{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar"
                style=""> --}}

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2 mx-2"
                    href="{{ route('home') }}">
                    <div class="sidebar-brand-icon rotate-n-15 ml-1">
                        <img src="{{ asset('img/0904 - LP png (18).png') }}" alt="no image" width="120" height="35">
                        {{-- <i class="far fa-file-alt"></i> --}}
                    </div>
                    {{-- <div class="sidebar-brand-text mx-3">Rento</div> --}}
                </a>

                <!-- Divider -->
                {{-- <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider"> --}}

                <!-- Heading -->
                {{-- <div class="sidebar-heading">
                Interface
            </div> --}}



                <!-- Nav Item - Pages Collapse Menu -->
                {{-- @can('house-list') --}}
                {{-- @hasanyrole('Owner|Tenant') --}}
                <li class="nav-item @if (strpos(Request::url(), 'house') !== false) {{ 'active' }} @endif pt-4">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-home"></i>
                        <span>Rumah</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style=" ">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            @role('Owner')
                            <a class="collapse-item" href="{{ route('house.create') }}"
                                style="color: black;">Maklumat
                                Rumah Baru</a>
                            @endrole
                            @role('Admin')
                            <a class="collapse-item" href="{{ route('house.index') }}" style="color: black;">Senarai
                                Pemilik
                                Rumah</a>
                        @else
                            <a class="collapse-item" href="{{ route('house.index') }}" style="color: black;">Senarai
                                Rumah</a>
                            @endrole

                        </div>
                    </div>
                </li>
                {{-- @endhasanyrole --}}
                {{-- @endcan --}}

                <!-- Nav Item - Utilities Collapse Menu -->
                @hasanyrole('Admin|Staf|Owner')
                <li class="nav-item @if (strpos(Request::url(), 'sop') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSOP"
                        aria-expanded="true" aria-controls="collapseSOP">
                        <i class="fas fa-thumbtack"></i>
                        <span>SOP BURS</span>
                    </a>
                    <div id="collapseSOP" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            <a class="collapse-item" href="{{ route('sop.index') }}" style="color: black;">Senarai
                                SOP</a>
                        </div>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Owner|Tenant')
                <li class="nav-item @if (strpos(Request::url(), 'tickets') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAduan"
                        aria-expanded="true" aria-controls="collapseAduan">
                        <i class="fas fa-comments"></i>
                        <i class="far fa-frown"></i>
                        <span>Aduan</span>
                    </a>
                    <div id="collapseAduan" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            @role('Tenant')
                            <a class="collapse-item" href="{{ route('tickets.create') }}" style="color: black;">Buat
                                Aduan</a>
                            @endrole
                            @hasanyrole('Owner|Tenant')
                            <a class="collapse-item" href="{{ route('tickets.index') }}"
                                style="color: black;">Senarai
                                Aduan</a>
                            @endhasanyrole
                        </div>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Admin|Owner')
                <li class="nav-item @if (strpos(Request::url(), 'todos') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="{{ route('todos.index') }}">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>To Do List</span>
                    </a>
                </li>
                @endhasanyrole


                @hasanyrole('Owner|Tenant')
                <li class="nav-item @if (strpos(Request::url(), 'announcement') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnnouncement"
                        aria-expanded="true" aria-controls="collapseAnnouncement">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span>Hebahan</span>
                    </a>
                    <div id="collapseAnnouncement" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            {{-- @role('Owner')
                        <a class="collapse-item" href="{{ route('announcement.create') }}" style="color: black;">Buat
                            Hebahan Baru</a>
                        @endrole --}}
                            @hasanyrole('Owner|Tenant')
                            <a class="collapse-item" href="{{ route('announcement.index') }}"
                                style="color: black;">Senarai
                                Hebahan</a>
                            @endhasanyrole
                        </div>
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Admin|Staf|Owner')
                <li class="nav-item @if (strpos(Request::url(), 'notes') != false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="{{ route('notes.index') }}">
                        <i class="fas fa-sticky-note"></i>
                        <span>Nota</span>
                    </a>
                </li>
                @endhasanyrole


                @unlessrole('Tenant')

                {{-- {{ strpos(Request::path(), 'user') }} --}}
                {{-- {{ Request::is('user/*') }} --}}
                <li class="nav-item @if (Request::is('user/*')) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="{{ route('users.index') }}" data-toggle="collapse"
                        data-target="#manage_user_menu" aria-expanded="true" aria-controls="manage_user_menu">
                        <i class="fas fa-user-shield"></i>
                        <span>Pengguna</span>
                    </a>
                    <div id="manage_user_menu" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            @role('Super Admin')
                            <a class="collapse-item" href="{{ route('useradmin') }}" style="color: black;">Senarai
                                Semua
                                Pengguna</a>
                            @endrole
                            @can('staf-list')
                                <a class="collapse-item" href="{{ route('userstaf') }}" style="color: black;">Senarai
                                    Admin /
                                    Staf</a>
                            @endcan
                            @can('owner-list')
                                <a class="collapse-item" href="{{ route('userowner') }}" style="color: black;">Senarai
                                    Pemilik Rumah</a>
                            @endcan
                            @can('tenant-list')
                                <a class="collapse-item" href="{{ route('usertenant') }}" style="color: black;">Senarai
                                    Penyewa</a>
                            @endcan
                        </div>
                    </div>
                </li>
                @endunlessrole

                {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('products.index') }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Product</span>
                </a>
            </li> --}}
                @role('Super Admin')
                <li class="nav-item @if (strpos(Request::url(), 'roles') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="{{ route('roles.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <span>Role</span>
                    </a>
                </li>
                <li class="nav-item @if (strpos(Request::url(), 'permissions') !== false) {{ 'active' }} @endif">
                    <a class="nav-link collapsed" href="{{ route('permissions.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <span>Permission</span>
                    </a>
                </li>
                @endrole

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                {{-- <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div> --}}


            </ul>
            <!-- End of Sidebar -->
        @endif
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}
                    @if (Auth::check())
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            {{-- Notification --}}

                            @php
                                // $total_noti = count($todoLists_pending) + count($new_announcement) + count($global_all_to_expired);

                                $total_noti = 0;
                                if (!empty($todoLists_pending)) {
                                    $total_noti += count($todoLists_pending);
                                }
                                // echo $total_noti;
                                if (!empty($new_announcement)) {
                                    $total_noti += count($new_announcement);
                                }
                                // echo $total_noti;
                                if (!empty($global_all_to_expired)) {
                                    $total_noti += count($global_all_to_expired);
                                }
                                // echo $total_noti;
                                if (!empty($new_tickets)) {
                                    $total_noti += count($new_tickets);
                                }
                                // echo $total_noti;
                            @endphp

                            @hasanyrole('Owner')
                            @if (!empty($new_sops))
                                @php $total_noti += count($new_sops); @endphp
                            @endif
                            @endhasanyrole



                            @hasanyrole('Tenant')
                            @if (!empty($new_ticketreplies))
                                @php $total_noti += count($new_ticketreplies); @endphp
                            @endif
                            @endhasanyrole

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1" >
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="font-size: 1.3rem">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">
                                        @role('Staf|Owner|Tenant') {{ $total_noti }} @endrole
                                    </span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown" style="height: 500px; overflow-y: scroll;">
                                    <h6 class="dropdown-header">
                                        Notifikasi
                                    </h6>
                                    @role('Staf|Owner')
                                    @if(count($global_all_to_expired)>0)
                                    <a class="dropdown-item d-flex align-items-center" href="/user/tenant">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                            <span class="font-weight-bold"> Terdapat
                                                {{ count($global_all_to_expired) }} akaun @hasanyrole('Admin|Staf')
                                                pengguna @endhasanyrole @hasanyrole('Owner') penyewa
                                                @endhasanyrole akan tamat tempoh
                                                kurang {{ $days_before_expired }} hari </span>

                                        </div>
                                    </a>
                                    @endif
                                    @endrole
                                    @hasanyrole('Owner')
                                    @foreach ($new_sops as $sop)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('sop.index') }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-head-side-mask text-white"></i>

                                                </div>
                                            </div>
                                            <div>
                                                {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                                <span class="___class_+?92___">SOP <span
                                                        class="font-weight-bold">{{ $sop->sop_name }}</span>&nbsp;masih
                                                    belum dilihat.
                                                </span>

                                            </div>
                                        </a>
                                    @endforeach

                                    @foreach ($todoLists_pending as $pending)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('todos.index') }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-briefcase text-white"></i>

                                                </div>
                                            </div>
                                            <div>
                                                {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                                <span class="___class_+?85___">Sub-tugasan <span
                                                        class="font-weight-bold">{{ $pending->tasks }}</span> di
                                                    dalam tugasan <span
                                                        class="font-weight-bold">{{ $pending->title }}</span> masih
                                                    belum disiapkan, sila
                                                    kemaskini jika sudah selesai.
                                                </span>

                                            </div>
                                        </a>
                                    @endforeach

                                    @foreach ($new_tickets as $ticket)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('tickets.index') }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-comments text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                                <span class="___class_+?92___">Aduan <span
                                                        class="font-weight-bold">{{ $ticket->title }}</span>
                                                    bernombor <span
                                                        class="font-weight-bold">{{ $ticket->ticket_number }}</span>
                                                    masih belum dilihat.
                                                </span>

                                            </div>
                                        </a>
                                    @endforeach
                                    @endhasanyrole

                                    @hasanyrole('Tenant')
                                    @if (is_array($new_announcement) || is_object($new_announcement))

                                        @foreach ($new_announcement as $ann)
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('announcement.index') }}">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-secondary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                                    <span class="___class_+?99___">Anda ada hebahan baru minggu ini
                                                        bertajuk <span
                                                            class="font-weight-bold">{{ $ann->title }}</span>
                                                    </span>

                                                </div>
                                            </a>
                                        @endforeach
                                    @endif

                                    @foreach ($new_ticketreplies as $ticketreply)
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('tickets.index') }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                                                <span class="___class_+?92___">Aduan <span
                                                        class="font-weight-bold">{{ $ticketreply->title }}</span>
                                                    bernombor <span
                                                        class="font-weight-bold">{{ $ticketreply->ticket_number }}</span>
                                                    telah dibalas.
                                                </span>

                                            </div>
                                        </a>
                                    @endforeach
                                    @endhasanyrole
                                    {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> --}}
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            {{-- <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('img/undraw_profile_1.svg') }}"
                                                alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with
                                                a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('img/undraw_profile_2.svg') }}"
                                                alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month,
                                                how
                                                would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('img/undraw_profile_3.svg') }}"
                                                alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy
                                                with
                                                the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because
                                                someone
                                                told me that people say this to all dogs, even if they aren't good...
                                            </div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                        Messages</a>
                                </div>
                            </li> --}}

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        @if (Auth::check()) {{ Auth::user()->name }}
                                        @endif
                                    </span><i class="fa-2x fas fa-home" aria-hidden="true"
                                        style="color: rgb(63, 55, 10);"></i>
                                    {{-- <img class="img-profile rounded-circle"
                                        src="{{ asset('img/undraw_profile.svg') }}"> --}}
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    {{-- <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a> --}}
                                    <a class="dropdown-item" href="{{ route('change_password') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Tukar Kata Laluan
                                    </a>
                                    <a class="isDisabled dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Log Keluar
                                    </a>
                                </div>
                            </li>

                        </ul>
                    @endif
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <main class="py-0">
                    @yield('content')
                </main>
                {{-- <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> --}}
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white" style="clear: both;
            position: relative;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MI Appninjo 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda pasti untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Ya" sekiranya anda pasti.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Ya</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    {{-- Datepicker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/533ac5f84b.js" crossorigin="anonymous"></script>

    @yield('js')





</body>

</html>
