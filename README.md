# Product Information System

Aplikasi web sederhana untuk pencatatan dan pengelolaan informasi data produk berbasis PHP native dan CSS[cite: 1, 3].

## Fitur Utama
- **Dashboard Ringkasan:** Menampilkan total jenis produk, total kuantitas stok, nilai total aset stok, dan pendapatan penjualan[cite: 3].
- **Status Stok Otomatis:** Indikator visual real-time untuk status stok (Aman, Menipis, Kritis)[cite: 1, 3, 4].
- **Manajemen Stok:** Aksi langsung untuk menambah atau mengurangi jumlah stok produk[cite: 3].
- **Pencatatan Penjualan:** Tombol transaksi cepat yang otomatis memotong stok dan menghitung total omzet pendapatan[cite: 3, 4].
- **Penyimpanan Session:** Perubahan stok dan transaksi tersimpan sementara via PHP Session[cite: 3].

## Struktur File
* `index.php`: Halaman utama antarmuka pengguna, tabel produk, ringkasan data, dan penanganan aksi[cite: 3].
* `products.php`: Master data produk dalam bentuk array multidimensi[cite: 2, 3].
* `functions.php`: Kumpulan fungsi logika matematika (perhitungan stok, status stok, format rupiah, pendapatan)[cite: 3, 4].
* `style.css`: Pengaturan tata letak responsif, palet warna, dan styling antarmuka[cite: 1, 3].

## Cara Menjalankan
1. Pastikan web server lokal (seperti XAMPP, Laragon, atau PHP Built-in Server) sudah aktif.
2. Tempatkan folder proyek di direktori root server (misal: `htdocs` atau `www`).
3. Jalankan server dan buka browser ke alamat: