<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $title; ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/CMS/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Custom fonts for this template-->
        <link href="<?= base_url() ?>assets/CMS/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?= base_url() ?>assets/CMS/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="<?= base_url(); ?>assets/CMS/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/CMS/vendor/datatables/responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/CMS/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>Dashboard">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"><?= $this->session->userdata('company_name'); ?></div>
                </a>

                <hr class="sidebar-divider my-0">

                <div class="sidebar-heading">
                    Navigation
                </div>
                <li class="nav-item <?php if($this->uri->segment(1) == 'Dashboard') {echo 'active';}; ?>">
                    <a class="nav-link" href="<?= base_url() ?>Dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("Home").'" target="_blank"' : '' ;?>>
                        <i class="fas fa-fw fa-home"></i>
                        <span>Client View</span></a>
                </li>
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Information
                </div>

                <li class="nav-item <?php if($this->uri->segment(1) == 'Carousel') {echo 'active';}; ?>">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("Carousel").'"' : '' ;?>>
                        <i class="fas fa-fw fa-file-image"></i>
                        <span>Data Carousel</span></a>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'Event') {echo 'active';}; ?>">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("Event").'"' : '' ;?>>
                        <i class="fas fa-fw fa-info-circle"></i>
                        <span>Data Event</span></a>
                </li>
                <?php if ($this->session->userdata('role') == 'owner'):?>
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Control Settings
                </div>
                <li class="nav-item <?php if($this->uri->segment(1) == 'User_management') {echo 'active';}; ?>">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("User_management").'"' : '' ;?>>
                        <i class="fas fa-fw fa-users"></i>
                        <span>Employee Account Management</span></a>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'Company_management') {echo 'active';}; ?>">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("Company_management").'"' : '' ;?>>
                        <i class="fas fa-fw fa-building"></i>
                        <span>Company Management</span></a>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'Client_view_management') {echo 'active';}; ?>">
                    <a class="nav-link" <?= $this->session->userdata('validity') >= date('Y-m-d') ? 'href="'.base_url("Client_view_management").'"' : '' ;?>>
                        <i class="fas fa-fw fa-desktop"></i>
                        <span>Client View Management</span></a>
                </li>
                <?php endif; ?>
                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Pricing
                </div>
                
                <li class="nav-item <?php if($this->uri->segment(1) == 'Price' && $this->uri->segment(2) == '') {echo 'active';}; ?>">
                    <a class="nav-link" href="<?= base_url("Price") ?>">
                        <i class="fas fa-fw fa-wallet"></i>
                        <span>Price</span></a>
                </li>

                <li class="nav-item <?php if($this->uri->segment(2) == 'redeem') {echo 'active';}; ?>">
                    <a class="nav-link" href="<?= base_url("Price/redeem") ?>">
                        <i class="fas fa-fw fa-ticket-alt"></i>
                        <span>Use Token</span></a>
                </li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('nama_user'); ?></span>
                                    <?php if($this->session->userdata('profile_picture') == null): ?>
                                        <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/CMS/img/default_user.webp">
                                    <?php else: ?>
                                        <img class="img-profile rounded-circle" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name')?>/user/<?= $this->session->userdata('username')?>/<?= $this->session->userdata('profile_picture') ?>">
                                    <?php endif; ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="<?= base_url() ?>User_account">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <?php 
                            $success = $this->session->flashdata('success');
                            $failed = $this->session->flashdata('failed');

                            if (!empty($failed)) {
                                echo '
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-times-circle"></i> '.$failed.'
                                    </div>
                                ';
                            }

                            if (!empty($success)) {
                                echo '
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-check-circle"></i> '.$success.'
                                    </div>
                                ';
                            }
                        ?>

                        <?php $this->load->view($main_view);?>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Sistem Mading Digital 2020</span>
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
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url() ?>Auth/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url() ?>assets/CMS/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/CMS/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url() ?>assets/CMS/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url() ?>assets/CMS/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/CMS/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url(); ?>assets/CMS/vendor/gijgo/js/gijgo.min.js"></script>
        <?php $this->load->view($JSON); ?>
    </body>

</html>
