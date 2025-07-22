<?php
require_once 'models/User.php';
require_once 'models/Pengaduan.php';
require_once 'helpers/format.php';
require_once 'helpers/Flash.php';
require_once 'vendor/autoload.php'; // composer require mpdf/mpdf

class AdminController {
    private $userModel;
    private $pengaduanModel;

    public function __construct() {
        $this->userModel = new User();
        $this->pengaduanModel = new Pengaduan();
    }

    public function dashboard() {
        $pengaduan = $this->pengaduanModel->all();
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function daftarPetugas() {
        $petugas = $this->userModel->allPetugas();
        include __DIR__ . '/../views/admin/daftar_petugas.php';
    }

    public function tambahPetugas() {
        include __DIR__ . '/../views/admin/tambah_petugas.php';
    }

    public function storePetugas() {
        $existing = $this->userModel->findByUsername($_POST['username']);
        if ($existing) {
            Flash::set('error', 'Username sudah ada!');
            header('Location: index.php?action=tambahPetugas');
            exit;
        }

        $data = [
            'nama'     => $_POST['nama'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role'     => 'petugas'
        ];

        $this->userModel->create($data);
        Flash::set('success', 'Akun petugas berhasil dibuat!');
        header('Location: index.php?action=daftarPetugas');
    }

    public function editPetugas() {
        if (!isset($_GET['id'])) {
            Flash::set('error', 'ID petugas tidak ditemukan!');
            header('Location: index.php?action=daftarPetugas');
            return;
        }

        $id = $_GET['id'];
        $petugas = $this->userModel->findById($id);

        if (!$petugas) {
            Flash::set('error', 'Petugas tidak ditemukan!');
            header('Location: index.php?action=daftarPetugas');
            return;
        }

        include __DIR__ . '/../views/admin/edit_petugas.php';
    }

    public function updatePetugas() {
        if (!isset($_POST['id'], $_POST['nama'], $_POST['username'])) {
            Flash::set('error', 'Data tidak lengkap!');
            header('Location: index.php?action=daftarPetugas');
            return;
        }

        $data = [
            'id' => $_POST['id'],
            'nama' => $_POST['nama'],
            'username' => $_POST['username'],
        ];

        $this->userModel->update($data);
        Flash::set('success', 'Data petugas diperbarui!');
        header('Location: index.php?action=daftarPetugas');
    }

    public function hapusPetugas() {
        if (!isset($_GET['id'])) {
            Flash::set('error', 'ID tidak ditemukan!');
            header('Location: index.php?action=daftarPetugas');
            return;
        }

        $id = $_GET['id'];
        $this->userModel->delete($id);
        Flash::set('success', 'Petugas berhasil dihapus!');
        header('Location: index.php?action=daftarPetugas');
    }

    public function daftarpengaduan() {
        $pengaduan = $this->pengaduanModel->all();
        include __DIR__ . '/../views/laporan/daftar_pengaduan.php';
    }

    public function laporanPDF() {
        $pengaduan = $this->pengaduanModel->all();

        $html = '<h1 style="text-align:center;">Laporan Pengaduan Masyarakat</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<thead><tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>Isi Pengaduan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                  </tr></thead><tbody>';

        $no = 1;
        foreach ($pengaduan as $p) {
            $html .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . htmlspecialchars($p['nama']) . '</td>
                        <td>' . htmlspecialchars($p['isi']) . '</td>
                        <td><img src="public/uploads/' . htmlspecialchars($p['foto']) . '" width="100" height="100"></td>
                        <td>' . htmlspecialchars($p['status']) . '</td>
                        <td>' . formatTanggal($p['tanggal']) . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../tmp']);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan_Pengaduan.pdf', 'I');
    }
}
