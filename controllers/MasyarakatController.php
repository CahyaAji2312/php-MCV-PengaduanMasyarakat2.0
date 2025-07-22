<?php
require_once 'models/Pengaduan.php';
require_once 'helpers/Flash.php';

class MasyarakatController {
    private $pengaduanModel;

    public function __construct() {
        $this->pengaduanModel = new Pengaduan();
    }

    public function dashboard() {
        $pengaduan = $this->pengaduanModel->findByMasyarakat($_SESSION['user']['id']);
        include __DIR__ . '/../views/masyarakat/dashboard.php';
    }

    public function daftarpengaduan() {
        $pengaduan = $this->pengaduanModel->all();
        include __DIR__ . '/../views/laporan/daftar_pengaduan.php'; 
    }

    public function laporanPengaduan() {
        include __DIR__ . '/../views/masyarakat/laporan_pengaduan.php';
    }

    public function storePengaduan() {
        $foto = $_FILES['foto']['name'] ?? null;

        if ($foto) {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'public/uploads/' . $foto);
        }

        $data = [
            'masyarakat_id' => $_SESSION['user']['id'],
            'isi'           => $_POST['isi'],
            'foto'          => $foto,
            'tanggal'        => date('Y-m-d H:i:s')
        ];

        $this->pengaduanModel->create($data);

        Flash::set('success', 'Pengaduan berhasil dikirim.');
        header('Location: index.php?action=masyarakatDashboard');
    }

    public function editPengaduan() {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        Flash::set('danger', 'ID pengaduan tidak ditemukan.');
        header('Location: index.php?action=masyarakatDashboard');
        return;
    }

    $pengaduan = $this->pengaduanModel->find($id);

    // Cek apakah laporan milik user yg login
    if ($pengaduan['masyarakat_id'] != $_SESSION['user']['id']) {
        Flash::set('danger', 'Akses ditolak.');
        header('Location: index.php?action=masyarakatDashboard');
        return;
    }

    include __DIR__ . '/../views/masyarakat/edit_pengaduan.php';
}

    public function updatePengaduan() {
        $id = $_POST['id'] ?? null;
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan || $pengaduan['masyarakat_id'] != $_SESSION['user']['id']) {
            Flash::set('danger', 'Tidak dapat mengupdate laporan ini.');
            header('Location: index.php?action=masyarakatDashboard');
            return;
        }

        $foto = $_FILES['foto']['name'] ?? null;

        if ($foto) {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'public/uploads/' . $foto);
        } else {
            $foto = $pengaduan['foto'];
        }

        $data = [
            'id'             => $id,
            'isi'            => $_POST['isi'],
            'foto'           => $foto,
            'tanggal'        => date('Y-m-d H:i:s')
        ];

        $this->pengaduanModel->update($data);

        Flash::set('success', 'Laporan berhasil diperbarui.');
        header('Location: index.php?action=masyarakatDashboard');
    }

    public function hapusPengaduan() {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        Flash::set('danger', 'ID tidak ditemukan.');
        header('Location: index.php?action=masyarakatDashboard');
        return;
    }

    $pengaduan = $this->pengaduanModel->find($id);

    if (!$pengaduan || $pengaduan['masyarakat_id'] != $_SESSION['user']['id']) {
        Flash::set('danger', 'Tidak diizinkan menghapus laporan ini.');
        header('Location: index.php?action=masyarakatDashboard');
        return;
    }

    $this->pengaduanModel->delete($id);

    Flash::set('success', 'Laporan berhasil dihapus.');
    header('Location: index.php?action=masyarakatDashboard');
}

}
