<?php
require_once 'config/database.php';

class Pengaduan {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }


    // Ambil semua laporan
    public function all() {
        $stmt = $this->conn->query("
            SELECT p.*, u.nama 
            FROM pengaduan p
            JOIN users u ON p.masyarakat_id = u.id
            ORDER BY p.tanggal DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Tambah laporan
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO pengaduan (masyarakat_id, isi, foto, status, tanggal) 
            VALUES (?, ?, ?, 'pending', ?)
        ");
        return $stmt->execute([
            $data['masyarakat_id'],
            $data['isi'],
            $data['foto'] ?? null,  // aman jika tidak ada foto
            $data['tanggal']
        ]);
    }

    // Laporan milik masyarakat tertentu
    public function findByMasyarakat($masyarakat_id) {
        $stmt = $this->conn->prepare("
            SELECT * 
            FROM pengaduan 
            WHERE masyarakat_id = ? 
            ORDER BY tanggal DESC
        ");
        $stmt->execute([$masyarakat_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil detail laporan tertentu
    public function find($id) {
        $stmt = $this->conn->prepare("
            SELECT p.*, u.nama 
            FROM pengaduan p
            JOIN users u ON p.masyarakat_id = u.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Update status
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("
            UPDATE pengaduan 
            SET status = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$status, $id]);
    }

    public function update($data) {
        $query = "UPDATE pengaduan SET isi = :isi, foto = :foto, tanggal = :tanggal WHERE id = :id";
        $stmt = $this->conn->prepare($query);  

        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':isi', $data['isi']);
        $stmt->bindParam(':foto', $data['foto']);
        $stmt->bindParam(':tanggal', $data['tanggal']);

        return $stmt->execute();
    }

    // Update foto setelah selesai diperbaiki (opsional)
    public function updateFotoSelesai($id, $foto_selesai) {
        $stmt = $this->conn->prepare("
            UPDATE pengaduan 
            SET foto_selesai = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$foto_selesai, $id]);
    }

    // Hapus laporan & foto terkait
    public function delete($id) {
        $data = $this->find($id);

        if ($data && $data['foto']) {
            $fotoPath = 'public/uploads/' . $data['foto'];
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $stmt = $this->conn->prepare("DELETE FROM pengaduan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
