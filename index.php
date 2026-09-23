<?php
session_start();
require_once 'products.php';
require_once 'functions.php';

if (!isset($_SESSION['extra_products'])) {
    $_SESSION['extra_products'] = [];
}
$semuaProduk = array_merge($products, $_SESSION['extra_products']);

$keyword = $_GET['cari'] ?? '';
$kategoriFilter = $_GET['kategori'] ?? 'Semua';
$statusTambah = $_GET['status'] ?? '';

$dataTampil = $semuaProduk;
if ($keyword) {
    $dataTampil = cariProduk($dataTampil, $keyword);
}
if ($kategoriFilter && $kategoriFilter != 'Semua') {
    $dataTampil = filterKategori($dataTampil, $kategoriFilter);
}

$totalAset = hitungTotalNilaiStok($dataTampil);
$totalJenis = count($semuaProduk);
$totalKritis = hitungStokKritis($semuaProduk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bookstore Enterprise Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 min-h-screen p-8 text-slate-100">
    <div class="max-w-6xl mx-auto bg-slate-900/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-indigo-500/20">
        
        <?php if ($statusTambah == 'sukses'): ?>
            <div class="mb-6 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-5 py-3 rounded-2xl text-sm font-semibold flex items-center justify-between shadow-lg">
                <span>✨ Berhasil! Buku baru telah ditambahkan ke dalam sistem inventaris.</span>
                <a href="index.php" class="text-emerald-400 hover:text-white font-bold text-xs uppercase">Tutup</a>
            </div>
        <?php endif; ?>

        <div class="mb-8 border-b border-indigo-500/20 pb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-white flex items-center gap-3">
                    <span class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-500/30 text-xl">📚</span> 
                    Bookstore Enterprise
                </h1>
                <p class="text-sm text-indigo-300/70 mt-1">Sistem Manajemen Inventaris Buku Berbasis Arsitektur Modular PHP</p>
            </div>
            <div class="bg-indigo-950/80 border border-indigo-500/30 px-4 py-2 rounded-2xl text-xs font-semibold text-indigo-300">
                Status: <span class="text-emerald-400 font-bold">● Live Server</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-violet-600 to-indigo-700 text-white p-6 rounded-3xl shadow-xl shadow-indigo-900/50 flex flex-col justify-between border border-white/10">
                <span class="text-xs uppercase tracking-widest font-bold text-indigo-200">Total Jenis Produk</span>
                <span class="text-4xl font-black mt-3"><?= $totalJenis ?> <span class="text-lg font-normal text-indigo-200">Item</span></span>
            </div>
            <div class="bg-gradient-to-br from-blue-600 to-cyan-700 text-white p-6 rounded-3xl shadow-xl shadow-blue-900/50 flex flex-col justify-between border border-white/10">
                <span class="text-xs uppercase tracking-widest font-bold text-blue-200">Total Nilai Aset</span>
                <span class="text-3xl font-black mt-3"><?= formatRupiah($totalAset) ?></span>
            </div>
            <div class="bg-gradient-to-br from-amber-600 to-orange-700 text-white p-6 rounded-3xl shadow-xl shadow-orange-900/50 flex flex-col justify-between border border-white/10">
                <span class="text-xs uppercase tracking-widest font-bold text-amber-200">Stok Kritis (< 3)</span>
                <span class="text-4xl font-black mt-3"><?= $totalKritis ?> <span class="text-lg font-normal text-amber-200">Item</span></span>
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <span class="text-xs font-bold text-indigo-300 uppercase mr-2">Filter Kategori:</span>
            <?php foreach(['Semua', 'Edukasi', 'Fiksi', 'Teknologi', 'Pengembangan Diri'] as $kat): ?>
                <a href="?kategori=<?= $kat ?><?php echo $keyword ? '&cari='.$keyword : ''; ?>" class="px-4 py-1.5 rounded-xl text-xs font-bold transition <?= ($kategoriFilter == $kat) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 border border-indigo-500/20' ?>">
                    <?= $kat ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <form method="GET" class="flex gap-2 w-full md:w-2/3">
                <input type="hidden" name="kategori" value="<?= htmlspecialchars($kategoriFilter) ?>">
                <input type="text" name="cari" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari judul buku atau kategori..." class="bg-slate-950/60 border border-indigo-500/30 rounded-2xl px-5 py-3 text-sm text-white placeholder-slate-400 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-2xl text-sm font-bold transition shadow-lg shadow-indigo-600/30">Cari</button>
                <?php if ($keyword || $kategoriFilter != 'Semua'): ?>
                    <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-3 rounded-2xl text-sm font-bold transition border border-indigo-500/20 flex items-center justify-center" title="Reset Filter">🔄 Reset</a>
                <?php endif; ?>
            </form>
            <a href="tambah.php" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white px-6 py-3 rounded-2xl text-sm font-bold transition shadow-lg shadow-emerald-900/30 w-full md:w-auto text-center">+ Tambah Buku</a>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-indigo-500/20 bg-slate-950/40">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-indigo-950/80 text-indigo-300 text-xs uppercase tracking-wider border-b border-indigo-500/20">
                        <th class="p-4">ID Buku</th>
                        <th class="p-4">Judul Buku</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4 text-center">Stok</th>
                        <th class="p-4 text-center">Status Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-500/10 text-sm">
                    <?php if (empty($dataTampil)): ?>
                        <tr><td colspan="6" class="p-8 text-center text-slate-400 italic">Buku tidak ditemukan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($dataTampil as $p): ?>
                            <?php 
                                $isKritis = $p['stok'] < 3;
                                $warnaBaris = $isKritis ? 'bg-rose-950/30 hover:bg-rose-900/35' : 'hover:bg-indigo-900/20';
                            ?>
                            <tr class="<?= $warnaBaris ?> transition">
                                <td class="p-4 font-mono font-medium text-indigo-300"><?= $p['id'] ?></td>
                                <td class="p-4 font-bold text-white"><?= $p['nama'] ?></td>
                                <td class="p-4">
                                    <span class="bg-indigo-900/60 border border-indigo-500/30 text-indigo-200 px-3 py-1 rounded-xl text-xs font-semibold"><?= $p['kategori'] ?></span>
                                </td>
                                <td class="p-4 font-medium text-slate-200"><?= formatRupiah($p['harga']) ?></td>
                                <td class="p-4 text-center font-extrabold text-white"><?= $p['stok'] ?></td>
                                <td class="p-4 text-center">
                                    <?php if ($isKritis): ?>
                                        <span class="bg-rose-500/20 border border-rose-500/40 text-rose-300 px-3 py-1 rounded-full text-xs font-bold inline-block">⚠️ Kritis</span>
                                    <?php else: ?>
                                        <span class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-3 py-1 rounded-full text-xs font-bold inline-block">✅ Aman</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>