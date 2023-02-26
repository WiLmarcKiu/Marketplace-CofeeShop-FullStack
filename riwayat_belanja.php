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
    exit();
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
                <li class="breadcrumb-item active" aria-current="page">Riwayat Belanja</li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMB -->

    <!-- RIWAYAT BELANJA -->
    <div class="container">
        <div class="judul-kedai pt-4" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; margin-bottom: -5px; font-weight: bold; text-transform: uppercase;">RIWAYAT BELANJA <b class="pembeli" style="color: #DE831D;"><?php echo $_SESSION["pembeli"]["nama"] ?></b>
            </h5>
        </div>
        <div class="row row-keranjang">
            <div class="col table-responsive mt-3 mx-3">
                <table class="table align-middle text-center table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="th-header">No</th>
                            <th scope="col" class="th-header">Tanggal Beli</th>
                            <th scope="col" class="th-header">Status Beli</th>
                            <th scope="col" class="th-header">Total Beli</th>
                            <th scope="col" class="th-header">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        <?php $nomor = 1; ?>


                        <!-- konfigurasi pagination -->
                        <?php

                        // mendapatkan id_pembeli yang login
                        $id_pembeli = $_SESSION["pembeli"]["id_pembeli"];
                        $jumlahDataPerHalaman = 5;
                        $jumlahData = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pembeli ='$id_pembeli'"));
                        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                        $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

                        ?>

                        <?php

                        // mendapatkan id_pembeli yang login
                        $id_pembeli = $_SESSION["pembeli"]["id_pembeli"];
                        $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembeli ='$id_pembeli' LIMIT $awalData, $jumlahDataPerHalaman"); ?>
                        <?php
                        while ($pecah = $ambil->fetch_assoc()) { ?>

                            <!-- akhir konfigurasi pagination -->

                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo date("d F Y, H:i", strtotime($pecah['tgl_pembelian'])) ?></td>
                                <td><?php echo $pecah["status_pembelian"] ?></td>
                                <td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
                                <td>
                                    <a href="nota.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-sm btn-primary nota mt-1 mb-1"><i class="fa fa-envelope"></i>&nbsp;Nota</a>&nbsp;

                                    <?php if ($pecah['status_pembelian'] == "Pending") : ?>
                                        <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-sm btn-secondary input mt-1 mb-1">
                                            <i class="fa-solid fa-dollar-sign"></i>&nbsp;Bayar
                                        </a>

                                    <?php else : ?>
                                        <a href="lihatPembayaran.php?id=<?php echo ($pecah["id_pembelian"]); ?>" class="btn btn-sm btn-warning lihat mt-1 mb-1"><i class="fa fa-eye"></i>&nbsp;Lihat Pembayaran</a>

                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END RIWAYAT BELANJA -->

    <!-- navigasi pagination -->

    <nav class="page mt-4">
        <ul class="pagination justify-content-center">
            <!-- tombol sebelumnya -->
            <?php if ($halamanAktif > 1) { ?>
                <li class="page-item"><a href="?halaman= <?php echo $halamanAktif - 1; ?>" class="page-link" style="color: #000000;">Kembali</a></li>
            <?php } else { ?>
                <li class="page-item disabled"><a href="?halaman= <?php echo $halamanAktif - 1; ?>" class="page-link">Kembali</a></li>
            <?php } ?>
            <!-- akhir tombol sebelumnya -->


            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <li class="page-item"><a href="?halaman= <?php echo $i; ?>" class="page-link" style="background-color: #CCC; color: #000000;"><?php echo $i; ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a href="?halaman= <?php echo $i; ?>" class="page-link" style="color: #000000;"><?php echo $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>


            <!-- tombol selanjutnya -->
            <?php if ($halamanAktif < $jumlahHalaman) { ?>
                <li class="page-item"><a href="?halaman= <?php echo $halamanAktif + 1; ?>" class="page-link" style="color: #000000;">Lanjut</a></li>
            <?php } else { ?>
                <li class="page-item disabled"><a href="?halaman= <?php echo $halamanAktif + 1; ?>" class="page-link">Lanjut</a></li>
            <?php } ?>
            <!-- akhir tombol selanjutnya -->
        </ul>
    </nav>

    <!-- navigasi pagination -->


    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/70cd04957d.js" crossorigin="anonymous"></script>
</body>

</html>