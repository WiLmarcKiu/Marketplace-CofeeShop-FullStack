<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <?php
                    // mendapatkan id_kedai yang login
                    $id_kedai = $_SESSION["pemilik"]["id_kedai"];

                    $ambil = $koneksi->query("SELECT * FROM kedai WHERE id_kedai ='$id_kedai'");
                    $pecah = $ambil->fetch_assoc();
                    ?>
                    <img src="../foto_pemilik/<?php echo $pecah["foto_pemilik"]; ?>" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo $_SESSION['pemilik']['nama_pemilik']; ?></span>
                    <span class="text-secondary text-small">Pemilik Kedai</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarMenu.php">
                <span class="menu-title">Menu</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarPembeli.php">
                <span class="menu-title">Pembeli</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarKedai.php">
                <span class="menu-title">Kedai</span>
                <i class="mdi mdi-store menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarPembelian.php">
                <span class="menu-title">Pembelian</span>
                <i class="mdi mdi-cart menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarKurir.php">
                <span class="menu-title">Kurir</span>
                <i class="mdi mdi-truck menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Pengaturan</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-wrench menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link full-screen-link" href="#" id="fullscreen-button"> Fullscreen </a></li>
                    <li class="nav-item"> <a class="nav-link" href="signout.php"> Signout </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>