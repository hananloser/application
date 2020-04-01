<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyData-APP | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Datatable -->
  <link rel=" stylesheet" href="<?php echo base_url('assets/') ?>DataTables/DataTables/css/dataTables.bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel=" stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/mdb/mdb.lite.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Theme style Customs-->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>customs/style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.css">

  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/sweetalert2/sweetalert2.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>




<!---->

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <a href="index3.html" class="brand-link text-center">
        <span class="brand-text font-weight-light "><strong>
            <h3>MyData-APP</h3>
          </strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $this->fungsi->user_login()->user_company_name ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Dashboard Menu
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if ($this->session->userdata('level') == 1) { ?>
                  <li class="nav-item">
                    <a href="<?= site_url('dashboard/manage_user') ?>" class="nav-link">
                      <i class="fas fa-users-cog nav-icon"></i>
                      <p>Manage User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('dashboard/manage_data') ?>" class="nav-link">
                      <i class="fas fa-database nav-icon"></i>
                      <p>Manage Database</p>
                    </a>
                  </li>
                <?php } ?>
                <!--sesi ini membatasi hak akses user, cek kode pada controller auth/login, periksa juga pada helper-->
                <?php if ($this->session->userdata('level') == 2) { ?>
                  <li class="nav-item">
                    <a href="<?= site_url('dashboard/go_upload') ?>" class="nav-link">
                      <i class="fas fa-upload nav-icon"></i>
                      <p>Upload Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('dashboard/view_list') ?>" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>View list</p>
                    </a>
                  </li>
                <?php } ?>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Account</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= site_url('auth/logout') ?>" class="nav-link">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>Log-out</p>
                  </a>
                </li>
              </ul>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- jQuery datatables -->
    <script src="<?php echo base_url('assets/') ?>DataTables/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>DataTables/DataTables/js/datatables.bootstrap4.min.js"></script>
    <!-- ChartJS -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">MyData-APP</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!--###-->
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->

  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets/') ?>DataTables/DataTables/js/jquery.dataTables.js"></script>
  <script src="<?php echo base_url('assets/') ?>DataTables/DataTables/js/datatables.bootstrap4.min.js"></script>
  <!-- jQuery datatables -->
  <script src="<?php echo base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->


  <script src="<?php echo base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <!-- JQVMap -->
  <script src="<?php echo base_url('assets/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/sparklines/sparkline.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/') ?>plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/pdfmake/pdfmake.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/') ?>dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url('assets/') ?>dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/') ?>dist/js/demo.js"></script>
  <!-- sweetalert -->
  <script src="<?php echo base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Cek Error
      <?php if ($this->session->flashdata('error')) { ?>
        Swal.fire({
          icon: 'error',
          title: 'Row in Excel is Null Or Empty Field',
          text: <?= $this->session->flashdata('error') ?>,
        })
      <?php } ?>
      // Jika Success 
      <?php if ($this->session->flashdata('success')) { ?>
        Swal.fire({
          icon: 'error',
          title: 'Data is Success inserting',
          text: <?= $this->session->flashdata('success') ?>,
        })
      <?php } ?>
    });
  </script>
</body>

</html>