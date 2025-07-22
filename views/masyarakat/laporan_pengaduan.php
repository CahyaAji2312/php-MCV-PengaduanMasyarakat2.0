<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Laporan Pengaduan</h2>

    <form method="POST" action="index.php?action=storePengaduan" enctype="multipart/form-data" class="space-y-4">
        <textarea name="isi" placeholder="Tuliskan isi pengaduan Anda..." required
            class="w-full border rounded px-3 py-2 min-h-[100px] bg-gray-50 dark:bg-gray-700 dark:text-white"></textarea>

        <input type="file" name="foto" accept="image/*"
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">

        <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-2 rounded">
            📩 Laporan Pengaduan
        </button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
