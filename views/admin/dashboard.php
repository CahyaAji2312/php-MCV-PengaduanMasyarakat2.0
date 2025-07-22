<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <a href="index.php?action=tambahPetugas"
            class="bg-primary hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow text-center">
            ➕ Tambah Akun Petugas
        </a>
        <a href="index.php?action=exportPDF"
            class="bg-secondary hover:bg-orange-600 text-white font-semibold py-3 rounded-lg shadow text-center">
            📄 Generate Laporan PDF
        </a>
        <a href="index.php?action=daftarPetugas"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow text-center">
            👥 Daftar Petugas
        </a>
    </div>

    <?php include __DIR__ . '/../laporan/daftar_pengaduan.php'; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
