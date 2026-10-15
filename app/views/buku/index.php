<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
</head>
<body>
    <h2>Daftar Buku</h2>

    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <a href="index.php?page=buku&action=create">Tambah Buku</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($buku as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b['judul']) ?></td>
            <td><?= htmlspecialchars($b['penulis']) ?></td>
            <td><?= htmlspecialchars($b['penerbit']) ?></td>
            <td><?= htmlspecialchars($b['tahun']) ?></td>
            <td>Rp <?= number_format((float) $b['harga'], 0, ',', '.') ?></td>
            <td>
                <a href="index.php?page=buku&action=edit&id=<?= (int) $b['id'] ?>">Edit</a>
                <form method="post"
                      action="index.php?page=buku&action=delete"
                      style="display:inline"
                      onsubmit="return confirm('Hapus buku ini?')">
                    <input type="hidden" name="id" value="<?= (int) $b['id'] ?>">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>