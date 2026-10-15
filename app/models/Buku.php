<?php
class Buku
{
    public function __construct(private PDO $db) {}

    public function getAll(): array
    {
        $stmt = $this->db->query(
            'SELECT id, judul, penulis, penerbit, tahun, harga FROM buku ORDER BY judul'
        );
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT id, judul, penulis, penerbit, tahun, harga FROM buku WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insert(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO buku (judul, penulis, penerbit, tahun, harga)
             VALUES (:judul, :penulis, :penerbit, :tahun, :harga)'
        );
        return $stmt->execute([
            ':judul'    => $data['judul'],
            ':penulis'  => $data['penulis'],
            ':penerbit' => $data['penerbit'],
            ':tahun'    => $data['tahun'],
            ':harga'    => $data['harga'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE buku
             SET judul = :judul, penulis = :penulis, penerbit = :penerbit,
                 tahun = :tahun, harga = :harga
             WHERE id = :id'
        );
        return $stmt->execute([
            ':id'       => $id,
            ':judul'    => $data['judul'],
            ':penulis'  => $data['penulis'],
            ':penerbit' => $data['penerbit'],
            ':tahun'    => $data['tahun'],
            ':harga'    => $data['harga'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM buku WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}