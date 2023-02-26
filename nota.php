<?php
session_start();
date_default_timezone_set("Asia/Singapore");
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

include 'koneksi.php';

// jika belum ada session pembeli(belum login), maka dibawah ke login.php
if (!isset($_SESSION["pembeli"])) {
    echo "<script>alert('Anda Belum Login');</script>";
    echo "<script>location='login_pembeli.php';</script>";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cofee Shop</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styleindex.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">
    <link href="css/styleDetailMenu.css" rel="stylesheet">
</head>

<style>
    /* NAVBAR */
    .navbar-nav li {
        padding: 0 2px;
        color: #fff;
    }

    #navbarNav ul li div.isi a {
        color: #FFF;
        border-bottom: 2px solid transparent;
        border-top: 2px solid transparent;
    }

    #navbarNav ul li div.isi a:hover {
        border-bottom: 2px solid #DE831D;
    }


    /* NAVBAR DROPDOWN */
    .dropdown-menu {
        display: none;
    }

    .navbar-nav li:hover>div.dropdown-menu {
        display: block;
        color: #000;
        font-size: 14px;
    }

    .dropdown-menu a:hover {
        color: #DE831D;
        font-weight: bold;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>

    <!-- BREADCRUMB -->
    <div class="container">
        <nav aria-label="breadcrumb" style="background-color: #FFF;" class="mt-3">
            <ol class="breadcrumb p-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nota</li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMB -->

    <!-- NOTA -->
    <div class="container">
        <div class="judul-kedai pt-4" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: -10px; margin-bottom: 5px; font-weight: bold;">NOTA</h5>
        </div>

        <?php
        $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pembeli 
		ON pembelian.id_pembeli=pembeli.id_pembeli
		WHERE pembelian.id_pembelian='$_GET[id]'");
        $detail = $ambil->fetch_assoc();
        ?>

        <!-- jika pembeli yang beli tidak sama dengan pembeli yang login ,maka dilarikan ke riwayat_belanja.php karena tidak berhak melihat nota orang lain  -->
        <!-- pembeli yang beli harus pembeli yang login -->
        <?php

        // mendapatkan id_pembeli yang beli
        $idpembeliyangbeli = $detail["id_pembeli"];

        // mendapatkan id_pembeli yang login
        $idpembeliyanglogin = $_SESSION["pembeli"]["id_pembeli"];

        if ($idpembeliyangbeli !== $idpembeliyanglogin) {
            echo "<script>alert('Jangan Sembarang!!!');</script>";
            echo "<script>location='riwayat.php';</script>";
            exit();
        }

        ?>
    </div>


    <!-- DATA NOTA -->
    <div class="container">
        <div class="row row-deskripsi-menu justify-content-center">
            <div class="col-md-4">
                <h5>Pembelian</h5>
                <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong>
                <p>
                    Tanggal : <?php echo date("d F Y, H:i", strtotime($detail['tgl_pembelian'])) ?><br>
                    Total : Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
                    Expired : <?php echo date("d F Y, H:i", strtotime('+3 day', strtotime($detail['tgl_pembelian']))) ?><br>
                </p>
            </div>
            <div class="col-md-4">
                <h5>Pelanggan</h5>
                <strong>Nama : <?php echo $detail['nama']; ?></strong>
                <p>
                    Email : <?php echo $detail['email']; ?><br>
                    Telepon : <?php echo $detail['telepon']; ?>
                </p>
            </div>
            <div class="col-md-4">
                <h5>Pengiriman</h5>
                <strong>Kurir : <?php echo $detail['jenis_kurir']; ?></strong><br>
                Alamat Pengiriman : <?php echo $detail['alamat']; ?><br>
            </div>
        </div>
    </div>
    <!-- END DATA NOTA -->


    <div class="container">
        <div class="row row-keranjang">
            <div class="col table-responsive mt-3 mx-3">
                <table class="table align-middle text-center table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="th-header">No</th>
                            <th scope="col" class="th-header">Nama Menu</th>
                            <th scope="col" class="th-header">Harga</th>
                            <th scope="col" class="th-header">Jumlah</th>
                            <th scope="col" class="th-header">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        <?php $nomor = 1; ?>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM pembelian_menu WHERE id_pembelian ='$_GET[id]'"); ?>
                        <?php
                        while ($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah["nama"]; ?></td>
                                <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
                                <td><?php echo $pecah["jumlah"]; ?></td>
                                <td>Rp. <?php echo number_format($pecah["subharga"]); ?></td>
                            </tr>
                            <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END NOTA -->


    <!-- TRANSFER ADMIN -->
    <div class="container">
        <div class="row row-deskripsi-menu">
            <div class="col-12">
                <h4><b>Detail Transfer</b></h4>
                <div class="garis-judul-menu"></div>
                <p>Silahkan melakukan pembayaran sebesar <b style="color: #DE831D;">Rp. <?php echo number_format($detail['total_pembelian']); ?></b> ke
                    <br>
                    <strong>BANK BNI 0848230258 AN. Elma Rulfin Tiara Kiu</strong>
                </p>
            </div>
        </div>
    </div>
    <!-- END TRANSFER ADMIN -->



    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/70cd04957d.js" crossorigin="anonymous"></script>
</body>

</html>