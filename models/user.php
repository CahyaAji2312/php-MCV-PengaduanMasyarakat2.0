<?php
require_once 'config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Cari user berdasarkan username (digunakan saat login & validasi)
    public function findByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Buat user baru (masyarakat / petugas)
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO users (nama, username, password, role, created_at) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $data['nama'],
            $data['username'],
            $data['password'],    // pastikan sudah di-hash sebelum dipassing
            $data['role']
        ]);
    }

    // Ambil semua petugas
    public function allPetugas() {
        $stmt = $this->conn->prepare("
            SELECT * 
            FROM users 
            WHERE role = 'petugas'
            ORDER BY nama ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua masyarakat
    public function allMasyarakat() {
        $stmt = $this->conn->prepare("
            SELECT * 
            FROM users 
            WHERE role = 'masyarakat'
            ORDER BY nama ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hapus petugas berdasarkan ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ? AND role = 'petugas'");
        return $stmt->execute([$id]);
    }

    // Ubah password user
    public function updatePassword($id, $passwordBaru) {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET password = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$passwordBaru, $id]);
    }

    // Ambil user berdasarkan ID
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update nama dan username petugas
    public function update($data) {
        $query = "UPDATE users SET nama = :nama, username = :username WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nama' => $data['nama'],
            ':username' => $data['username'],
            ':id' => $data['id'],
        ]);
    }
}
?>
