<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">

    <h2 class="text-2xl font-bold text-primary mb-4">Tanggapi Laporan</h2>

    <p class="mb-2 text-gray-700 dark:text-gray-300">
        <strong>Pelapor:</strong> <?= htmlspecialchars($pengaduan['nama']) ?>
    </p>
    <p class="mb-4 text-gray-700 dark:text-gray-300">
        <strong>Isi Laporan:</strong><br>
        <?= htmlspecialchars($pengaduan['isi']) ?>
    </p>

    <?php if ($pengaduan['foto']): ?>
        <div class="mb-4">
            <img src="public/uploads/<?= htmlspecialchars($pengaduan['foto']) ?>" alt="Foto Laporan"
                 class="w-full rounded shadow object-cover">
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=storeTanggapan" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="pengaduan_id" value="<?= $pengaduan['id'] ?>">

        <textarea name="tanggapan" placeholder="Isi tanggapan Anda..." required
            class="w-full border rounded px-3 py-2 min-h-[100px] bg-gray-50 dark:bg-gray-700 dark:text-white"></textarea>

        <select name="status" required class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
            <option value="">-- Pilih Status --</option>
            <option value="pending">pending</option>
            <option value="proses">Sedang Diproses</option>
            <option value="selesai">Selesai</option>
        </select>

        <label class="block text-sm text-gray-600 dark:text-gray-400 font-medium">Upload Bukti Tindakan (Opsional):</label>
        <input type="file" name="foto_tanggapan" accept="image/*"
               class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">

        <button type="submit"
                class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-2 rounded">
            Kirim Tanggapan 📤
        </button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
