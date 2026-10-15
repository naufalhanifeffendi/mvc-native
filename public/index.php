<?php
session_start();

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/models/Buku.php';
require __DIR__ . '/../app/controllers/BukuController.php';

$db         = (new Database())->connect();
$model      = new Buku($db);
$controller = new BukuController($model);

$page   = $_GET['page'] ?? 'buku';
$action = $_GET['action'] ?? 'index';

function notFound(string $message): void
{
    http_response_code(404);
    exit($message);
}

if ($page !== 'buku') {
    notFound('Halaman tidak ditemukan.');
}

match ($action) {
    'index'  => $controller->index(),
    'create' => $controller->create(),
    'store'  => $controller->store(),
    'edit'   => $controller->edit(),
    'update' => $controller->update(),
    'delete' => $controller->delete(),
    default  => notFound('Action tidak ditemukan.'),
};