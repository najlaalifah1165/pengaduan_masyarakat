<!DOCTYPE html>
<html lang="en">

<?php
// SESSION
session_start();
include('config/database.php');
if (empty($_SESSION['username'])) {
    @header('location:index.php');
}

?>

<head>

<!-- HEADER -->
    <?php include('assets/header.php') ?>

</head>
<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">SIPEMAS</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                                href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="assets/images/user2.png " alt="user" class="img-circle" width="30"
                                    class="d-block"><b><?= $_SESSION['username'] ?></b></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        
        <!-- MENU -->
        <?php include('menu.php') ?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Petugas</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="profile.php">Home</a></li>
                                <li class="breadcrumb-item active">Petugas</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <div class="alert alert-success alert-dismissable">Selamat Datang <strong><?= $_SESSION['username'] ?></strong> anda Login Sebagai <strong><?= $_SESSION['level'] ?></strong> <a class="close" href="" data-dismiss="alert">x</a></div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Petugas</h3>

                            </div>
                            <div class="card-body">
                                <table id="dataTablesNya" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Petugas</th>
                                            <th>Username</th>
                                            <th>Telp</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $q = mysqli_query($con, "SELECT * FROM `petugas`");
                                        $no = 1;
                                        while ($d = mysqli_fetch_object($q)) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $d->nama_petugas ?></td>
                                                <td><?= $d->username ?></td>
                                                <td><?= $d->telp ?></td>
                                                <td><?= $d->level ?></td>
                                            </tr>

                                        <?php $no++;
                                        }
                                        ?>
                                    </tbody>
                                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                    </div>
                                    </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->



        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2023 SISTEM PENGADUAN MASYARAKAT
        </footer>
    <?php include('assets/footer.php') ?>
    
</body>

</html>