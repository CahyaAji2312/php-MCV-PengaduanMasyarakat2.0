<?php
require_once 'models/Pengaduan.php';
require_once 'models/Tanggapan.php';
require_once 'helpers/Flash.php';

class PetugasController {
    private $pengaduanModel;
    private $tanggapanModel;

    public function __construct() {
        $this->pengaduanModel = new Pengaduan();
        $this->tanggapanModel = new Tanggapan();
    }

    public function dashboard() {
        $pengaduan = $this->pengaduanModel->all();
        include __DIR__ . '/../views/petugas/dashboard.php';
    }

    public function semuaLaporan() {
        $pengaduan = $this->pengaduanModel->all();
        include __DIR__ . '/../views/laporan/daftar_pengaduan.php'; // Shared View
    }

    public function tanggapi() {
        $pengaduan = $this->pengaduanModel->find($_GET['id']);
        $tanggapan = $this->tanggapanModel->findByPengaduan($_GET['id']);
        include __DIR__ . '/../views/petugas/tanggapi.php';
    }

public function storeTanggapan() {
    $data = [
        'pengaduan_id' => $_POST['pengaduan_id'],
        'petugas_id'   => $_SESSION['user']['id'],
        'isi'          => $_POST['tanggapan'],
        'foto'         => $_FILES['foto']['name'] ?? null,
    ];

    // Upload foto jika ada
    if ($data['foto']) {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'public/uploads/' . $data['foto']);
    }

    // Simpan tanggapan
    $this->tanggapanModel->create($data);

    // Update status pengaduan via Model
    $this->pengaduanModel->updateStatus($data['pengaduan_id'], $_POST['status']);

    Flash::set('success', 'Tanggapan berhasil dikirim.');
    header('Location: index.php?action=petugasDashboard');
    exit;
    }

}
