<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="ti-menu"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                            <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                        <li> <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false">
                            <i class="fa fa-vcard-o"></i><span class="hide-menu">Profile</span></a></li>
                            <?php } ?>

                            <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li> <a class="waves-effect waves-dark" href="masyarakat.php" aria-expanded="false">
                            <i class="fa fa-users"></i><span class="hide-menu">Masyarakat</span></a></li>
                            <?php } ?>

                            <?php if ($_SESSION['level'] == 'admin') { ?>
                        <li> <a class="waves-effect waves-dark" href="petugas.php" aria-expanded="false">
                            <i class="fa fa-user-circle-o"></i><span class="hide-menu"></span>Petugas</a></li>
                            <?php } ?>

                        <li> <a class="waves-effect waves-dark" href="pengaduan.php" aria-expanded="false">
                            <i class="fa fa-exclamation"></i><span class="hide-menu"></span>Pengaduan</a></li>

                        <li> <a class="waves-effect waves-dark" href="tanggapan.php" aria-expanded="false">
                            <i class="fa fa-reply"></i><span class="hide-menu"></span>Tanggapan</a></li>

                        <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false">
                            <i class="fa fa-sign-out"></i><span class="hide-menu"></span>Logout</a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->