<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#f97316'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white">

<header class="bg-white dark:bg-gray-800 shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Logo" class="w-8 h-8">
            <h1 class="font-bold text-lg text-primary">Pengaduan Masyarakat</h1>
        </div>
        <div class="space-x-4">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="text-sm"><?= htmlspecialchars($_SESSION['user']['nama']) ?> (<?= $_SESSION['user']['role'] ?>)</span>
                <a href="index.php?action=logout" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Logout</a>
            <?php else: ?>
                <a href="index.php?action=login" class="bg-primary text-white px-3 py-1 rounded text-sm">Login</a>
                <a href="index.php?action=register" class="bg-secondary text-white px-3 py-1 rounded text-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-6">
