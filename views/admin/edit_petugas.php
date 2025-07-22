<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Edit Petugas</h2>
    <form action="index.php?action=updatePetugas" method="POST">
        <input type="hidden" name="id" value="<?= $petugas['id'] ?>">

        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" required class="w-full border px-3 py-2 rounded"
                value="<?= htmlspecialchars($petugas['nama']) ?>">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Username</label>
            <input type="text" name="username" required class="w-full border px-3 py-2 rounded"
                value="<?= htmlspecialchars($petugas['username']) ?>">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex justify-between">
            <a href="index.php?action=daftarPetugas" class="text-gray-500">← Kembali</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
