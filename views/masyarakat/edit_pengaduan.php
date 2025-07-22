<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="p-6 bg-white dark:bg-gray-800 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-primary">Edit Laporan Pengaduan</h2>

    <form action="index.php?action=updatePengaduan" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($pengaduan['id']) ?>">

        <div class="mb-4">
            <label for="isi" class="block font-semibold">Isi Laporan</label>
            <textarea name="isi" id="isi" class="w-full p-2 border rounded"><?= htmlspecialchars($pengaduan['isi']) ?></textarea>
        </div>

        <div class="mb-4">
            <label for="foto" class="block font-semibold">Foto (Opsional)</label>
            <?php if (!empty($pengaduan['foto'])): ?>
                <img src="public/uploads/<?= htmlspecialchars($pengaduan['foto']) ?>" alt="Foto" class="h-24 mb-2">
            <?php endif; ?>
            <input type="file" name="foto" id="foto" class="w-full">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update Laporan</button>
        <a href="index.php?action=masyarakatDashboard" class="ml-4 text-gray-600 hover:underline">Kembali</a>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
