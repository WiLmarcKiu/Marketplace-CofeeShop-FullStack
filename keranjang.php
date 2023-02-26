<?php
session_start();
include 'koneksi.php';

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

// exit;

if (isset($_GET['id']) && isset($_POST['update']) && $_POST['jumlah']) {
    $id = $koneksi->escape_string(intval(base64_decode($_GET['id'])));
    $jumlah = $_POST['jumlah'];
    $_SESSION["keranjang"][$id] = $jumlah;
}


if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang Kosong, Silahkan Pilih Kedai untuk Berbelanja');</script>";
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
    <link href="css/keranjang.css" rel="stylesheet">
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

    #btn {
        width: 150px;
        padding: 7px 7px;
        border: none;
        background-color: #DE831D;
        color: #FFF;
        cursor: pointer;
        border-radius: 7px;
        margin-bottom: 15px;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>

    <!-- BREADCRUMB -->
    <div class="container">
        <nav aria-label="breadcrumb" style="background-color: #FFF;" class="mt-3">
            <ol class="breadcrumb p-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMB -->

    <!-- KERANJANG -->
    <div class="container">
        <div class="judul-kedai pt-4" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; margin-bottom: -5px; font-weight: bold;">KERANJANG BELANJA</h5>
        </div>
        <div class="row row-keranjang">
            <div class="col table-responsive mt-3 mx-3">
                <table class="table align-middle text-center table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="th-header">Hapus</th>
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
                                <th scope="row"><a id="hapus" href="hapus_keranjang.php?id=<?php echo $id_menu ?>"><i class="fa-regular fa-circle-xmark text-dark fs-4"></i></a></th>
                                <td><img src="menu_kedai/<?php echo $pecah["foto_menu"]; ?>" class="img-keranjang" alt=""></td>
                                <td><?php echo $pecah["nama_menu"]; ?></td>
                                <td>Rp. <?php echo number_format($pecah["harga_menu"]); ?></td>
                                <td>
                                    <form action="keranjang.php?id=<?php echo base64_encode($id_menu); ?>" method="POST">
                                        <input type="number" name="jumlah" min="1" value="<?php echo $jumlah; ?>" style="max-width: 70px;">
                                        <input type="submit" name="update" class="btn btn-sm btn-dark" value="Update">
                                    </form>
                                </td>
                                <td>Rp. <?php echo number_format($subharga); ?></td>
                            </tr>
                            <?php $totalbelanja += $subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <center><button id="btn" onclick="lanjutBelanja()">Lanjutkan Belanja</button></center>
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
                        <tr>
                            <td colspan="2" class="th-header">
                                <div class="btn-checkout d-grid mx-4">
                                    <a href="checkout.php" class="btn btn-sm btn-dark"><i class="fa-solid fa-circle-check"></i>&nbsp;Checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END KERANJANG -->


    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/70cd04957d.js" crossorigin="anonymous"></script>
    <script>
        function lanjutBelanja() {
            history.back();
        }
    </script>
</body>

</html>