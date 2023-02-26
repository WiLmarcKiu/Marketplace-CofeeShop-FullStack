<?php
session_start();
// if (isset($_SESSION["admin"])) {
//     echo "<script>location='index.php';</script>";
//     exit;
// }
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Coffee Shop</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.ico" />
</head>
<style>
    ::placeholder {
        color: #3E4B5B !important;
    }
</style>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth" style="background-image: url(../admin/assets/images/dashboard/login.jpg); background-size: cover; width: 100%; height: 100vh;">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5" style="background: #ffffffb8; box-shadow: 0 1rem 9rem rgb(249 169 23 / 32%) !important;">
                            <div class="brand-logo text-center">
                                <!-- <img src="../admin/assets/images/logo.svg"> -->
                                <h2>Pemilik</h2>
                            </div>
                            <!-- <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6> -->
                            <form method="POST" class="pt-3">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required="" autocomplete="off" name="email_pemilik">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required="" autocomplete="off" name="password">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted" style="color: #3E4B5B !important;">
                                            <input type="checkbox" class="form-check-input" required> Saya Adalah Pemilik Kedai
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" style="display: block; width: 100%;" name="signin">SIGN IN</button>
                                </div>
                                <!-- <div class="text-center mt-4" style="font-size: 14px; color: #3E4B5B;"> Belum punya akun? <a href="register.html" class="text-primary">Signup</a>
                                </div> -->
                            </form>


                            <?php
                            // jika ada tombol signin (tombol signin ditekan)
                            if (isset($_POST["signin"])) {
                                $email = $_POST["email_pemilik"];
                                $password = $_POST["password"];

                                // lakukan query cek akun di tabel kedai pada database
                                $ambil = $koneksi->query("SELECT * FROM kedai WHERE email_pemilik = '$email' AND password = '$password'");

                                // hitung akun yang terambil
                                $akunyangcocok = $ambil->num_rows;

                                // jika 1 akun yang cocok maka disigninkan
                                if ($akunyangcocok == 1) {
                                    //anda sukses signin
                                    // mendapatkan akun dalam bentuk array
                                    $akun = $ambil->fetch_assoc();

                                    // simpan di session pemilik
                                    $_SESSION["pemilik"] = $akun;
                                    echo "<script>alert('Selamat datang $akun[nama_pemilik]');</script>";
                                    echo "<script>location='index.php';</script>";
                                } else {
                                    // anda gagal signin
                                    echo "<script>alert('Anda gagal sign In !');</script>";
                                    echo "<script>location='login.php';</script>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../admin/assets/js/off-canvas.js"></script>
    <script src="../admin/assets/js/hoverable-collapse.js"></script>
    <script src="../admin/assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>