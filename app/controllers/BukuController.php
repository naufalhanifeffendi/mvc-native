<?php
class BukuController
{
    public function __construct(private Buku $model) {}

    // Menampilkan daftar buku
    public function index(): void
    {
        $buku = $this->model->getAll();
        require __DIR__ . '/../views/buku/index.php';
    }

    // Menampilkan form tambah buku
    public function create(): void
    {
        require __DIR__ . '/../views/buku/create.php';
    }

    // Menyimpan buku baru dari form
    public function store(): void
    {
        $data = $this->validateInput($_POST);

        if ($data === null) {
            $this->redirect('action=create', 'Semua field wajib diisi dengan benar.', 'error');
        }

        try {
            $this->model->insert($data);
            $this->redirect('action=index', 'Buku berhasil ditambahkan.', 'success');
        } catch (PDOException $e) {
            $this->redirect('action=create', 'Gagal menyimpan data buku.', 'error');
        }
    }

    // Akan diisi di Tahap 7 dan 8
    public function edit(): void {}
    public function update(): void {}
    public function delete(): void {}

    // Menyimpan pesan sukses/gagal lalu pindah halaman
    private function redirect(string $query, string $message, string $type): void
    {
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
        header('Location: index.php?page=buku&' . $query);
        exit;
    }

    // Merapikan input dan memastikan tidak ada yang kosong/salah format
    private function validateInput(array $input): ?array
    {
        $data = [
            'judul'    => trim($input['judul'] ?? ''),
            'penulis'  => trim($input['penulis'] ?? ''),
            'penerbit' => trim($input['penerbit'] ?? ''),
            'tahun'    => trim($input['tahun'] ?? ''),
            'harga'    => trim($input['harga'] ?? ''),
        ];

        foreach ($data as $value) {
            if ($value === '') {
                return null;
            }
        }

        if (!ctype_digit($data['tahun']) || !is_numeric($data['harga'])) {
            return null;
        }

        return $data;
    }
}