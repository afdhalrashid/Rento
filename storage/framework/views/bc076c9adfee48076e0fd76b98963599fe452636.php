<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="icon" href="<?php echo e(asset('img/logo tab browser.ico')); ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">


    <!-- Styles -->
    <link href="<?php echo e(asset('css/app_content.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style type="text/css">
         .datepicker td,
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
    <?php echo $__env->yieldContent('css'); ?>


</head>

<body id="page-top" class="___class_+?0___">
    

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php if(Auth::check()): ?>

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar"
                style="">

                

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2 mx-2"
                    href="<?php echo e(route('home')); ?>">
                    <div class="sidebar-brand-icon rotate-n-15 ml-1">
                        <img src="<?php echo e(asset('img/0904 - LP png (18).png')); ?>" alt="no image" width="120" height="35">
                        
                    </div>
                    
                </a>

                <!-- Divider -->
                

                <!-- Heading -->
                



                <!-- Nav Item - Pages Collapse Menu -->
                
                
                <li class="nav-item <?php if(strpos(Request::url(), 'house') !== false): ?> <?php echo e('active'); ?> <?php endif; ?> pt-4">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-home"></i>
                        <span>Rumah</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style=" ">
                            
                            <?php if(auth()->check() && auth()->user()->hasRole('Owner')): ?>
                            <a class="collapse-item" href="<?php echo e(route('house.create')); ?>"
                                style="color: black;">Maklumat
                                Rumah Baru</a>
                            <?php endif; ?>
                            <?php if(auth()->check() && auth()->user()->hasRole('Admin')): ?>
                            <a class="collapse-item" href="<?php echo e(route('house.index')); ?>" style="color: black;">Senarai
                                Pemilik
                                Rumah</a>
                        <?php else: ?>
                            <a class="collapse-item" href="<?php echo e(route('house.index')); ?>" style="color: black;">Senarai
                                Rumah</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
                
                

                <!-- Nav Item - Utilities Collapse Menu -->
                <?php if(auth()->check() && auth()->user()->hasAnyRole('Admin|Staf|Owner')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'sop') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSOP"
                        aria-expanded="true" aria-controls="collapseSOP">
                        <i class="fas fa-thumbtack"></i>
                        <span>SOP BURS</span>
                    </a>
                    <div id="collapseSOP" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            <a class="collapse-item" href="<?php echo e(route('sop.index')); ?>" style="color: black;">Senarai
                                SOP</a>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner|Tenant')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'tickets') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAduan"
                        aria-expanded="true" aria-controls="collapseAduan">
                        <i class="fas fa-comments"></i>
                        <i class="far fa-frown"></i>
                        <span>Aduan</span>
                    </a>
                    <div id="collapseAduan" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            
                            <?php if(auth()->check() && auth()->user()->hasRole('Tenant')): ?>
                            <a class="collapse-item" href="<?php echo e(route('tickets.create')); ?>" style="color: black;">Buat
                                Aduan</a>
                            <?php endif; ?>
                            <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner|Tenant')): ?>
                            <a class="collapse-item" href="<?php echo e(route('tickets.index')); ?>"
                                style="color: black;">Senarai
                                Aduan</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasAnyRole('Admin|Owner')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'todos') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(route('todos.index')); ?>">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>To Do List</span>
                    </a>
                </li>
                <?php endif; ?>


                <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner|Tenant')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'announcement') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnnouncement"
                        aria-expanded="true" aria-controls="collapseAnnouncement">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span>Hebahan</span>
                    </a>
                    <div id="collapseAnnouncement" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            
                            
                            <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner|Tenant')): ?>
                            <a class="collapse-item" href="<?php echo e(route('announcement.index')); ?>"
                                style="color: black;">Senarai
                                Hebahan</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasAnyRole('Admin|Staf|Owner')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'notes') != false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(route('notes.index')); ?>">
                        <i class="fas fa-sticky-note"></i>
                        <span>Nota</span>
                    </a>
                </li>
                <?php endif; ?>


                <?php if(!auth()->check() || ! auth()->user()->hasRole('Tenant')): ?>

                
                
                <li class="nav-item <?php if(Request::is('user/*')): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(route('users.index')); ?>" data-toggle="collapse"
                        data-target="#manage_user_menu" aria-expanded="true" aria-controls="manage_user_menu">
                        <i class="fas fa-user-shield"></i>
                        <span>Pengguna</span>
                    </a>
                    <div id="manage_user_menu" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded" style="background-color: rgb(218, 182, 87); ">
                            <?php if(auth()->check() && auth()->user()->hasRole('Super Admin')): ?>
                            <a class="collapse-item" href="<?php echo e(route('useradmin')); ?>" style="color: black;">Senarai
                                Semua
                                Pengguna</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staf-list')): ?>
                                <a class="collapse-item" href="<?php echo e(route('userstaf')); ?>" style="color: black;">Senarai
                                    Admin /
                                    Staf</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('owner-list')): ?>
                                <a class="collapse-item" href="<?php echo e(route('userowner')); ?>" style="color: black;">Senarai
                                    Pemilik Rumah</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tenant-list')): ?>
                                <a class="collapse-item" href="<?php echo e(route('usertenant')); ?>" style="color: black;">Senarai
                                    Penyewa</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                
                <?php if(auth()->check() && auth()->user()->hasRole('Super Admin')): ?>
                <li class="nav-item <?php if(strpos(Request::url(), 'roles') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(route('roles.index')); ?>">
                        <i class="fas fa-user-shield"></i>
                        <span>Role</span>
                    </a>
                </li>
                <li class="nav-item <?php if(strpos(Request::url(), 'permissions') !== false): ?> <?php echo e('active'); ?> <?php endif; ?>">
                    <a class="nav-link collapsed" href="<?php echo e(route('permissions.index')); ?>">
                        <i class="fas fa-user-shield"></i>
                        <span>Permission</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                


            </ul>
            <!-- End of Sidebar -->
        <?php endif; ?>
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
                    
                    <?php if(Auth::check()): ?>
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

                            

                            <?php
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
                            ?>

                            <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner')): ?>
                            <?php if(!empty($new_sops)): ?>
                                <?php $total_noti += count($new_sops); ?>
                            <?php endif; ?>
                            <?php endif; ?>



                            <?php if(auth()->check() && auth()->user()->hasAnyRole('Tenant')): ?>
                            <?php if(!empty($new_ticketreplies)): ?>
                                <?php $total_noti += count($new_ticketreplies); ?>
                            <?php endif; ?>
                            <?php endif; ?>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1" >
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="font-size: 1.3rem">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">
                                        <?php if(auth()->check() && auth()->user()->hasRole('Staf|Owner|Tenant')): ?> <?php echo e($total_noti); ?> <?php endif; ?>
                                    </span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown" style="height: 500px; overflow-y: scroll;">
                                    <h6 class="dropdown-header">
                                        Notifikasi
                                    </h6>
                                    <?php if(auth()->check() && auth()->user()->hasRole('Staf|Owner')): ?>
                                    <?php if(count($global_all_to_expired)>0): ?>
                                    <a class="dropdown-item d-flex align-items-center" href="/user/tenant">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            
                                            <span class="font-weight-bold"> Terdapat
                                                <?php echo e(count($global_all_to_expired)); ?> akaun <?php if(auth()->check() && auth()->user()->hasAnyRole('Admin|Staf')): ?>
                                                pengguna <?php endif; ?> <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner')): ?> penyewa
                                                <?php endif; ?> akan tamat tempoh
                                                kurang <?php echo e($days_before_expired); ?> hari </span>

                                        </div>
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(auth()->check() && auth()->user()->hasAnyRole('Owner')): ?>
                                    <?php $__currentLoopData = $new_sops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="<?php echo e(route('sop.index')); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-head-side-mask text-white"></i>

                                                </div>
                                            </div>
                                            <div>
                                                
                                                <span class="___class_+?92___">SOP <span
                                                        class="font-weight-bold"><?php echo e($sop->sop_name); ?></span>&nbsp;masih
                                                    belum dilihat.
                                                </span>

                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $todoLists_pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="<?php echo e(route('todos.index')); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-briefcase text-white"></i>

                                                </div>
                                            </div>
                                            <div>
                                                
                                                <span class="___class_+?85___">Sub-tugasan <span
                                                        class="font-weight-bold"><?php echo e($pending->tasks); ?></span> di
                                                    dalam tugasan <span
                                                        class="font-weight-bold"><?php echo e($pending->title); ?></span> masih
                                                    belum disiapkan, sila
                                                    kemaskini jika sudah selesai.
                                                </span>

                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $new_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="<?php echo e(route('tickets.index')); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-comments text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                
                                                <span class="___class_+?92___">Aduan <span
                                                        class="font-weight-bold"><?php echo e($ticket->title); ?></span>
                                                    bernombor <span
                                                        class="font-weight-bold"><?php echo e($ticket->ticket_number); ?></span>
                                                    masih belum dilihat.
                                                </span>

                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php if(auth()->check() && auth()->user()->hasAnyRole('Tenant')): ?>
                                    <?php if(is_array($new_announcement) || is_object($new_announcement)): ?>

                                        <?php $__currentLoopData = $new_announcement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ann): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="<?php echo e(route('announcement.index')); ?>">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-secondary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    
                                                    <span class="___class_+?99___">Anda ada hebahan baru minggu ini
                                                        bertajuk <span
                                                            class="font-weight-bold"><?php echo e($ann->title); ?></span>
                                                    </span>

                                                </div>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $new_ticketreplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticketreply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="<?php echo e(route('tickets.index')); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                
                                                <span class="___class_+?92___">Aduan <span
                                                        class="font-weight-bold"><?php echo e($ticketreply->title); ?></span>
                                                    bernombor <span
                                                        class="font-weight-bold"><?php echo e($ticketreply->ticket_number); ?></span>
                                                    telah dibalas.
                                                </span>

                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        <?php if(Auth::check()): ?> <?php echo e(Auth::user()->name); ?>

                                        <?php endif; ?>
                                    </span><i class="fa-2x fas fa-home" aria-hidden="true"
                                        style="color: rgb(63, 55, 10);"></i>
                                    
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    
                                    <a class="dropdown-item" href="<?php echo e(route('change_password')); ?>">
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
                    <?php endif; ?>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <main class="py-0">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
                
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
                    <a class="btn btn-primary" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Ya</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/master.js')); ?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    
    <script src="https://kit.fontawesome.com/533ac5f84b.js" crossorigin="anonymous"></script>

    <?php echo $__env->yieldContent('js'); ?>





</body>

</html>
<?php /**PATH F:\Projects\LaravelProject\Rento\System\rento\resources\views/layouts/app.blade.php ENDPATH**/ ?>