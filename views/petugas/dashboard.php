<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Dashboard Petugas</h2>
    <p class="mb-4 text-gray-700 dark:text-gray-300">
        Selamat bertugas! Silakan cek laporan yang masuk dan tanggapi sesuai prosedur.
    </p>

    <?php if (count($pengaduan) === 0): ?>
        <p class="text-gray-500 dark:text-gray-400">Belum ada pengaduan masuk.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full border rounded-lg overflow-hidden text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Pelapor</th>
                        <th class="px-4 py-2 border">Isi Laporan</th>
                        <th class="px-4 py-2 border">Foto</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    <?php $no = 1; foreach ($pengaduan as $p): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2 border"><?= $no++ ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($p['nama']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($p['isi']) ?></td>
                            <td class="px-4 py-2 border">
                                    <?php if ($p['foto']): ?>
                                        <img src="public/uploads/<?= htmlspecialchars($p['foto']) ?>" alt="Bukti" class="h-16 object-cover rounded">
                                    <?php else: ?>
                                        <span class="text-gray-400 italic">Tidak ada foto</span>
                                    <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 border capitalize">
                               <span class="<?= 
                                $p['status'] === 'selesai' ? 'text-green-600 font-semibold' : 
                                ($p['status'] === 'proses' ? 'text-yellow-500 font-semibold' : 
                                ($p['status'] === 'pending' ? 'text-red-500 font-semibold' : '')) 
                            ?>">
                                <?= htmlspecialchars($p['status']) ?>
                            </span>
                            <td class="border px-4 py-2">
                                <?= formatTanggal($p['tanggal']) ?>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="index.php?action=tanggapi&id=<?= $p['id'] ?>"
                                   class="bg-primary hover:bg-blue-700 text-white px-3 py-1 rounded shadow text-xs">
                                    Tanggapi
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
