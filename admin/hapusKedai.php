<h2>Halaman Hapus Kedai</h2>

<?php include '../koneksi.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM kedai WHERE id_kedai='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$logokedai = $pecah['logo_kedai'];
if (file_exists("../gambar_kedai/$logokedai")) {
    unlink("../gambar_kedai/$logokedai");
}


$koneksi->query("DELETE FROM kedai WHERE id_kedai='$_GET[id]'");
echo "<script>alert('Data Telah Dihapus');</script>";
echo "<script>location='daftarkedai.php';</script>";
?>