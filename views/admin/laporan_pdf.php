<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
    <h2 class="text-xl font-bold mb-4">Laporan PDF</h2>
    <p class="mb-4 text-gray-700 dark:text-gray-300">
        Klik tombol di bawah untuk mengunduh semua laporan dalam format PDF.
    </p>
    <a href="index.php?action=exportPDF"
        class="bg-primary hover:bg-blue-700 text-white px-6 py-3 font-semibold rounded shadow">
        📥 Download PDF Laporan
    </a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
