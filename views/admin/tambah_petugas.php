<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-primary">Tambah Akun Petugas</h2>

    <form method="POST" action="index.php?action=storePetugas" class="space-y-4">
        <input type="text" name="nama" placeholder="Nama Petugas" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <input type="text" name="username" placeholder="Username" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <input type="password" name="password" placeholder="Password" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">

        <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-2 rounded">
            Simpan Akun Petugas
        </button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
