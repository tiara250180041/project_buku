<?php
function hitungTotalNilaiStok(array $dataProducts) {
    $totalNilai = 0;
    foreach ($dataProducts as $product) {
        $totalNilai += ($product['harga'] * $product['stok']);
    }
    return $totalNilai;
}

function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function cariProduk(array $dataProducts, $keyword) {
    $hasil = [];
    foreach ($dataProducts as $product) {
        if (stripos($product['nama'], $keyword) !== false || stripos($product['kategori'], $keyword) !== false) {
            $hasil[] = $product;
        }
    }
    return $hasil;
}

function hitungStokKritis(array $dataProducts) {
    $jumlah = 0;
    foreach ($dataProducts as $product) {
        if ($product['stok'] < 3) {
            $jumlah++;
        }
    }
    return $jumlah;
}

function filterKategori(array $dataProducts, $kategoriPilihan) {
    if (empty($kategoriPilihan) || $kategoriPilihan == 'Semua') {
        return $dataProducts;
    }
    $hasil = [];
    foreach ($dataProducts as $product) {
        if (strtolower($product['kategori']) == strtolower($kategoriPilihan)) {
            $hasil[] = $product;
        }
    }
    return $hasil;
}

function tambahProdukBaru() {
    if (isset($_POST['submit'])) {
        $bukuBaru = [
            'id' => $_POST['id'],
            'nama' => $_POST['nama'],
            'kategori' => $_POST['kategori'],
            'harga' => (int)$_POST['harga'],
            'stok' => (int)$_POST['stok']
        ];
        
        $_SESSION['extra_products'][] = $bukuBaru;
        
        header("Location: index.php?status=sukses");
        exit;
    }
}
?>