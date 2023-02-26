<?php
session_start();
if (!isset($_SESSION['pemilik'])) {
    echo "<script>alert('Anda belum Sign In');</script>";
    echo "<script>location='login.php';</script>";
    exit;
}
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Coffee Shop</title>
    <!-- ../admin/plugins:css -->
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
    <!-- DataTables -->
    <link rel="stylesheet" href="../admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<style>
    .dropdown-menu[data-bs-popper] {
        left: unset !important;
        right: 0 !important;
    }

    .chartjs-render-monitor {
        display: block !important;
        width: 100% !important;
        height: 230px !important;
    }

    nav .breadcrumb .breadcrumb-item a {
        text-decoration: none !important;
        color: #000;
    }

    nav .breadcrumb .breadcrumb-item a:hover {
        color: #B66DFF;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include 'navTop.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include 'navSide.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Kedai
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kedai</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profil Kedai</h4>
                            <hr>
                            <?php $id_kedai = $_SESSION['pemilik']['id_kedai']; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM kedai WHERE id_kedai = '$id_kedai'"); ?>
                            <?php $pecah = $ambil->fetch_assoc() ?>
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="../gambar_kedai/<?php echo $pecah['logo_kedai']; ?>" style="width: 100%; height: 40vh; vertical-align: middle;" alt=""><br><br>
                                    <a href="" class="btn btn-gradient-primary d-grid">Ubah Data</a>
                                </div>
                                <div class="col-lg-9">
                                    <table class="table table-hover noborder">
                                        <tbody>
                                            <tr>
                                                <td>Nama Kedai</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['nama_kedai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Daftar</td>
                                                <td>:</td>
                                                <td><?php echo date("d F Y", strtotime($pecah['tanggal_daftar'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telepon Kedai</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['telepon_kedai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Kedai</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['email_kedai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Kedai</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['alamat_kedai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank / No. Rekening</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['bank']; ?>, <?php echo $pecah['no_rekening']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Pemilik</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['nama_pemilik']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['nik']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat / Tanggal Lahir</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['tempat_lahir']; ?>, <?php echo date("d F Y", strtotime($pecah['tanggal_lahir'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['jk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Pemilik</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['alamat_pemilik']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email / Password Pemilik</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['email_pemilik']; ?>, <?php echo $pecah['password']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Username / Telepon Pemilik</td>
                                                <td>:</td>
                                                <td><?php echo $pecah['username']; ?> (<?php echo $pecah['telepon_pemilik']; ?>)</td>
                                            </tr>


                                            <!-- Modal Ubah Data -->
                                            <div class="modal fade" id="ModalUbah<?php echo $pecah['id_kedai']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel">Ubah Kedai</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" enctype="multipart/form-data" action="daftarKedai.php?id=<?php echo $pecah['id_kedai']; ?>">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Kedai :</label>
                                                                    <input type="text" class="form-control" name="nama_kedai" value="<?php echo $pecah['nama_kedai']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Telepon Kedai :</label>
                                                                    <input type="number" class="form-control" name="telepon_kedai" value="<?php echo $pecah['telepon_kedai']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Email Kedai :</label>
                                                                    <input type="email" class="form-control" name="email_kedai" value="<?php echo $pecah['email_kedai']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Alamat Kedai :</label>
                                                                    <textarea class="form-control" name="alamat_kedai"><?php echo $pecah['alamat_kedai']; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">No. Rekening :</label>
                                                                    <input type="number" class="form-control" name="no_rekening" value="<?php echo $pecah['no_rekening']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Bank :</label>
                                                                    <select class="form-control form-control-lg" name="bank" required>
                                                                        <option value="">Pilih Jenis Bank</option>
                                                                        <option <?php if ($pecah['bank'] == 'BANK BRI') {
                                                                                    echo "selected";
                                                                                } ?> value='BANK BRI'>BANK BRI</option>
                                                                        <option <?php if ($pecah['bank'] == 'BANK BCA') {
                                                                                    echo "selected";
                                                                                } ?> value='BANK BCA'>BANK BCA</option>
                                                                        <option <?php if ($pecah['bank'] == 'BANK MANDIRI') {
                                                                                    echo "selected";
                                                                                } ?> value='BANK MANDIRI'>BANK MANDIRI</option>
                                                                        <option <?php if ($pecah['bank'] == 'BANK NTT') {
                                                                                    echo "selected";
                                                                                } ?> value='BANK NTT'>BANK NTT</option>
                                                                        <option <?php if ($pecah['bank'] == 'BANK BNI') {
                                                                                    echo "selected";
                                                                                } ?> value='BANK BNI'>BANK BNI</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Rek Atas Nama :</label>
                                                                    <input type="text" class="form-control" name="rekening_atas_nama" value="<?php echo $pecah['rekening_atas_nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <img src="../gambar_kedai/<?php echo $pecah['logo_kedai']; ?>" alt="" width="450">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Logo Kedai :</label>
                                                                    <input type="file" class="form-control" name="logo_kedai">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Pemilik :</label>
                                                                    <input type="text" class="form-control" name="nama_pemilik" value="<?php echo $pecah['nama_pemilik']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">NIK Pemilik :</label>
                                                                    <input type="number" class="form-control" name="nik" value="<?php echo $pecah['nik']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Tempat Lahir Pemilik :</label>
                                                                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $pecah['tempat_lahir']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Tanggal Lahir Pemilik :</label>
                                                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $pecah['tanggal_lahir']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Jenis Kelamin :</label>
                                                                    <select class="form-control form-control-lg" name="jk" required>
                                                                        <option value="">Pilih Jenis Kelamin</option>
                                                                        <option <?php if ($pecah['jk'] == 'Laki - Laki') {
                                                                                    echo "selected";
                                                                                } ?> value='Laki - Laki'>Laki - Laki</option>
                                                                        <option <?php if ($pecah['jk'] == 'Perempuan') {
                                                                                    echo "selected";
                                                                                } ?> value='Perempuan'>Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Alamat Pemilik :</label>
                                                                    <textarea class="form-control" name="alamat_pemilik"><?php echo $pecah['alamat_pemilik']; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Tanggal Daftar :</label>
                                                                    <input type="date" class="form-control" name="tanggal_daftar" value="<?php echo $pecah['tanggal_daftar']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Email Pemilik :</label>
                                                                    <input type="email" class="form-control" name="email_pemilik" value="<?php echo $pecah['email_pemilik']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Telepon Pemilik :</label>
                                                                    <input type="number" class="form-control" name="telepon_pemilik" value="<?php echo $pecah['telepon_pemilik']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Username :</label>
                                                                    <input type="text" class="form-control" name="username" value="<?php echo $pecah['username']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Password :</label>
                                                                    <input type="text" class="form-control" name="password" value="<?php echo $pecah['password']; ?>">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                        </form>
                                                        <?php
                                                        if (isset($_POST['ubah'])) {
                                                            $namafoto = $_FILES['logo_kedai']['name'];
                                                            $lokasifoto = $_FILES['logo_kedai']['tmp_name'];

                                                            // jika foto dirubah
                                                            if (!empty($lokasifoto)) {
                                                                move_uploaded_file($lokasifoto, "../gambar_kedai/$namafoto");
                                                                $sql = "UPDATE kedai SET nama_kedai = '$_POST[nama_kedai]',telepon_kedai = '$_POST[telepon_kedai]',email_kedai = '$_POST[email_kedai]',alamat_kedai = '$_POST[alamat_kedai]',no_rekening = '$_POST[no_rekening]',bank = '$_POST[bank]',rekening_atas_nama = '$_POST[rekening_atas_nama]',logo_kedai = '$namafoto',nama_pemilik = '$_POST[nama_pemilik]',nik = '$_POST[nik]',tempat_lahir = '$_POST[tempat_lahir]',tanggal_lahir = '$_POST[tanggal_lahir]',jk = '$_POST[jk]',alamat_pemilik = '$_POST[alamat_pemilik]',tanggal_daftar = '$_POST[tanggal_daftar]',email_pemilik = '$_POST[email_pemilik]',telepon_pemilik = '$_POST[telepon_pemilik]',username = '$_POST[username]',password = '$_POST[password]' WHERE id_kedai = '$_GET[id]'";
                                                            } else {
                                                                $sql = "UPDATE kedai SET nama_kedai = '$_POST[nama_kedai]',telepon_kedai = '$_POST[telepon_kedai]',email_kedai = '$_POST[email_kedai]',alamat_kedai = '$_POST[alamat_kedai]',no_rekening = '$_POST[no_rekening]',bank = '$_POST[bank]',rekening_atas_nama = '$_POST[rekening_atas_nama]',nama_pemilik = '$_POST[nama_pemilik]',nik = '$_POST[nik]',tempat_lahir = '$_POST[tempat_lahir]',tanggal_lahir = '$_POST[tanggal_lahir]',jk = '$_POST[jk]',alamat_pemilik = '$_POST[alamat_pemilik]',tanggal_daftar = '$_POST[tanggal_daftar]',email_pemilik = '$_POST[email_pemilik]',telepon_pemilik = '$_POST[telepon_pemilik]',username = '$_POST[username]',password = '$_POST[password]' WHERE id_kedai = '$_GET[id]'";
                                                            }

                                                            $koneksi->query($sql);
                                                            if ($koneksi) {

                                                                echo "<script>alert('Data Berhasil Diubah');</script>";
                                                                echo "<script>location='daftarkedai.php';</script>";
                                                            } else {
                                                                echo "<script>alert('Data Gagal Diubah');</script>";
                                                                echo "<script>history.back();</script>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal Ubah Data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include 'footer.php'; ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- jQuery -->
    <script src="../admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ../admin/plugins:js -->
    <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../admin/assets/js/off-canvas.js"></script>
    <script src="../admin/assets/js/hoverable-collapse.js"></script>
    <script src="../admin/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    <?php include 'jsDataTable.php'; ?>
</body>

</html>