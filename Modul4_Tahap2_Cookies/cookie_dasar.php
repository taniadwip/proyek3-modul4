<?php
// 1. Simpan nama jika form dikirim
if (isset($_POST['nama']) && trim($_POST['nama']) !== '') {
    setcookie('nama', trim($_POST['nama']), time() + (86400 * 7), '/'); // Berlaku 7 hari
    header('Location: cookie_dasar.php');
    exit;
}

// 2. Hapus nama jika tombol "Lupakan saya" diklik
if (isset($_GET['hapus'])) {
    setcookie('nama', '', time() - 3600, '/'); // Mundurkan waktu kedaluwarsa ke masa lalu
    header('Location: cookie_dasar.php');
    exit;
}

// 3. Hitung kunjungan (ditaruh setelah exit agar request redirect tidak ikut terhitung dua kali)
$kunjungan = isset($_COOKIE['kunjungan']) ? (int)$_COOKIE['kunjungan'] : 0;
$kunjungan++;
setcookie('kunjungan', $kunjungan, time() + (86400 * 7), '/');

// Baca nama dari cookie
$nama = $_COOKIE['nama'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cookie Dasar</title>
    <style>
        body { font-family: sans-serif; padding: 1.5rem; line-height: 1.6; }
    </style>
</head>
<body>
    <?php if ($nama): ?>
        <h1>Halo, <?= htmlspecialchars($nama) ?>!</h1>
        <p>Anda sudah membuka halaman ini <strong><?= $kunjungan ?></strong> kali.</p>
        <p><a href="?hapus=1">Lupakan saya</a></p>
    <?php else: ?>
        <h1>Halo, tamu!</h1>
        <form method="post">
            <input type="text" name="nama" placeholder="Nama Anda" required>
            <button type="submit">Simpan</button>
        </form>
    <?php endif; ?>
</body>
</html>