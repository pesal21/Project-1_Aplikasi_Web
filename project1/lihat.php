<?php
include 'database.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM uang WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: lihat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Daftar Keuangan Futsal</h1>
        <table class="table table-bordered mt-5">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>PJ</th>
                    <th>Hadir</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM uang ORDER BY tanggal DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['pj'] ?></td>
                    <td><?= $row['hadir'] ?> Orang</td>
                    <td>Rp <?= number_format($row['masuk'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['keluar'], 0, ',', '.') ?></td>
                    <td>
                        <a href="lihat.php?hapus=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php
                    endwhile;
                else:
                    echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>
        ...
        </tbody>
        </table>

        <?php
$hasil = mysqli_query($conn, "SELECT SUM(masuk) AS total_masuk, SUM(keluar) AS total_keluar FROM uang");
$jumlah = mysqli_fetch_assoc($hasil);
$total_kas = $jumlah['total_masuk'] - $jumlah['total_keluar'];
?>

        <div class="mt-4">
            <h5><strong>Total Kas Sekarang :</strong>
                <span class="badge bg-success">Rp <?= number_format($total_kas, 0, ',', '.') ?></span>
            </h5>
        </div>
        <a href="keuangan.html" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
</body>

</html>