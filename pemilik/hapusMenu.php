<h2>Halaman Hapus Menu</h2>

<?php include '../koneksi.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotomenu = $pecah['foto_menu'];
if (file_exists("../menu_kedai/$fotomenu")) {
    unlink("../menu_kedai/$fotomenu");
}


$koneksi->query("DELETE FROM menu WHERE id_menu='$_GET[id]'");
echo "<script>alert('Data Telah Dihapus');</script>";
echo "<script>location='daftarMenu.php';</script>";
?>