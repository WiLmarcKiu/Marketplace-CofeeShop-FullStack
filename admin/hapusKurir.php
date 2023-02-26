<h2>Halaman Hapus Kurir</h2>

<?php include '../koneksi.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM kurir WHERE id_kurir='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM kurir WHERE id_kurir='$_GET[id]'");
echo "<script>alert('Data Telah Dihapus');</script>";
echo "<script>location='daftarKurir.php';</script>";
?>