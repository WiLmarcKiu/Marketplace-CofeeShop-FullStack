<?php
session_start();
$id_menu = $_GET["id"];
unset($_SESSION["keranjang"][$id_menu]);

echo "<script>alert('Menu Telah Dihapus Dari Keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
