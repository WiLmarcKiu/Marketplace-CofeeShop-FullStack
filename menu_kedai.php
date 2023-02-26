<?php
session_start();
include 'koneksi.php';
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
    <link href="css/styleMenuKedai.css" rel="stylesheet">
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
                <li class="breadcrumb-item active" aria-current="page">Menu Kedai</li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMB -->

    <!-- MENU KEDAI -->
    <div class="container">
        <div class="row">
            <?php
            // mendapatkan id_kedai dari url
            $id_kedai = $_GET["id"];
            ?>
            <?php $ambil = $koneksi->query("SELECT * FROM menu LEFT JOIN kedai ON menu.id_kedai=kedai.id_kedai
            WHERE kedai.id_kedai = '$id_kedai'"); ?>
            <?php while ($permenu = $ambil->fetch_assoc()) { ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-3">
                    <div class="card menu-kedai">
                        <img src="menu_kedai/<?php echo ($permenu['foto_menu']); ?>" style="height: 165px;" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title text-center"><b><?php echo ($permenu['nama_menu']); ?></b></p>
                            <p class="card-text text-center text-danger" style="font-weight: 600;">Rp. <?php echo number_format($permenu['harga_menu']); ?></p>
                            <a href="detail_menu.php?id=<?php echo ($permenu['id_menu']); ?>" class="btn btn-sm btn-primary d-grid">Detail</a>
                            <p class="card-text text-end" style="font-size: 10px; margin-top: 10px; margin-bottom: -10px; font-weight: 700; text-transform: uppercase;"><i class="fa-solid fa-location-dot"></i>&nbsp;<?php echo ($permenu['alamat_kedai']); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- END MENU KEDAI -->

    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/70cd04957d.js" crossorigin="anonymous"></script>
</body>

</html>