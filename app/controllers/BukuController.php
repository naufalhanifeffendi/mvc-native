<?php
class BukuController
{
    public function __construct(private Buku $model) {}

    public function index(): void
    {
        $buku = $this->model->getAll();
        require __DIR__ . '/../views/buku/index.php';
    }

    public function create(): void {}
    public function store(): void {}
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
}