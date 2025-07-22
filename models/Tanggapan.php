<?php
require_once 'config/database.php';

class Tanggapan {
    private $conn;

public function __construct() {
    $this->conn = (new Database())->getConnection();
}


    // Tambahkan tanggapan (dengan atau tanpa foto)
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO tanggapan (pengaduan_id, petugas_id, isi, foto, tanggal) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['pengaduan_id'],
            $data['petugas_id'],
            $data['isi'],
            $data['foto'] ?? null,   // aman jika tanpa foto
            $data['tanggal']
        ]);
    }

    // Ambil semua tanggapan dari satu laporan
    public function findByPengaduan($pengaduan_id) {
        $stmt = $this->conn->prepare("
            SELECT t.*, u.nama as petugas_nama 
            FROM tanggapan t 
            JOIN users u ON t.petugas_id = u.id 
            WHERE t.pengaduan_id = ? 
            ORDER BY t.tanggal ASC
        ");
        $stmt->execute([$pengaduan_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hapus tanggapan beserta foto (jika ada)
    public function delete($id) {
        $tanggapan = $this->find($id);

        if ($tanggapan && $tanggapan['foto']) {
            $fotoPath = 'public/uploads/' . $tanggapan['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $stmt = $this->conn->prepare("DELETE FROM tanggapan WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Ambil data tanggapan tertentu (untuk kebutuhan penghapusan)
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tanggapan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
