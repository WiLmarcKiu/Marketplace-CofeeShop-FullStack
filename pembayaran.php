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
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pembeli yang beli
$id_pembeli_beli = $detpem["id_pembeli"];
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
            <h5 class="daftar text-center" style="margin-top: 5px; font-weight: bold;">PEMBAYARAN</h5>
            <div class="border" style="width: 90px; height: 5px; background: #DE831D; border-radius: 6px; margin: 2px auto;"></div>
        </div>
        <div class="row text-center row-container justify-content-center">
            <div class="col-md-5 mx-2 mb-1" style="margin-top: -7px;">
                <img src="gambar/transfer4.gif" style="width: 100%; height: 63vh;" alt="">
            </div>
            <div class="col-md-5 mx-2 my-2 pb-2">
                <!-- <h6 class="pt-2" style="font-style: italic;"><b>Tagihan :</b> <b style="color: #12AEDC;">Rp. <?php echo number_format($detpem["total_pembelian"]) ?></b></h6> -->
                <form action="" method="POST" class="pt-4 pb-4" enctype="multipart/form-data">
                    <div class=" form-group mb-3">
                        <i class="fa-solid fa-user icon"></i>
                        <input type="nama" class="form-control input-field" readonly style="cursor: no-drop; background-color: #FFF;" placeholder="Masukan Nama Anda" required value="<?php echo $_SESSION['pembeli']['nama']; ?>" name="nama">
                    </div>
                    <div class="form-group mb-3">
                        <i class="fa-solid fa-building-columns icon"></i>
                        <select class="form-control input-field" name="bank" required>
                            <option value="">Pilih Jenis Bank yang Digunakan</option>
                            <option value="BANK BCA">BANK BCA</option>
                            <option value="BANK BNI">BANK BNI</option>
                            <option value="BANK BRI">BANK BRI</option>
                            <option value="BANK MANDIRI">BANK MANDIRI</option>
                            <option value="BANK NTT">BANK NTT</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <i class="fa-solid fa-calendar icon"></i>
                        <input type="date" class="form-control input-field" placeholder="Masukan Tanggal Pembayaran" name="tgl_bayar" required>
                    </div>
                    <div class="form-group mb-3">
                        <i class="fa-solid fa-dollar-sign icon"></i>
                        <input type="number" class="form-control input-field" value="<?php echo $detpem["total_pembelian"]; ?>" placeholder="Masukan Total Pembayaran" readonly style="cursor: no-drop; background-color: #FFF;" name="total" required>
                    </div>
                    <div class="form-group mb-3">
                        <i class="fa-solid fa-camera icon"></i>
                        <input type="file" class="form-control input-field" required name="bukti">
                    </div>
                    <div class="form-group" style="font-size: 13px; justify-content: end;">
                        <p class="text-danger fw-bold">Bukti bayar harus berformat JPG Mkasimal 2MB.</p>
                    </div>
                    <button id="btn" type="submit" style="float: right;" name="bayar">Bayar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- END PEMBAYARAN -->

    <?php
    if (isset($_POST['bayar'])) {
        $namabukti = $_FILES['bukti']['name'];
        $lokasibukti = $_FILES['bukti']['tmp_name'];
        move_uploaded_file($lokasibukti, "buktiBayar/" . $namabukti);

        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $tgl_bayar = $_POST["tgl_bayar"];
        $total = $_POST["total"];


        $koneksi->query("INSERT INTO pembayaran
		(id_pembelian,nama,bank,tgl_bayar,total,bukti) VALUES ('$idpem','$nama','$bank','$tgl_bayar','$total','$namabukti')");

        // ubah data pembeliannya dari pending ke sudah kirim pembayaran
        $koneksi->query("UPDATE pembelian SET status_pembelian = 'Sudah Kirim Pembayaran' WHERE id_pembelian = 
			'$idpem'");


        echo "<script>alert('Terima Kasih Telah Mengirimkan Bukti Pembayaran');</script>";
        echo "<script>location='riwayat_belanja.php';</script>";
    }
    ?>

    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/943a58e089.js" crossorigin="anonymous"></script>
</body>

</html>