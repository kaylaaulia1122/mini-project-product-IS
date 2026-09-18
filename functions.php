<?php
// functions.php - Processing Layer

/**
 * Mengalkulasi total nilai aset seluruh stok produk yang ada di gudang.
 * 
 * @param array $daftarProduk
 * @return float|int
 */
function hitungTotalNilaiStok($daftarProduk) {
    $totalNilai = 0;
    
    foreach ($daftarProduk as $item) {
        $totalNilai += $item['harga'] * $item['stok'];
    }
    
    return $totalNilai;
}

/**
 * Mengecek apakah stok produk masuk dalam kategori kritis (< 3).
 * 
 * @param int $stok
 * @return bool
 */
function isStokKritis($stok) {
    return $stok < 3;
}