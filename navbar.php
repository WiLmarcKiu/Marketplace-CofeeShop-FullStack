<?php error_reporting(0); ?>
<style>
    #search {
        transition: 1s;
    }

    #search:hover {
        transform: rotate(360deg);
        border-radius: 50%;
    }
</style>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Halaman Home / Beranda">
            <!-- <img src="gambar/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top"> -->
            <img src="icon/mug-hot.png" style="height: 20px; margin-bottom: 8px; filter: invert(54%) sepia(92%) saturate(648%) hue-rotate(349deg) brightness(91%) contrast(90%);" alt="">&nbsp;<b style="font-size: 15px; color: #FFF;">Cofee Shop</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex ms-auto me-auto my-4 my-lg-0" role="search">
                <input class="cari form-control me-2" style="height: 35px;" type="search" placeholder="Cari Menu Kesukaan Anda .." aria-label="Search">
                <button id="search" class="btn btn-sm btn-light" type="submit"><img src="icon/search1.png" style="height: 18px; width: 18px; margin-right: 3px;" alt=""></button>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <div class="isi">
                        <a class="nav-link active position-relative" href="keranjang.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keranjang"><img src="icon/cart.png" style="height: 15px; margin-bottom: 5px; filter: invert(100%) sepia(90%) saturate(55%) hue-rotate(115deg) brightness(114%) contrast(98%);" alt="">
                            <?php foreach ($_SESSION['keranjang'] as $id_menu => $jumlah1) : ?>
                                <?php $jumlahnya1 += $jumlah1; ?>
                            <?php endforeach ?>
                            <?php
                            echo $jumlahnya1 > 0 ? ' <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                                ' . $jumlahnya1 . '
                            </span>' : '';
                            ?>

                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="isi">
                        <a class="nav-link active" href="index.php#contactUs"><img src="icon/phone.png" style="height: 14px; margin-right: 5px; margin-bottom: 5px; filter: invert(100%) sepia(90%) saturate(55%) hue-rotate(115deg) brightness(114%) contrast(98%);" alt="">Hubungi Kami</a>
                    </div>
                </li>


                <!-- jika sudah login(ada session pembeli) -->
                <?php if (isset($_SESSION["pembeli"])) : ?>

                    <li class="nav-item dropdown">
                        <div class="isi">
                            <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><img src="icon/user-book.png" style="height: 15px; margin-right: 5px; margin-bottom: 5px; filter: invert(100%) sepia(90%) saturate(55%) hue-rotate(115deg) brightness(114%) contrast(98%);" alt=""><?php echo $_SESSION['pembeli']['nama']; ?></a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Preview">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalAkunPembeli"><b><i class="fa-solid fa-eye"></i>&nbsp;Akun Saya</b></a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="riwayat_belanja.php"><b><i class="fa-regular fa-hourglass"></i>&nbsp;Riwayat Belanja Saya</b></a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="logout.php"><b><i class="fa-solid fa-arrow-left"></i>&nbsp;Logout</b></a>
                        </div>
                    </li>

                    <!-- selain itu (belum login||belum ada session pelanggan) -->
                <?php else : ?>

                    <li class="nav-item">
                        <div class="isi">
                            <a class="nav-link active" href="login_pembeli.php"><img src="icon/lock.png" style="height: 14px; margin-right: 5px; filter: invert(100%) sepia(90%) saturate(55%) hue-rotate(115deg) brightness(114%) contrast(98%);" alt="">Login</a>
                        </div>
                    </li>

                <?php endif ?>

            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->


