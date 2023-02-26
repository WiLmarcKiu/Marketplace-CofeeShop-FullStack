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
                            </span> Menu
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Menu</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Menu</h4>
                            <hr>
                            <a href="" class="btn btn-sm btn-gradient-success mb-3" data-toggle="modal" data-target="#ModalTambah"><i class="mdi mdi-plus"></i></a>
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>Foto</th>
                                            <th>Menu</th>
                                            <th>Kedai</th>
                                            <th>Harga</th>
                                            <th>Deskripsi</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id_kedai = $_SESSION['pemilik']['id_kedai']; ?>
                                        <?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT * FROM menu JOIN kedai ON menu.id_kedai=kedai.id_kedai WHERE menu.id_kedai = '$id_kedai'"); ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-gradient-primary" data-toggle="modal" data-target="#ModalUbah<?php echo $pecah['id_menu']; ?>" title="Ubah"><i class="mdi mdi-eyedropper"></i></a>
                                                    <a href="hapusMenu.php?id=<?php echo $pecah['id_menu']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-gradient-success" title="Hapus"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                                <td><img src="../menu_kedai/<?php echo $pecah['foto_menu']; ?>" style="width: 80px; height:80px; border-radius: 0;" class="rounded-circle" alt=""></td>
                                                <td><?php echo $pecah['nama_menu']; ?></td>
                                                <td><?php echo $pecah['nama_kedai']; ?></td>
                                                <td class="text-danger">Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
                                                <td>
                                                    <div class="text-200"><?php echo $pecah['deskripsi_menu']; ?></div>
                                                </td>
                                                <td><?php echo $pecah['stok_menu']; ?></td>
                                            </tr>


                                            <!-- Modal Ubah Data -->
                                            <div class="modal fade" id="ModalUbah<?php echo $pecah['id_menu']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel">Ubah Menu</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" enctype="multipart/form-data" action="daftarMenu.php?id=<?php echo $pecah['id_menu']; ?>">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Menu :</label>
                                                                    <input type="text" class="form-control" name="nama_menu" value="<?php echo $pecah['nama_menu']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Harga :</label>
                                                                    <input type="number" class="form-control" name="harga_menu" value="<?php echo $pecah['harga_menu']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Deskripsi :</label>
                                                                    <textarea class="form-control" name="deskripsi_menu"><?php echo $pecah['deskripsi_menu']; ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <img src="../menu_kedai/<?php echo $pecah['foto_menu']; ?>" alt="" width="450">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Foto : <?php echo $pecah['foto_menu']; ?></label>
                                                                    <input type="file" class="form-control" name="foto_menu">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Stok :</label>
                                                                    <input type="number" class="form-control" name="stok_menu" value="<?php echo $pecah['stok_menu']; ?>">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                        </form>
                                                        <?php
                                                        if (isset($_POST['ubah'])) {
                                                            $namafoto = $_FILES['foto_menu']['name'];
                                                            $lokasifoto = $_FILES['foto_menu']['tmp_name'];

                                                            // jika foto dirubah
                                                            if (!empty($lokasifoto)) {
                                                                move_uploaded_file($lokasifoto, "../menu_kedai/$namafoto");
                                                                $sql = "UPDATE menu SET nama_menu = '$_POST[nama_menu]',harga_menu = '$_POST[harga_menu]',deskripsi_menu = '$_POST[deskripsi_menu]',foto_menu = '$namafoto',stok_menu = '$_POST[stok_menu]' WHERE id_menu = '$_GET[id]'";
                                                            } else {
                                                                $sql = "UPDATE menu SET nama_menu = '$_POST[nama_menu]',harga_menu = '$_POST[harga_menu]',deskripsi_menu = '$_POST[deskripsi_menu]',stok_menu = '$_POST[stok_menu]' WHERE id_menu = '$_GET[id]'";
                                                            }

                                                            $koneksi->query($sql);
                                                            if ($koneksi) {

                                                                echo "<script>alert('Data Berhasil Diubah');</script>";
                                                                echo "<script>location='daftarMenu.php';</script>";
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


                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php

                        $datakedai = array();
                        $ambil = $koneksi->query("SELECT * FROM kedai");
                        while ($tiap = $ambil->fetch_assoc()) {
                            $datakedai[] = $tiap;
                        }
                        ?>

                        <!-- Modal Tambah Data -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Tambah Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label">Menu :</label>
                                                <input type="text" class="form-control" name="nama_menu" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Harga :</label>
                                                <input type="number" class="form-control" name="harga_menu" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Deskripsi :</label>
                                                <textarea class="form-control" name="deskripsi_menu" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Foto :</label>
                                                <input type="file" class="form-control" name="foto_menu" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Stok :</label>
                                                <input type="number" class="form-control" name="stok_menu" required>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="tambah">Tambah</button>
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                    </div>
                                    </form>
                                    <?php
                                    $id_kedai = $_SESSION['pemilik']['id_kedai'];
                                    if (isset($_POST['tambah'])) {
                                        $nama = $_FILES['foto_menu']['name'];
                                        $lokasi = $_FILES['foto_menu']['tmp_name'];
                                        move_uploaded_file($lokasi, "../menu_kedai/" . $nama);
                                        $koneksi->query("INSERT INTO menu
                                        (id_kedai,nama_menu,harga_menu,deskripsi_menu,foto_menu,stok_menu) VALUES ('$id_kedai','$_POST[nama_menu]','$_POST[harga_menu]','$_POST[deskripsi_menu]','$nama','$_POST[stok_menu]')");

                                        echo "<script>alert('Data Berhasil Ditambah');</script>";
                                        echo "<script>location='daftarMenu.php';</script>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Tambah Data -->


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
    <!-- DataTables  & ../admin/Plugins -->
    <?php include 'jsDataTable.php'; ?>
</body>

</html>