<?php

session_start();

require_once "products.php";
require_once "functions.php";


// Menyimpan produk ke session
// agar perubahan stok tetap tersimpan
if (!isset($_SESSION["products"])) {
    $_SESSION["products"] = $products;
}

// Menyimpan data penjualan
if (!isset($_SESSION["penjualan"])) {
    $_SESSION["penjualan"] = [];
}

$products = $_SESSION["products"];
$penjualan = $_SESSION["penjualan"];


// PROSES TAMBAH / KURANG STOK
if (isset($_GET["jual"]) && isset($_GET["id"])) {

    $id = (int) $_GET["id"];
    $aksi = $_GET["jual"];

    foreach ($products as &$product) {

        if ($product["id"] == $id) {

            // Tambah stok
            if ($penjualan == "tambah") {

                $product["stok"]++;

            }

            // Kurang stok
            elseif ($penjualan == "kurang") {

                if ($product["stok"] > 0) {
                    $product["stok"]--;
                }

            }

            // Jual produk
            elseif ($penjualan == "jual") {

                if ($product["stok"] > 0) {

                    $product["stok"]--;

                    if (!isset($penjualan[$id])) {
                        $penjualan[$id] = 0;
                    }

                    $penjualan[$id]++;
                }
            }

            break;
        }
    }

    unset($product);


    // Simpan perubahan
    $_SESSION["products"] = $products;
    $_SESSION["penjualan"] = $penjualan;


    header("Location: index.php");
    exit;
}


// ==========================================
// HITUNG DATA
// ==========================================

$totalProduk = hitungJumlahProduk($products);

$totalStok = hitungTotalStok($products);

$totalNilaiStok = hitungTotalNilaiStok($products);

$totalPendapatan = hitungPendapatan(
    $products,
    $penjualan
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Product Information System</title>

    <link rel="stylesheet"
          href="style.css">

</head>


<body>


<div class="container">


    <!-- JUDUL -->

    <div class="header">

        <div>

            <h1>
                Penjualan produk
            </h1>

            <p>
                Sistem Informasi Data Produk
            </p>

        </div>

        <div class="tanggal">

            <?= date("d M Y"); ?>

        </div>

    </div>


    <!-- RINGKASAN -->

    <div class="summary">

        <div class="summary-item">

            <span>
                Total Produk
            </span>

            <strong>
                <?= $totalProduk; ?>
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Total Stok
            </span>

            <strong>
                <?= $totalStok; ?> unit
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Nilai Total Stok
            </span>

            <strong>
                <?= rupiah($totalNilaiStok); ?>
            </strong>

        </div>


        <div class="summary-item">

            <span>
                Pendapatan Penjualan
            </span>

            <strong>
                <?= rupiah($totalPendapatan); ?>
            </strong>

        </div>

    </div>


    <!-- TABEL PRODUK -->

    <div class="table-box">

        <div class="table-title">

            <div>

                <h2>
                    Daftar Produk
                </h2>

                <p>
                    Informasi produk dan pengelolaan stok
                </p>

            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>PRODUK</th>

                        <th>KATEGORI</th>

                        <th>HARGA</th>

                        <th>STOK</th>

                        <th>STATUS</th>

                        <th>NILAI STOK</th>

                        <th>TERJUAL</th>

                        <th>AKSI</th>

                    </tr>

                </thead>


                <tbody>


                <?php foreach ($products as $product): ?>

                    <?php

                    $id = $product["id"];

                    $nilaiStok =
                        $product["harga"] *
                        $product["stok"];

                    $jumlahTerjual =
                        $penjualan[$id] ?? 0;

                    $status =
                        statusStok(
                            $product["stok"]
                        );

                    $class =
                        classStok(
                            $product["stok"]
                        );

                    ?>


                    <tr class="<?= $class; ?>">


                        <!-- ID -->

                        <td>

                            <span class="id">
                                #<?= $product["id"]; ?>
                            </span>

                        </td>


                        <!-- PRODUK -->

                        <td>

                            <div class="product">

                                <div class="product-icon">
                                    📦
                                </div>

                                <div>

                                    <strong>
                                        <?= $product["nama"]; ?>
                                    </strong>

                                    <small>
                                        <?= $product["deskripsi"]; ?>
                                    </small>

                                </div>

                            </div>

                        </td>


                        <!-- KATEGORI -->

                        <td>

                            <span class="kategori">

                                <?= $product["kategori"]; ?>

                            </span>

                        </td>


                        <!-- HARGA -->

                        <td>

                            <strong class="harga">

                                <?= rupiah(
                                    $product["harga"]
                                ); ?>

                            </strong>

                        </td>


                        <!-- STOK -->

                        <td>

                            <strong class="jumlah-stok">

                                <?= $product["stok"]; ?>

                            </strong>

                            <small>
                                unit
                            </small>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <span class="status">

                                <?= $status; ?>

                            </span>

                        </td>


                        <!-- NILAI STOK -->

                        <td>

                            <strong>

                                <?= rupiah(
                                    $nilaiStok
                                ); ?>

                            </strong>

                        </td>


                        <!-- TERJUAL -->

                        <td>

                            <span class="terjual">

                                <?= $jumlahTerjual; ?>

                            </span>

                        </td>


                        <!-- AKSI -->

                        <td>

                            <div class="aksi">

                                <a
                                    href="index.php?aksi=kurang&id=<?= $id; ?>"
                                    class="btn kurang"
                                    title="Kurangi stok"
                                >
                                    −
                                </a>


                                <a
                                    href="index.php?aksi=tambah&id=<?= $id; ?>"
                                    class="btn tambah"
                                    title="Tambah stok"
                                >
                                    +
                                </a>


                                <a
                                    href="index.php?aksi=jual&id=<?= $id; ?>"
                                    class="btn jual"
                                    title="Jual produk"
                                >
                                    Jual
                                </a>

                            </div>

                        </td>


                    </tr>


                <?php endforeach; ?>


                </tbody>

            </table>

        </div>

    </div>


    <!-- KETERANGAN -->

    <div class="keterangan">

        <div>

            <span class="legend aman"></span>

            Stok Aman

        </div>

        <div>

            <span class="legend menipis"></span>

            Stok Menipis

        </div>

        <div>

            <span class="legend kritis"></span>

            Stok Kritis (&lt; 3)

        </div>

    </div>


    <footer>

        Product Information System &copy; 2026

    </footer>


</div>


</body>

</html>