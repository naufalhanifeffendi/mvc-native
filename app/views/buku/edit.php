<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h2>Edit Buku</h2>

    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <form method="post" action="index.php?page=buku&action=update">
        <input type="hidden" name="id" value="<?= (int) $buku['id'] ?>">

        <label>Judul</label><br>
        <input type="text" name="judul"
               value="<?= htmlspecialchars($buku['judul']) ?>" required><br><br>

        <label>Penulis</label><br>
        <input type="text" name="penulis"
               value="<?= htmlspecialchars($buku['penulis']) ?>" required><br><br>

        <label>Penerbit</label><br>
        <input type="text" name="penerbit"
               value="<?= htmlspecialchars($buku['penerbit']) ?>" required><br><br>

        <label>Tahun Terbit</label><br>
        <input type="number" name="tahun"
               value="<?= htmlspecialchars($buku['tahun']) ?>" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" step="0.01"
               value="<?= htmlspecialchars($buku['harga']) ?>" required><br><br>

        <button type="submit">Update</button>
        <a href="index.php?page=buku">Kembali</a>
    </form>
</body>
</html>