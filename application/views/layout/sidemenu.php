<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="<?= base_url() . 'assets/' ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= base_url() . 'assets/' ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="" class="d-block"><?= $this->fungsi->user_login()->nama_user ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
						 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?= site_url("dashboard") ?>" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item ">
                <!-- <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"> -->
                        <a href="<?= site_url("obat") ?>" class="nav-link">
                            <i class="nav-icon fas fa-medkit"></i>
                            <p>
                                Obat
                            </p>
                        </a>
                    <!-- </li>
                    <li class="nav-item">
                        <a href="<?= site_url("kategori") ?>" class="nav-link">
                            <i class="nav-icon fab fa-buffer"></i>
                            <p>
                                Kategori
                            </p>
                        </a>
                    </li>
                </ul> -->
            </li>
            <li class="nav-item">
                <a href="<?= site_url("app") ?>" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                        Aplikasi Kasir
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url("transaksi") ?>" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Transaksi
                    </p>
                </a>
            </li>
            <li class="nav-header">ANOTHER MENU</li>
            <li class="nav-item">
                <a href="<?= site_url("user") ?>" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url("login/logout") ?>" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->