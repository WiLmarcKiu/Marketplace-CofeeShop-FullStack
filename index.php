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

    #btn {
        width: 30%;
        padding: 7px 9px;
        border: none;
        background-color: #4345E7;
        color: #FFF;
        cursor: pointer;
        border-radius: 7px;
    }

    #btn:hover {
        background-color: #000;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>

    <!-- CAROUSEL -->
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade mt-4" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="gambar/carousel1.jpg" style="width: 100%; height: 35vh;" class="d-block img-fluid" alt="gambar/carousel">
                </div>
                <div class="carousel-item">
                    <img src="gambar/carousel2.jpg" style="width: 100%; height: 35vh;" class="d-block img-fluid" alt="gambar/carousel">
                </div>
                <div class="carousel-item">
                    <img src="gambar/carousel3.jpg" style="width: 100%; height: 35vh;" class="d-block img-fluid" alt="gambar/carousel">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- END CAROUSEL -->

    <!-- DAFTAR KEDAI -->
    <div class="container mt-4">
        <div class="judul-kedai pt-3 pb-3" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; font-weight: bold;">DAFTAR KEDAI</h5>
            <div class="border" style="width: 90px; height: 5px; background: #DE831D; border-radius: 6px; margin: 2px auto;"></div>
        </div>
        <div class="row text-center row-container">
            <?php $ambil = $koneksi->query("SELECT * FROM kedai"); ?>
            <?php while ($perkedai = $ambil->fetch_assoc()) { ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="daftar-kedai">
                        <a href="menu_kedai.php?id=<?php echo ($perkedai['id_kedai']); ?>"><img src="gambar_kedai/<?php echo ($perkedai['logo_kedai']); ?>" class="gambar-kedai mt-3" alt=""></a>
                        <p class="mt-2" style="font-style: italic;"><b><?php echo ($perkedai['nama_kedai']); ?></b></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- END DAFTAR KEDAI -->

    <!-- HUBUNGI KAMI -->
    <div id="contactUs" class="container mt-4">
        <div class="judul-kedai pt-3" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="daftar text-center" style="margin-top: 5px; font-weight: bold;">HUBUNGI KAMI</h5>
            <div class="border" style="width: 90px; height: 5px; background: #DE831D; border-radius: 6px; margin: 2px auto;"></div>
        </div>
        <div class="row text-center row-container justify-content-center">
            <div class="col-md-5 mx-2 my-2">
                <img src="gambar/contactus12.gif" style="width: 100%; height: 50vh;" alt="">
            </div>
            <div class="col-md-5 mx-2 my-2 pb-2">
                <form action="" method="POST" class="pt-2 pb-4">
                    <div class="form-floating mb-3">
                        <input type="nama" class="form-control" id="floatingInput" placeholder="nama">
                        <label for="floatingInput">Nama Anda</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="telepon" class="form-control" id="floatingtelepon" placeholder="telepon">
                        <label for="floatingtelepon">No. Telepon</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="pesan" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Pesan Anda</label>
                    </div>
                    <button id="btn" type="submit" style="float: right;">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- END HUBUNGI KAMI -->

    <?php include 'footer.php'; ?>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/943a58e089.js" crossorigin="anonymous"></script>

</body>

</html>