<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-4 text-primary">Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=authLogin" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <input type="password" name="password" placeholder="Password" required
            class="w-full border rounded px-3 py-2 bg-gray-50 dark:bg-gray-700 dark:text-white">
        <button type="submit"
            class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-2 rounded">
            Login
        </button>
    </form>

    <p class="mt-4 text-center text-sm">
        Belum punya akun? <a href="index.php?action=register" class="text-primary hover:underline">Daftar di sini</a>
    </p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
