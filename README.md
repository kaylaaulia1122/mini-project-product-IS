# Mini Project 1: Product Information System (Bengkel Otomotif)

Sistem Informasi Manajemen Data Inventori Produk berbasis web sederhana yang dirancang menggunakan PHP murni dengan menerapkan prinsip pemisahan arsitektur (*Separation of Concerns*).

---

## 🎯 Tujuan Projek
Merancang dan mengimplementasikan struktur arsitektur *blueprints* sistem manajemen data informasi produk siap pakai berbasis konsep modularitas dan struktur data terorganisir.

---

## 🏗️ Komponen Arsitektur Sistem

Projek ini dibangun menggunakan pemisahan 3 layer utama:

1. **Data Layer (`products.php`)**
   - Menampung dataset mentah produk bengkel otomotif menggunakan *Multidimensional Associative Array*.
   - Mengisi atribut penting seperti ID Produk, Nama Produk, Kategori, Harga, Stok, dan Deskripsi.

2. **Processing Layer (`functions.php`)**
   - Berisi logika bisnis dan fungsi pembantu (*helper functions*).
   - Memuat fungsi `hitungTotalNilaiStok()` untuk mengalkulasi total nilai aset gudang.
   - Memuat fungsi `isStokKritis()` untuk mengecek kondisi stok kritis (< 3 unit).

3. **Presentation Layer (`index.php`)**
   - Merajut seluruh komponen menggunakan `require_once`.
   - Merender data ke dalam layout tabel HTML menggunakan perulangan `foreach`.
   - Menandai secara visual baris tabel produk yang memiliki stok kritis (< 3).

---

## 💻 Cara Menjalankan Projek di Lokal

1. Pastikan web server lokal (seperti **XAMPP** atau **Laragon**) sudah terinstal dan berjalan (Apache active).
2. Unduh atau *clone* repository ini ke folder `htdocs`:
   ```bash
   git clone [https://github.com/kaylaaulia1122/mini-project-product-IS.git](https://github.com/kaylaaulia1122/mini-project-product-IS.git)
