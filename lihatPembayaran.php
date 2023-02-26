<?php
session_start();
include 'koneksi.php';
// jika belum ada session pembeli(belum login), maka dibawah ke login.php
if (!isset($_SESSION["pembeli"])) {
    echo "<script>alert('Anda Belum Login');</script>";
    echo "<script>location='login_pembeli.php';</script>";
    exit();
}

// mendapatkan id_pembelian dari url
$id_pembelian = $_GET["id"];

// mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran 
  LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
  WHERE pembelian.id_pembelian = '$id_pembelian'");
$detbay = $ambil->fetch_assoc();


// jika belum ada data pembayaran
if (empty($detbay)) {
    echo "<script>alert('Belum Ada Data Pembayaran');</script>";
    echo "<script>location='riwayat_belanja.php';</script>";
    exit();
}

// jika data pembeli yang bayar tidak sesuai dengan yang login
if ($_SESSION["pembeli"]['id_pembeli'] !== $detbay["id_pembeli"]) {
    echo "<script>alert('Anda Tidak Berhak Melihat Pembayaran Orang Lain');</script>";
    echo "<script>location='riwayat_belanja.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cofee Shop</title>
    <link rel="shortcut icon" href="logoo.jpg">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styleindex.css" rel="stylesheet">
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

    .form-group {
        display: flex;
        width: 100%;
    }

    .icon {
        width: 50px;
        padding: 12px;
        background-color: #000;
        color: #FFF;
        text-align: center;
        border-radius: 7px 0 0 7px;
    }

    .input-field {
        width: 100%;
        border: 2px solid #D8D6D6;
        border-radius: 0 7px 7px 0;
    }

    .input-field:focus {
        border: 2px solid #000;
        box-shadow: none;
    }

    #btn {
        width: 30%;
        padding: 7px 9px;
        border: none;
        background-color: #000;
        color: #FFF;
        cursor: pointer;
        border-radius: 7px;
    }

    #btn:hover {
        background-color: #12AEDC;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>

    <!-- PEMBAYARAN -->
    <div id="contactUs" class="container mt-4">
        <div class="judul-kedai pt-3" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; font-weight: bold;">DETAIL PEMBAYARAN</h5>
            <div class="border" style="width: 90px; height: 5px; background: #DE831D; border-radius: 6px; margin: 2px auto;"></div>
        </div>
        <div class="row row-container justify-content-center">
            <div class="col-lg-4 mt-4 mb-5">
                <img src="buktiBayar/<?php echo $detbay['bukti']; ?>" style="width: 100%; height: 60vh; vertical-align: middle;" alt="">
            </div>
            <div class="col-lg-7 mt-4 mb-5">
                <table class="table noborder table-hover align-middle">
                    <tbody style="font-size: 16px;">
                        <tr></tr>
                        <tr style="height: 60px;">
                            <td style="font-weight: 600;">Nama Penyetor</td>
                            <td style="font-weight: 600;">:</td>
                            <td style="font-weight: 600; color: #DE831D;"><?php echo $detbay['nama']; ?></td>
                        </tr>
                        <tr style="height: 60px;">
                            <td style="font-weight: 600;">Bank Penyetor</td>
                            <td style="font-weight: 600;">:</td>
                            <td style="font-weight: 600; color: #DE831D;"><?php echo $detbay['bank']; ?></td>
                        </tr>
                        <tr style="height: 60px;">
                            <td style="font-weight: 600;">Tanggal Setor</td>
                            <td style="font-weight: 600;">:</td>
                            <td style="font-weight: 600; color: #DE831D;"><?php echo date("d F Y", strtotime($detbay['tgl_bayar'])) ?></td>
                        </tr>
                        <tr style="height: 60px;">
                            <td style="font-weight: 600;">Total Setoran</td>
                            <td style="font-weight: 600;">:</td>
                            <td style="font-weight: 600; color: #DE831D;">Rp. <?php echo number_format($detbay['total']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PEMBAYARAN -->


    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/943a58e089.js" crossorigin="anonymous"></script>
</body>

</html>