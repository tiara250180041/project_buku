<?php
session_start();
require_once 'products.php';
require_once 'functions.php';G

// Panggil fungsi simpan jika tombol diklik
if (isset($_POST['submit'])) {
    tambahProdukBaru();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku Baru</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 min-h-screen p-8 text-slate-100 flex items-center justify-center">
    <div class="max-w-xl w-full bg-slate-900/90 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-indigo-500/20">
        <h1 class="text-2xl font-black text-white mb-6 flex items-center gap-3">
            <span class="bg-indigo-600 p-2 rounded-xl text-lg">➕</span> Tambah Buku Baru
        </h1>
        
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-indigo-300 mb-1">ID Buku</label>
                <input type="text" name="id" placeholder="Contoh: BK-008" required class="bg-slate-950/60 border border-indigo-500/30 rounded-xl px-4 py-3 text-sm text-white w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-indigo-300 mb-1">Judul Buku</label>
                <input type="text" name="nama" placeholder="Masukkan judul buku..." required class="bg-slate-950/60 border border-indigo-500/30 rounded-xl px-4 py-3 text-sm text-white w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-indigo-300 mb-1">Kategori</label>
                <input type="text" name="kategori" placeholder="Contoh: Edukasi, Fiksi, Teknologi" required class="bg-slate-950/60 border border-indigo-500/30 rounded-xl px-4 py-3 text-sm text-white w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-300 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" placeholder="95000" required class="bg-slate-950/60 border border-indigo-500/30 rounded-xl px-4 py-3 text-sm text-white w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-300 mb-1">Stok</label>
                    <input type="number" name="stok" placeholder="5" required class="bg-slate-950/60 border border-indigo-500/30 rounded-xl px-4 py-3 text-sm text-white w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="submit" name="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-lg shadow-indigo-600/30 flex-1">Simpan Buku</button>
                <a href="index.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-6 py-3 rounded-xl text-sm font-bold transition border border-indigo-500/20 text-center">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>