<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'models/User.php';
require_once 'helpers/Flash.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        include __DIR__ . '/../views/auth/register.php';
    }

public function authLogin() {
    $user = $this->userModel->findByUsername($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;

        // Debug: cek apakah session benar-benar tersimpan
        error_log("LOGIN BERHASIL: " . print_r($_SESSION, true));

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header('Location: index.php?action=adminDashboard');
        } elseif ($user['role'] === 'petugas') {
            header('Location: index.php?action=petugasDashboard');
        } else {
            header('Location: index.php?action=masyarakatDashboard');
        }
        exit;
    } else {
        Flash::set('error', 'Username atau password salah.');
        header('Location: index.php?action=login');
    }
}


    public function storeRegister() {
        $existing = $this->userModel->findByUsername($_POST['username']);
        if ($existing) {
            Flash::set('error', 'Username sudah digunakan!');
            header('Location: index.php?action=register');
            exit;
        }

        $data = [
            'nama'     => $_POST['nama'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role'     => 'masyarakat'
        ];

        $this->userModel->create($data);

        Flash::set('success', 'Akun berhasil dibuat! Silakan login.');
        header('Location: index.php?action=login');
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
    }
}
