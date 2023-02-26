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
                            </span> Kurir
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kurir</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Kurir</h4>
                            <hr>
                            <a href="" class="btn btn-sm btn-gradient-primary mb-3" data-toggle="modal" data-target="#ModalTambah"><i class="mdi mdi-plus"></i></a>
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>Kurir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT * FROM kurir"); ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-gradient-primary" data-toggle="modal" data-target="#ModalUbah<?php echo $pecah['id_kurir']; ?>" title="Ubah"><i class="mdi mdi-eyedropper"></i></a>
                                                    <a href="hapusKurir.php?id=<?php echo $pecah['id_kurir']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-gradient-success" title="Hapus"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                                <td><?php echo $pecah['jenis_kurir']; ?></td>
                                            </tr>

                                            <!-- Modal Ubah Data -->
                                            <div class="modal fade" id="ModalUbah<?php echo $pecah['id_kurir']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel">Ubah Kurir</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" enctype="multipart/form-data" action="daftarKurir.php?id=<?php echo $pecah['id_kurir']; ?>">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Jenis Kurir :</label>
                                                                    <input type="text" class="form-control" name="jenis_kurir" value="<?php echo $pecah['jenis_kurir']; ?>">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                        </form>
                                                        <?php
                                                        if (isset($_POST['ubah'])) {
                                                            $koneksi->query("UPDATE kurir SET jenis_kurir = '$_POST[jenis_kurir]' WHERE id_kurir = '$_GET[id]'");

                                                            $koneksi->query($sql);
                                                            if ($koneksi) {

                                                                echo "<script>alert('Data Berhasil Diubah');</script>";
                                                                echo "<script>location='daftarKurir.php';</script>";
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


                        <!-- Modal Tambah Data -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Tambah Kurir</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label">Jenis Kurir :</label>
                                                <input type="text" class="form-control" name="jenis_kurir" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="tambah">Tambah</button>
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                                    </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['tambah'])) {
                                        $koneksi->query("INSERT INTO kurir (jenis_kurir) VALUES ('$_POST[jenis_kurir]')");

                                        echo "<script>alert('Data Berhasil Ditambah');</script>";
                                        echo "<script>location='daftarKurir.php';</script>";
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