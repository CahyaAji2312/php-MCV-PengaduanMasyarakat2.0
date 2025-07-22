<?php

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/PetugasController.php';
require_once __DIR__ . '/../controllers/MasyarakatController.php';
require_once __DIR__ . '/role.php'; // agar requireRole() dikenali

$authController       = new AuthController();
$adminController      = new AdminController();
$petugasController    = new PetugasController();
$masyarakatController = new MasyarakatController();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    // Auth
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'authLogin':
        $authController->authLogin();
        break;
    case 'storeRegister':
        $authController->storeRegister();
        break;
    case 'logout':
        $authController->logout();
        break;

    // Admin
    case 'adminDashboard':
        requireRole('admin');
        $adminController->dashboard();
        break;
    case 'tambahPetugas':
        requireRole('admin');
        $adminController->tambahPetugas();
        break;
    case 'editPetugas':
        requireRole('admin');
        $adminController->editPetugas($_GET['id']);
        break;
    case 'hapusPetugas':
        requireRole('admin');
        $adminController->hapusPetugas($_GET['id']);
        break;
    case 'updatePetugas':
        requireRole('admin');
        $adminController->updatePetugas();
        break;
    case 'storePetugas':
        requireRole('admin');
        $adminController->storePetugas();
        break;
    case 'daftarPetugas':
        requireRole('admin');
        $adminController->daftarPetugas();
        break;
    case 'exportPDF':
        requireRole('admin'); 
        $adminController->laporanPDF(); 
        break;



    // Petugas
    case 'petugasDashboard':
        requireRole('petugas');
        $petugasController->dashboard();
        break;
    case 'tanggapi':
        requireRole('petugas');
        $petugasController->tanggapi();
        break;
    case 'storeTanggapan':
        requireRole('petugas');
        $petugasController->storeTanggapan();
        break;

    // Masyarakat
    case 'masyarakatDashboard':
        requireRole('masyarakat');
        $masyarakatController->dashboard();
        break;
    case 'laporanPengaduan':
        requireRole('masyarakat');
        $masyarakatController->laporanPengaduan();
        break;
    case 'editPengaduan':
        (new MasyarakatController())->editPengaduan();
        break;
    case 'updatePengaduan':
        (new MasyarakatController())->updatePengaduan();
        break;
    case 'hapusPengaduan':
        (new MasyarakatController())->hapusPengaduan();
        break;
    case 'storePengaduan':
        requireRole('masyarakat');
        $masyarakatController->storePengaduan();
        break;
    default:
        echo "404: Halaman tidak ditemukan.";
        break;
}
