<?php
require_once 'products.php';
require_once 'functions.php';

$totalAset = hitungTotalNilaiStok($products);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f9;
        }
        h2 {
            color: #333;
        }
        .summary-card {
            background-color: #ffffff;
            border-left: 5px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr.stok-kritis {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }
        .badge-kritis {
            background-color: #dc3545;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2>Product Information System</h2>

    <div class="summary-card">
        <strong>Total Nilai Aset Gudang:</strong> 
        Rp <?= number_format($totalAset, 0, ',', '.'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $produk): ?>
                <?php 
                    $kritis = isStokKritis($produk['stok']);
                    $rowClass = $kritis ? 'stok-kritis' : '';
                ?>
                <tr class="<?= $rowClass; ?>">
                    <td><?= htmlspecialchars($produk['id']); ?></td>
                    <td><?= htmlspecialchars($produk['nama']); ?></td>
                    <td><?= htmlspecialchars($produk['kategori']); ?></td>
                    <td>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <?= $produk['stok']; ?>
                        <?php if ($kritis): ?>
                            <span class="badge-kritis">Kritis</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($produk['deskripsi']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>