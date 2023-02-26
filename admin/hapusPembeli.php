<h2>Hapus Data Pembeli</h2>

<?php include '../koneksi.php'; ?>

<?php
$ambil = $koneksi->query("SELECT * FROM pembeli WHERE id_pembeli='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM pembeli WHERE id_pembeli='$_GET[id]'");
echo "<script>alert('Data Telah Dihapus');</script>";
echo "<script>location='daftarPembeli.php';</script>";
?>