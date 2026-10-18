<?php

// Menghitung total nilai stok
function hitungTotalNilaiStok($products)
{
    $total = 0;

    foreach ($products as $product) {
        $total += $product["harga"] * $product["stok"];
    }

    return $total;
}


// Menghitung jumlah seluruh stok
function hitungTotalStok($products)
{
    $total = 0;

    foreach ($products as $product) {
        $total += $product["stok"];
    }

    return $total;
}


// Menghitung jumlah produk
function hitungJumlahProduk($products)
{
    return count($products);
}


// Menentukan status stok
function statusStok($stok)
{
    if ($stok < 3) {
        return "Kritis";
    } elseif ($stok <= 5) {
        return "Menipis";
    } else {
        return "Aman";
    }
}


// Menentukan class warna stok
function classStok($stok)
{
    if ($stok < 3) {
        return "stok-kritis";
    } elseif ($stok <= 5) {
        return "stok-menipis";
    } else {
        return "stok-aman";
    }
}


// Menghitung total pendapatan
function hitungPendapatan($products, $penjualan)
{
    $total = 0;

    foreach ($products as $product) {

        $id = $product["id"];

        if (isset($penjualan[$id])) {
            $total += $product["harga"] * $penjualan[$id];
        }
    }

    return $total;
}


// Format Rupiah
function rupiah($angka)
{
    return "Rp " . number_format(
        $angka,
        0,
        ",",
        "."
    );
}