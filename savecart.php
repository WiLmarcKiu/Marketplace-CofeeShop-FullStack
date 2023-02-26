<?php
session_start();
foreach ($_SESSION as $produk) {
    foreach (array_keys($produk) as $key) {
        $jumlah = $produk[$key];
        $id_produk = $key;
        echo 'produk ' . $id_produk . ' = ' . $jumlah . ' harga = ' . ($jumlah * 5000);
    }
}

$sql = "DELETE FROM `tabelPembelian` WHERE NOW() > DATE(`tanggal_pembelian` + 30)";
