# Blueprint Arsitektur Konseptual: Product Information System (Bengkel Otomotif)

## 1. Pendahuluan & Tujuan Projek
Dokumen ini merupakan cetak biru (*blueprint*) perancangan arsitektur sistem informasi berbasis web sederhana. Sistem ini dirancang untuk mengelola dan menampilkan informasi inventori suku cadang/komoditas bengkel otomotif dengan menerapkan prinsip **Separation of Concerns (SoC)**.

---

## 2. Diagram Alur Arsitektur Sistem

```text
+-------------------------------------------------------+
|                 PRESENTATION LAYER                    |
|                     (index.php)                       |
|   - Merajut komponen dengan require_once              |
|   - Merender UI Tabel HTML via foreach                |
+---------------------------+---------------------------+
                            |
             +--------------+--------------+
             |                             |
             v                             v
+-------------------------+   +-------------------------+
|       DATA LAYER        |   |    PROCESSING LAYER     |
|      (products.php)     |   |     (functions.php)     |
| - Multidimensional Array|   | - hitungTotalNilaiStok()|
| - Data Komoditas Produk |   | - Logika Stok Kritis    |
+-------------------------+   +-------------------------+

---

## 3. Spesifikasi Komponen Layer

### A. Data Layer (`products.php`)
- **Fungsi Logis:** Berperan sebagai repositori penyimpanan data mentah produk tanpa melibatkan pemrosesan tampilan.
- **Struktur Data:** Menggunakan *Multidimensional Associative Array* untuk merepresentasikan tabel data di dalam memori.
- **Atribut Komoditas:**
  1. `id` (String): Kode unik barang (contoh: `"BGK-001"`).
  2. `nama` (String): Nama suku cadang/barang.
  3. `kategori` (String): Pengelompokan jenis barang (Pelumas, Suku Cadang, Pengapian, dll).
  4. `harga` (Integer): Nilai jual satuan dalam Rupiah.
  5. `stok` (Integer): Jumlah kuantitas fisik di gudang.
  6. `deskripsi` (String): Penjelasan spesifikasi barang.

### B. Processing Layer (`functions.php`)
- **Fungsi Logis:** Menampung seluruh logika bisnis, fungsi matematika, dan aturan pengkondisian (*business rules*).
- **Abstraksi Fungsi & Alur Logika:**
  1. **`hitungTotalNilaiStok($daftarProduk)`**
     - *Input:* Array multidimensi dari Data Layer.
     - *Proses:* Melakukan traversal loop untuk mengalikan `harga` $\times$ `stok` pada setiap barang, lalu menumpuk hasilnya ke variabel akumulator.
     - *Output:* Total nilai aset gudang dalam bentuk nominal angka.
  2. **`isStokKritis($stok)`**
     - *Input:* Nilai integer dari atribut `stok`.
     - *Proses:* Evaluasi kondisi boolean bersyarat (`$stok < 3`).
     - *Output:* Nilai `true` jika stok kritis, atau `false` jika stok aman.

### C. Presentation Layer (`index.php`)
- **Fungsi Logis:** Bertanggung jawab membangun antarmuka pengguna (UI) dan menampilkan data hasil pemrosesan.
- **Mekanisme Integrasi & Alur Eksekusi:**
  1. **Pemuatan Berkas (Modularitas):** Menggunakan `require_once 'products.php';` dan `require_once 'functions.php';` untuk menjamin berkas core dimuat secara mutlak.
  2. **Eksekusi Pengolahan:** Memanggil fungsi `hitungTotalNilaiStok()` untuk mendapatkan statistik aset.
  3. **Rendering Data (Traversal UI):** Menggunakan struktur perulangan `foreach` untuk merender setiap elemen array menjadi baris elemen tabel HTML (`<tr>`).
  4. **Penerapan Aturan Visual (Conditional Styling):** Memanggil fungsi `isStokKritis()` di dalam perulangan untuk menyaring dan memberikan penanda kelas CSS khusus (highlight warna latar baris) jika stok kritis (< 3).
