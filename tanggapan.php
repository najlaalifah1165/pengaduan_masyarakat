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
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}
// tambah tanggapan
if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($con, $q);
}
// hapus tanggapan
if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($con, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan =  $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($con, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
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
                        <h4 class="text-themecolor">Tanggapan</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Tanggapan</li>
                            </ol>
                        </div>
                        <?php if ($_SESSION['level'] == 'admin') { ?>
                        <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Tanggapan</button>
                        <?php } ?>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <!-- MODUL TANGGAPAN -->
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Tabel Tanggapan <br>
                        <!-- modal start -->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Tambah Tanggapan
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <label for="id_pengaduan"> Pilih Id Pengaduan</label>
                                            <select name="id_pengaduan" class="form-control">
                                                <?php
                                                $q = "SELECT * FROM pengaduan JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik";
                                                $r = mysqli_query($con, $q);
                                                while ($d = mysqli_fetch_object($r)) { ?>
                                                    <option value="<?= $d->id_pengaduan ?>"><?= $d->id_pengaduan . '|' . $d->nik . '|' . $d->nama ?></option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <label for="tgl_tanggapan">Tanggal</label>
                                            <input class="form-control" type="date" name="tgl_tanggapan">
                                            <label for="tanggapan">Beri Tanggapan</label>
                                            <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"></textarea>
                                            <label for="id_petugas">ID Petugas</label>
                                            <input name="id_petugas" type="text" class="form-control" value="<?= $id_petugas ?>" readonly>
                                            <br>
                                            <button name="tambah_tanggapan" type="submit" class="btn btn-info">simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal ends -->
                    </div>
                    <div class="card-body">
                        <table id="dataTablesNya" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Pengaduan</th>
                                    <th>tanggal Tanggapan</th>
                                    <th>Isi Tanggapan</th>
                                    <th>Petugas</th>
                                    <th>Hapus</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $q = "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan`
                             WHERE tanggapan.id_petugas = petugas.id_petugas 
                             AND tanggapan.id_pengaduan = pengaduan.id_pengaduan";
                                $r = mysqli_query($con, $q);
                                while ($d = mysqli_fetch_object($r)) { ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $d->id_pengaduan ?>
                                        </td>
                                        <td>
                                            <?= $d->tgl_tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->nama_petugas ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <form action="" method="post"><input type="hidden" name="id_tanggapan" value="<?= $d->id_tanggapan ?>"><button name="hapusTanggapan" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i>&nbsp;hapus</button></form>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg<?= $d->id_pengaduan ?>" class="btn btn-success"><i class="fa fa-pen"></i>&nbsp;Edit</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-lg<?= $d->id_pengaduan ?>">
                                        <div class="modal-dialog modal-lg<?= $d->id_pengaduan ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Edit Pengaduan
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input class="form-control" name="id_tanggapan" type="hidden" value="<?= $d->id_tanggapan ?>">
                                                        <label for="id_pengaduan">ID Pengaduan</label><br>
                                                        <select class="form-control" name="id_pengaduan">
                                                            <?php
                                                            $result = mysqli_query($con, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                            while ($data = mysqli_fetch_object($result)) { ?>
                                                                <option value="<?= $data->id_pengaduan ?>" <?php if ($d->id_pengaduan == $data->id_pengaduan) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $data->id_pengaduan . '|' . $data->nik . '|' . $data->nama ?></option>
                                                            <?php } ?>
                                                        </select><br>
                                                        <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                                        <input class="form-control" name="tgl_tanggapan" class="form-control" type="date" name="" value="<?= $d->tgl_tanggapan ?>">
                                                        <label for="tanggapan">Tanggapan</label>
                                                        <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"><?= $d->tanggapan ?></textarea>
                                                        <br>
                                                        <button name="ubahTanggapan" type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
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
    </div>
    <?php include('assets/footer.php') ?>
</body>

</html>