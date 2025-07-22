<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-4 text-secondary">Registrasi Masyarakat</h2>

    <form method="POST" action="index.php?action=storeRegister" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="nama" placeholder="Nama Lengkap" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <input type="text" name="username" placeholder="Username" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <input type="password" name="password" placeholder="Password" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">

        <button type="submit"
            class="w-full bg-secondary hover:bg-orange-600 text-white font-semibold py-2 rounded">
            Daftar
        </button>
    </form>

    <p class="mt-4 text-center text-sm">
        Sudah punya akun? <a href="index.php?action=login" class="text-primary hover:underline">Login di sini</a>
    </p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
