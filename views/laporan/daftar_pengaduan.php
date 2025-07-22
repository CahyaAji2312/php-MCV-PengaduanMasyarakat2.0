    <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-primary mb-4">Daftar Laporan Pengaduan</h2>

        <?php if (count($pengaduan) === 0): ?>
            <p class="text-gray-500 dark:text-gray-400">Belum ada pengaduan tersedia.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm border rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Pelapor</th>
                            <th class="px-4 py-2 border">Isi Laporan</th>
                            <th class="px-4 py-2 border">Foto</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <?php $no = 1; foreach ($pengaduan as $p): ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border px-4 py-2"><?= $no++ ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($p['nama']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($p['isi']) ?></td>
                                <td class="border px-4 py-2">   
                                    <?php if ($p['foto']): ?>
                                        <img src="public/uploads/<?= htmlspecialchars($p['foto']) ?>" 
                                            alt="Foto Laporan" class="w-16 h-16 rounded object-cover mx-auto">
                                    <?php else: ?>
                                        <span class="text-gray-400">Tidak ada foto</span>
                                    <?php endif; ?>
                                </td>
                                <td class="border px-4 py-2 capitalize">
                                    <span class="<?= 
                                $p['status'] === 'selesai' ? 'text-green-600 font-semibold' : 
                                ($p['status'] === 'proses' ? 'text-yellow-500 font-semibold' : 
                                ($p['status'] === 'pending' ? 'text-red-500 font-semibold' : '')) 
                            ?>">
                                <?= htmlspecialchars($p['status']) ?>
                            </span>
                                </td>
                                <td class="border px-4 py-2"> 
                                    <?= formatTanggal($p['tanggal']) ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
