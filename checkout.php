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
if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang Kosong, Silahkan Belanja Terlebih Dahulu');</script>";
    echo "<script>location='index.php';</script>";
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
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMB -->

    <!-- KERANJANG -->
    <div class="container">
        <div class="judul-kedai pt-4" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; margin-bottom: -5px; font-weight: bold;">CHECKOUT</h5>
        </div>
        <div class="row row-keranjang">
            <div class="col table-responsive mt-3 mx-3">
                <table class="table align-middle text-center table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="th-header">Gambar</th>
                            <th scope="col" class="th-header">Produk</th>
                            <th scope="col" class="th-header">Harga</th>
                            <th scope="col" class="th-header">Jumlah</th>
                            <th scope="col" class="th-header">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        <?php $totalbelanja = 0; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_menu => $jumlah) : ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu = '$id_menu'");
                            $pecah = $ambil->fetch_assoc();
                            $subharga = $pecah["harga_menu"] * $jumlah;

                            // echo "<pre>";
                            // print_r($pecah);
                            // echo "</pre>";
                            ?>
                            <tr>
                                <td><img src="menu_kedai/<?php echo $pecah["foto_menu"]; ?>" class="img-keranjang" alt=""></td>
                                <td><?php echo $pecah["nama_menu"]; ?></td>
                                <td>Rp. <?php echo number_format($pecah["harga_menu"]); ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp. <?php echo number_format($subharga); ?></td>
                            </tr>
                            <?php $totalbelanja += $subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row row-keranjang">
            <div class="col table-responsive">
                <table class="table ms-auto text-center mb-5 mt-3 mx-3" id="table-checkout">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" colspan="2" class="th-header">Total Keranjang Belanja</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row" class="fw-bold th-header">Total Harga</th>
                            <td class="th-header fw-bold" style="color: #DE831D;">Rp. <?php echo number_format($totalbelanja); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END KERANJANG -->

    <!-- DESKRIPSI MENU -->
    <div class="container">
        <div class="row row-checkout">
            <div class="col-12">
                <h4><b>Deskripsi Checkout</b></h4>
                <div class="garis-checkout"></div>
                <form action="" method="POST" class="mb-4">
                    <div class="form-group row align-middle">
                        <div class="col-md-2">
                            <label><b>Pembeli</b></label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" style="font-size: 13px; cursor: no-drop;" readonly value="<?php echo ($_SESSION["pembeli"]['nama'])
                                                                                                            ?>" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label><b>No. Telepon</b></label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" style="font-size: 13px; cursor: no-drop;" readonly value="<?php echo ($_SESSION["pembeli"]['telepon'])
                                                                                                            ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row align-middle mt-4">
                        <div class="col-md-2">
                            <label><b>Opsi Pengantaran</b></label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" style="font-size: 13px;" name="id_kurir" required>
                                <option value="">Pilih Opsi Pengantaran</option>

                                <?php
                                $ambil = $koneksi->query("SELECT * FROM kurir");
                                while ($perkurir = $ambil->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo ($perkurir["id_kurir"]) ?>"><?php echo $perkurir['jenis_kurir']
                                                                                            ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <!-- <select class="form-control" style="font-size: 13px;" name="id_ongkir" required>
                                <option value="">Pilih Ongkos Kirim</option>

                                <?php
                                //$ambil = $koneksi->query("SELECT * FROM ongkir");
                                //while ($perongkir = $ambil->fetch_assoc()) {
                                ?>

                                <option value="<?php //echo ($perongkir["id_ongkir"]) 
                                                ?>">
                                    Kupang<?php //echo $perongkir['nama_kota'] 
                                            ?> -
                                    Rp. 10.000<?php //echo number_format($perongkir['tarif']) 
                                                ?>
                                </option>
                                <option value="<?php //echo ($perongkir["id_ongkir"]) 
                                                ?>">
                                    Kupang<?php //echo $perongkir['nama_kota'] 
                                            ?> -
                                    Rp. 10.000<?php //echo number_format($perongkir['tarif']) 
                                                ?>
                                </option>
                                <option value="<?php //echo ($perongkir["id_ongkir"]) 
                                                ?>">
                                    Kupang<?php //echo $perongkir['nama_kota'] 
                                            ?> -
                                    Rp. 10.000<?php //echo number_format($perongkir['tarif']) 
                                                ?>
                                </option>
                                <?php //} 
                                ?>
                            </select> -->
                        </div>
                        <div class="col-md-2">
                            <label><b>Alamat Lengkap Pengiriman</b></label>
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control" style="font-size: 13px; cursor: no-drop;" name="alamat" readonly><?php echo ($_SESSION["pembeli"]['alamat'])
                                                                                                                            ?></textarea>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <button class="btn btn-sm btn-dark" name="bayar_sekarang"><i class="fa-solid fa-dollar-sign"></i>&nbsp;Bayar Sekarang</button>
                    </div>

                </form>

                <?php
                if (isset($_POST["bayar_sekarang"])) {
                    $id_pembeli = $_SESSION["pembeli"]["id_pembeli"];
                    $id_kurir = $_POST["id_kurir"];
                    $tgl_pembelian = date("Y-m-d H:i:s");
                    $alamat_pengiriman = $_SESSION["pembeli"]["alamat"];

                    $ambil = $koneksi->query("SELECT * FROM kurir WHERE id_kurir = '$id_kurir'");
                    $arraykurir = $ambil->fetch_assoc();
                    $jenis_kurir = $arraykurir['jenis_kurir'];

                    $total_pembelian = $totalbelanja;

                    // 1. menyimpan data ke tabel pembelian 
                    $koneksi->query("INSERT INTO pembelian (id_pembeli,id_kurir,tgl_pembelian,total_pembelian,jenis_kurir,alamat_pengiriman) VALUES ('$id_pembeli','$id_kurir','$tgl_pembelian','$total_pembelian','$jenis_kurir','$alamat_pengiriman')");

                    // mendapatkan id_pembelian yang barusan terjadi
                    $id_pembelian_barusan = $koneksi->insert_id;
                    foreach ($_SESSION["keranjang"] as $id_menu => $jumlah) {

                        // mendapatkan data menu berdasarkan id_menu
                        $ambil = $koneksi->query("SELECT * FROM menu JOIN kedai ON menu.id_kedai=kedai.id_kedai WHERE id_menu = '$id_menu'");
                        $permenu = $ambil->fetch_assoc();

                        $id_kedai = $permenu['id_kedai'];
                        $nama = $permenu['nama_menu'];
                        $harga = $permenu['harga_menu'];

                        $subharga = $permenu['harga_menu'] * $jumlah;

                        $koneksi->query("INSERT INTO pembelian_menu (id_pembelian,id_menu,id_kedai,jumlah,nama,harga,subharga) VALUES ('$id_pembelian_barusan','$id_menu','$id_kedai','$jumlah','$nama','$harga','$subharga')");


                        // skript update stok
                        $koneksi->query("UPDATE menu SET stok_menu = stok_menu - $jumlah WHERE id_menu = 
								'$id_menu'");
                    }

                    // mengkosongkan keranjang belanja
                    unset($_SESSION["keranjang"]);

                    // tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
                    echo "<script>alert('Pembelian Sukses');</script>";
                    echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
                }
                ?>

            </div>
        </div>
    </div>
    <!-- END DESKRIPSI MENU -->


    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/70cd04957d.js" crossorigin="anonymous"></script>
</body>

</html>