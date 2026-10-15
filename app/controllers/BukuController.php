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
    public function edit(): void
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $buku = $this->model->findById($id);

        if (!$buku) {
            http_response_code(404);
            exit('Data buku tidak ditemukan.');
        }

        require __DIR__ . '/../views/buku/edit.php';
    }

    public function update(): void
    {
        $id   = (int) ($_POST['id'] ?? 0);
        $data = $this->validateInput($_POST);

        if ($data === null) {
            $this->redirect('action=edit&id=' . $id, 'Semua field wajib diisi dengan benar.', 'error');
        }

        try {
            $this->model->update($id, $data);
            $this->redirect('action=index', 'Data buku berhasil diperbarui.', 'success');
        } catch (PDOException $e) {
            $this->redirect('action=edit&id=' . $id, 'Gagal memperbarui data buku.', 'error');
        }
    }
        public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        try {
            $this->model->delete($id);
            $this->redirect('action=index', 'Buku berhasil dihapus.', 'success');
        } catch (PDOException $e) {
            $this->redirect('action=index', 'Gagal menghapus buku.', 'error');
        }
    }

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