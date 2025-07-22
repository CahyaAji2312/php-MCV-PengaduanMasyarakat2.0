<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="p-6 bg-white dark:bg-gray-800 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Petugas</h2>
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="border p-2">Nama</th>
                <th class="border p-2">Username</th>
                <th class="border p-2">Tanggal Dibuat</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($petugas as $p): ?>
            <tr>
                <td class="border p-2"><?= htmlspecialchars($p['nama']) ?></td>
                <td class="border p-2"><?= htmlspecialchars($p['username']) ?></td>
                <td class="border p-2">
                    <?= date('d-m-Y H:i', strtotime($p['created_at'])) . ' WIB' ?> 
                </td>
                <td class="border p-2">
                    <a href="index.php?action=editPetugas&id=<?= $p['id'] ?>" class="text-blue-600">✏️ Edit</a> |
                    <a href="index.php?action=hapusPetugas&id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600">🗑️ Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