<!-- MODAL AKUN PEMBELI -->
<div class=" modal fade" id="ModalAkunPembeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="background: rgba(255, 255, 255, .9); box-shadow: 0 0 20px 2px rgba(255, 255, 255, .5);">
            <!-- <div class="modal-header" style="background-color: #000; color: #FFF;">
                <h6 class="modal-title" id="ModalDaftar"><b>Akun</b></h6>
                <a href="#" data-bs-dismiss="modal" aria-label="Close" style="color: #fff; outline: none; border: none; text-decoration: none;"><b><i class="fa-solid fa-xmark"></i></b></a>
            </div> -->
            <div class="modal-body">
                <div class="container">
                    <?php
                    // mendapatkan id_pembeli yang login
                    $id_pembeli = $_SESSION["pembeli"]["id_pembeli"];
                    $ambil = $koneksi->query("SELECT * FROM pembeli WHERE id_pembeli ='$id_pembeli'");
                    $pecah = $ambil->fetch_assoc();
                    ?>
                    <form action="" method="POST">
                        <div class="row form-group mb-2 mt-2">
                            <div class="col-md-12">
                                <label><b><i class="fa-solid fa-user"></i>&nbsp;Nama</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group" style="border-bottom: 1px solid #000;">
                                    <!-- <span class="input-group-text"><i class="fa-solid fa-user"></i></span> -->
                                    <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama']; ?>" autocomplete="off" required readonly style="font-size: 14px; border: none; outline: none; background: transparent; color: #000; box-shadow: none; cursor: no-drop;">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mb-2">
                            <div class="col-md-12">
                                <label><b><i class="fa-solid fa-location-dot"></i>&nbsp;Alamat</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group" style="border-bottom: 1px solid #000;">
                                    <!-- <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span> -->
                                    <textarea type="text" class="form-control" name="alamat" autocomplete="off" required readonly style="font-size: 14px; border: none; outline: none; background: transparent; color: #000; box-shadow: none; cursor: no-drop;"><?php echo $pecah['alamat']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mb-2">
                            <div class="col-md-12">
                                <label><b><i class="fa-solid fa-phone"></i>&nbsp;Telepon</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group" style="border-bottom: 1px solid #000;">
                                    <!-- <span class="input-group-text"><i class="fa-solid fa-phone"></i></span> -->
                                    <input type="number" class="form-control" name="telepon" value="<?php echo $pecah['telepon']; ?>" autocomplete="off" required readonly style="font-size: 14px; border: none; outline: none; background: transparent; color: #000; box-shadow: none; cursor: no-drop;">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mb-2">
                            <div class="col-md-12">
                                <label><b><i class="fa-solid fa-envelope"></i>&nbsp;Email</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group" style="border-bottom: 1px solid #000;">
                                    <!-- <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span> -->
                                    <input type="email" class="form-control" name="email" value="<?php echo $pecah['email']; ?>" autocomplete="off" required readonly style="font-size: 14px; border: none; outline: none; background: transparent; color: #000; box-shadow: none; cursor: no-drop;">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mb-2">
                            <div class="col-md-12">
                                <label><b><i class="fa-solid fa-key"></i>&nbsp;Password</b></label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group" style="border-bottom: 1px solid #000;">
                                    <!-- <span class="input-group-text"><i class="fa-solid fa-key"></i></span> -->
                                    <input type="text" class="form-control" name="password" value="<?php echo $pecah['password']; ?>" autocomplete="off" required readonly style="font-size: 14px; border: none; outline: none; background: transparent; color: #000; box-shadow: none; cursor: no-drop;">
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary" name="daftar_pembeli"><i class="fa fa-paper-plane"></i>&nbsp;Daftar</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp;Tutup</button>
            </div> -->
            </form>

            <?php
            if (isset($_POST["daftar_pembeli"])) {

                // mengambil isian nama, email, password, telepon, alamat
                $nama = $_POST["nama"];
                $alamat = $_POST["alamat"];
                $telepon = $_POST["telepon"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                // cek apakah email sudah digunakan
                $ambil = $koneksi->query("SELECT * FROM pembeli WHERE email = '$email'");
                $yangcocok = $ambil->num_rows;

                if ($yangcocok == 1) {
                    echo "<script>alert('Pendaftaran gagal, Email telah digunakan!');</script>";
                    echo "<script>location='daftar.php';</script>";
                } else {
                    // query insert ke tabel pembeli
                    $koneksi->query("INSERT INTO pembeli (nama,alamat,telepon,email,password) VALUES 
                  ('$nama','$alamat','$telepon','$email','$password')");

                    echo "<script>alert('Pendaftaran berhasil');</script>";
                    echo "<script>location='index.php';</script>";
                }
            }
            ?>

        </div>
    </div>
</div>
<!-- END MODAL AKUN PEMBELI -->