<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-image: url(bg.jpg);
        background-size: cover;
        background-position: center;
        font-family: sans-serif;
        width: 100%;
        height: 100vh;
        background-repeat: no-repeat;
    }

    .form-box {
        width: 330px;
        height: 280px;
        background: #ffffffb8;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        padding: 40px 0;
        color: black;
        box-shadow: 0 1rem 9rem rgb(249 169 23 / 32%) !important;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .input-box {
        margin: 31px auto;
        width: 80%;
        border-bottom: 1px solid #000;
        padding-top: 8px;
        padding-bottom: 3px;
    }

    .input-box input {
        width: 80%;
        border: none;
        outline: none;
        background: transparent;
        color: #000;
        height: 20px;
        font-size: 14px;
    }

    .fa {
        margin-right: 10px;
    }

    .eye {
        position: absolute;
        cursor: pointer;
    }

    #hide1 {
        display: none;
    }

    .login-btn {
        margin: 40px auto 20px;
        width: 80%;
        display: block;
        outline: none;
        padding: 10px 0;
        border: 1px solid #000;
        cursor: pointer;
        background: transparent;
        color: #000;
        font-size: 16px;
    }

    .form-box button[type="submit"]:hover {
        border: 1px solid transparent;
        background: rgba(0, 0, 0, .7);
        color: #fff;
        transition: all 0.3s ease;
    }

    .form-box a {
        text-decoration: none;
        font-size: 12px;
        margin-left: 2px;
        margin-right: 2px;
        color: #000;
    }

    .form-box a:hover {
        color: #3F8EF9;
    }

    /* ::placeholder {
        color: #000;
    } */
</style>

<body>

    <!-- LOGIN PEMBELI -->
    <div class="form-box">
        <h1>Login</h1>
        <form action="" method="POST">
            <div class="input-box">
                <i class="fa fa-envelope"></i>
                <input type="email" class="form-control" name="email" placeholder="Masukan Email" autofocus="" required="" autocomplete="off">
            </div>
            <div class="input-box">
                <i class="fa fa-key"></i>
                <input type="password" id="myInput" class="form-control" name="password" placeholder="Masukan Password" autofocus="" required="" autocomplete="off">
                <span class="eye" onclick="lihatPassword()">
                    <i id="hide1" class="fa-regular fa-eye"></i>
                    <i id="hide2" class="fa-regular fa-eye-slash"></i>
                </span>
            </div>
            <button type="submit" class="login-btn" name="login">LOGIN</button>
            <center style="font-size: 12px;">Belum punya akun?<a href="daftar_pembeli.php" class="animated zoomIn" style="animation-delay: 1.9s;">Signup Now</a></center>
        </form>
    </div>


    <?php
    // jika ada tombol login (tombol login ditekan)
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // lakukan query cek akun di tabel pembeli pada database
        $ambil = $koneksi->query("SELECT * FROM pembeli WHERE email = '$email' AND password = 
			'$password'");

        // hitung akun yang terambil
        $akunyangcocok = $ambil->num_rows;

        // jika 1 akun yang cocok maka diloginkan
        if ($akunyangcocok == 1) {
            //anda sukses login
            // mendapatkan akun dalam bentuk array
            $akun = $ambil->fetch_assoc();

            // simpan di session pembeli
            $_SESSION["pembeli"] = $akun;
            echo "<script>alert('Selamat Datang $akun[nama]');</script>";

            // jika sudah belanja
            if (isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"])) {
                echo "<script>location='checkout.php';</script>";
            } else {
                echo "<script>location='index.php';</script>";
            }
        } else {
            // anda gagal login
            echo "<script>alert('Anda Gagal Login Mohon Periksa Kembali Akun Anda');</script>";
            echo "<script>location='login_pembeli.php';</script>";
        }
    }
    ?>
    <!-- END LOGIN PEMBELI -->



    <script src="https://kit.fontawesome.com/943a58e089.js" crossorigin="anonymous"></script>
    <script>
        function lihatPassword() {
            var x = document.getElementById("myInput"),
                y = document.getElementById("hide1"),
                z = document.getElementById("hide2");

            if (x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            } else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }
    </script>
</body>

</html>