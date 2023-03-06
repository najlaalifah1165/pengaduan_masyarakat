<!DOCTYPE html>
<html lang="en">

<?php
// SESSION
session_start();
include('config/database.php');
if (empty($_SESSION['username'])) {
    @header('location:index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    // print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($con, $q);
            if ($r) {
                move_uploaded_file($file_tmp, 'assets/images/masyarakat/' . $foto);
            }
            echo($q);
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($con, $q);
    }
}

// hapus pengaduan
if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($con, $q);
        $d = mysqli_fetch_object($r);
        unlink('assets/images/masyarakat/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($con, $q);
}

// rubah status pengaduan
if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($con, $q);
}
?>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                        <h4 class="text-themecolor">Pengaduan</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Pengaduan</li>
                            </ol>
                        </div>
                        <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                        <button data-toggle="modal" data-target="#modal-lg" class="btn btn-primary">Buat Pengaduan&nbsp;<i class="fa fa-pencil"></i></button>
                        <?php } ?>
                    </div>
                </div>

                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <!-- MODUL PENGADUAN -->
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaduan</h3><br>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Buat Pengaduan
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="nik" value="">
                                                    <div class="form-group">
                                                        <label for="isi_laporan">Isi Laporan</label>
                                                        <textarea name="isi_laporan" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                                                        <input type="date" name="tgl_pengaduan" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" name="foto" class="form-control">
                                                    </div>
                                                    <input type="submit" name="tambahPengaduan" value="simpan" class="btn btn-primary">
                                                </form>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dataTablesNya" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nik</th>
                                                <th>Isi Laporan</th>
                                                <th>Foto</th>
                                                <th>Status</th>
                                                <th>Hapus</th>
                                                <th>Proses Pengaduan</th>
                                            </tr>
                                        </thead>
                                        <?php  ?>
                                        <tbody>
                                            <?php
                                            if ($_SESSION['level'] == 'masyarakat') {
                                                $q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
                                            } else {
                                                $q = "SELECT * FROM `pengaduan`";
                                            }
                                            $r = mysqli_query($con, $q);
                                            $no = 1;
                                            while ($d = mysqli_fetch_object($r)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $d->tgl_pengaduan ?></td>
                                                    <td><?= $d->nik ?></td>
                                                    <td><?= $d->isi_laporan ?></td>
                                                    <td><?php if ($d->foto == '') {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="assets/images/no-foto.png">';
                                                        } else {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="assets/images/masyarakat/' . $d->foto . '">';
                                                        } ?></td>
                                                    <td><?= $d->status ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                                                            <form action="" method="post"><input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>"><button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if ($_SESSION['level'] == 'petugas') { ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
                                                                <select class="form-control" name="status">
                                                                    <option value="0"> 0 </option>
                                                                    <option value="proses"> proses </option>
                                                                    <option value="selesai"> selesai </option>
                                                                </select><br>
                                                                <button type="submit" name="proses_pengaduan" class="btn btn-primary form-control">ubah</button>
                                                            </form>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
</div> 
</div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2023 SISTEM PENGADUAN MASYARAKAT
        </footer>

    <?php include('assets/footer.php') ?>
</body>

</html>