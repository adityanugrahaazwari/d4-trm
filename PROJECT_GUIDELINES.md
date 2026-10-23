# Panduan Bertahap Pengembangan Website
## Program Studi D-4 Teknik Rekayasa Multimedia

Dokumen ini membagi pengembangan website menjadi tahap-tahap kecil. Selesaikan dan periksa satu tahap sebelum melanjutkan ke tahap berikutnya. Jangan langsung mengimplementasikan seluruh fitur sekaligus.

---

## 1. Konteks dan tujuan proyek

Membangun website resmi Program Studi D-4 Teknik Rekayasa Multimedia yang memiliki:
- **Website publik** untuk menampilkan informasi program studi.
- **Panel admin** untuk mengelola konten website.
- **Database** untuk menyimpan konten yang perlu dikelola secara dinamis.

### Teknologi yang dipilih
- Laravel
- Blade
- Tailwind CSS
- Alpine.js
- MySQL
- Git
- Conventional Commits
- Laravel Form Request untuk validasi

> Periksa versi Laravel dan Tailwind yang benar-benar terpasang sebelum mengikuti konfigurasi. Sintaks dan cara pemasangan dapat berbeda antarversi.

## 2. Aturan kerja setiap tahap

Untuk setiap tahap:
1. Periksa kondisi proyek saat ini sebelum mengubah apa pun.
2. Tentukan hasil yang ingin dicapai.
3. Kerjakan hanya ruang lingkup tahap tersebut.
4. Jalankan aplikasi dan periksa hasilnya.
5. Perbaiki masalah sebelum menyatakan tahap selesai.
6. Tinjau perubahan dengan `git diff`.
7. Buat commit jika perubahan sudah layak disimpan.
8. Catat hal yang belum selesai sebelum melanjutkan.

Jangan menganggap suatu tahap selesai hanya karena kode sudah ditulis. Hasilnya harus diperiksa.

---

# Tahap 1 — Persiapan dan pemeriksaan proyek

## Tujuan
Memastikan lingkungan pengembangan dan proyek siap digunakan tanpa mengulang instalasi yang sebenarnya sudah dilakukan.

## Langkah kerja
- [ ] Periksa apakah proyek Laravel sudah tersedia.
- [ ] Periksa versi PHP, Composer, Node.js, dan npm.
- [ ] Periksa versi Laravel dan Tailwind CSS.
- [ ] Pastikan aplikasi dapat dijalankan.
- [ ] Periksa konfigurasi koneksi MySQL.
- [ ] Pastikan file `.env` tidak dilacak Git.
- [ ] Periksa `.gitignore`.
- [ ] Inisialisasi Git jika proyek belum menggunakan Git.
- [ ] Catat kondisi awal proyek.

Perintah pemeriksaan yang dapat digunakan:

```bash
php -v
composer --version
node -v
npm -v
php artisan --version
git status
```

Jalankan perintah Laravel hanya dari direktori proyek yang berisi `artisan` dan `composer.json`.

## Kriteria selesai
- Aplikasi Laravel dapat dijalankan.
- Dependensi utama terpasang.
- Konfigurasi database diketahui.
- Tidak ada rahasia seperti kata sandi atau token yang ikut di-commit.

## Commit
Jika proyek baru saja disiapkan dan perubahan memang siap disimpan:

```bash
git add <file-yang-relevan>
git diff --cached
git commit -m "chore(setup): prepare Laravel project"
```

Jangan memakai contoh commit ini jika perubahan aktual tidak sesuai. Jika proyek sudah memiliki riwayat Git, jangan menginisialisasi ulang repository.

---

# Tahap 2 — Menetapkan fondasi desain

## Tujuan
Menyamakan gaya visual agar halaman publik dan admin konsisten.

## Palet warna

| Nama | Kode | Penggunaan yang disarankan |
|---|---|---|
| Primary | `#086288` | Navbar, footer, tombol utama, judul penting |
| Secondary | `#4D8DBA` | Tautan dan aksen sekunder |
| Light Blue | `#97D7FF` | Latar aksen yang ringan |
| Cream | `#FFEFC4` | Sorotan atau latar aksen |
| White | `#FFFFFF` | Latar utama |

Warna teks yang disarankan:
- Teks utama: `#243746`
- Teks sekunder: `#526777`

Gunakan teks gelap pada latar biru muda dan krem. Periksa kontras sebelum menggunakan teks putih di atas warna sekunder.

## Langkah kerja
- [ ] Tentukan font dan skala ukuran teks.
- [ ] Tetapkan warna, jarak, radius sudut, dan bayangan.
- [ ] Buat gaya tombol utama dan sekunder.
- [ ] Buat gaya input, label, pesan error, kartu, dan badge status.
- [ ] Simpan token desain sesuai versi Tailwind yang digunakan.
- [ ] Uji komponen dasar di halaman sementara.

Jika proyek menggunakan Tailwind CSS v4, token warna dapat didefinisikan dalam `resources/css/app.css`:

```css
@import "tailwindcss";

@theme {
    --color-brand-primary: #086288;
    --color-brand-secondary: #4D8DBA;
    --color-brand-sky: #97D7FF;
    --color-brand-cream: #FFEFC4;
    --color-brand-white: #FFFFFF;
}
```

Jika proyek memakai Tailwind v3, jangan menyalin konfigurasi v4 ini begitu saja; sesuaikan dengan konfigurasi versi proyek.

## Kriteria selesai
- Warna dan tipografi utama sudah ditetapkan.
- Komponen dasar memiliki tampilan konsisten.
- Tidak ada halaman yang perlu didesain ulang karena token warna belum disepakati.

## Commit
Contoh: `style(design): define website design tokens`

---

# Tahap 3 — Membuat layout website publik

## Tujuan
Membangun kerangka umum yang dipakai halaman publik.

## Navigasi publik

1. Beranda
2. Profil
   - Sejarah Program Studi
   - Visi
   - Misi
   - Sambutan Ketua Program Studi
   - Struktur Organisasi
   - Dosen
   - Tenaga Kependidikan
3. Akademik
   - Kurikulum
   - Mata Kuliah
   - Kalender Akademik
   - Capaian Pembelajaran Lulusan (CPL)
   - Profil Lulusan
4. Berita dan Pengumuman
   - Berita Program Studi
   - Pengumuman Akademik
   - Agenda Kegiatan
5. Fasilitas
6. Galeri
   - Foto dan dokumentasi kegiatan
7. Kontak

Menu **Karya Mahasiswa** tidak dimasukkan karena program studi masih baru dan belum memiliki mahasiswa.

## Langkah kerja
- [ ] Buat `resources/views/layouts/public.blade.php`.
- [ ] Buat komponen navbar dan footer.
- [ ] Atur area konten halaman menggunakan Blade `@yield` atau `@section`/`@extends`.
- [ ] Tambahkan navigasi yang berfungsi.
- [ ] Pastikan layout responsif untuk desktop dan perangkat seluler.
- [ ] Buat kerangka halaman publik tanpa mengarang informasi resmi.

## Kriteria selesai
- Navbar dan footer dapat digunakan ulang.
- Navigasi mengarah ke rute yang benar.
- Layout tetap terbaca di layar kecil.
- Konten halaman dapat diganti tanpa menyalin seluruh layout.

## Commit
Contoh: `feat(public): add shared public layout`

---

# Tahap 4 — Membuat halaman beranda

## Urutan bagian beranda
1. Header dan navigasi
2. Hero section
3. Pengenalan program studi
4. Keunggulan program studi
5. Kompetensi dan prospek karier
6. Dosen
7. Berita dan pengumuman
8. Fasilitas
9. CTA penutup
10. Footer

## Langkah kerja
- [ ] Buat kerangka `resources/views/public/home.blade.php`.
- [ ] Buat komponen atau partial untuk bagian yang digunakan ulang.
- [ ] Gunakan data contoh yang jelas ditandai sebagai dummy.
- [ ] Tambahkan tautan menuju halaman detail yang sesuai.
- [ ] Periksa responsivitas dan aksesibilitas dasar.
- [ ] Jangan mengarang nama dosen, fasilitas, akreditasi, prestasi, atau klaim resmi.
- [ ] Jangan tambahkan bagian Karya Mahasiswa kecuali diminta kemudian.

## Kriteria selesai
- Seluruh bagian beranda tersusun sesuai urutan.
- Tampilan responsif.
- Data contoh mudah diganti dengan data asli.
- Tidak ada informasi dummy yang tersamar sebagai fakta resmi.

## Commit
Contoh: `feat(public): build homepage sections`

---

# Tahap 5 — Membuat layout dan kerangka panel admin

## Tujuan
Menyiapkan tampilan admin sebelum menghubungkan seluruh fitur ke database.

## Rancangan sidebar admin

- **Menu Utama**
  - Dashboard
- **Konten Website**
  - Profil Program Studi
    - Sejarah Program Studi
    - Visi dan Misi
    - Sambutan Ketua Program Studi
    - Struktur Organisasi
  - Sumber Daya Manusia
    - Data Dosen
    - Tenaga Kependidikan
  - Akademik
    - Kurikulum
    - Mata Kuliah
    - Kalender Akademik
    - Capaian Pembelajaran Lulusan
    - Profil Lulusan
  - Berita dan Pengumuman
    - Semua Berita
    - Kategori Berita
    - Pengumuman
    - Agenda Kegiatan
  - Fasilitas
    - Daftar Fasilitas
  - Galeri
    - Album Galeri
    - Foto dan Dokumentasi
- **Konfigurasi Website**
  - Pengaturan Website
    - Identitas Website
    - Pengaturan Homepage
    - Kontak dan Media Sosial
    - Logo dan Favicon
  - Manajemen Media
    - Daftar Media
    - Unggah Media
- **Administrasi**
  - Pengguna dan Hak Akses
    - Daftar Pengguna
    - Peran
    - Hak Akses
  - Profil Akun Saya
  - Keluar

## Langkah kerja
- [ ] Buat `resources/views/layouts/admin.blade.php`.
- [ ] Buat sidebar dan topbar.
- [ ] Buat komponen tombol, tabel, form, alert, badge status, dan modal konfirmasi.
- [ ] Buat kerangka dashboard.
- [ ] Buat kerangka halaman daftar dan formulir dengan data dummy.
- [ ] Tambahkan navigasi aktif dan menu responsif.
- [ ] Pastikan halaman admin dilindungi autentikasi saat mulai dihubungkan ke rute aplikasi.

## Catatan
Dashboard sebaiknya menampilkan statistik dari database setelah backend tersedia, bukan angka tetap yang terlihat seperti data aktual. Pada tahap desain, angka dummy harus diberi penanda.

## Kriteria selesai
- Layout admin konsisten dan responsif.
- Komponen UI dapat digunakan ulang.
- Kerangka halaman utama admin tersedia.
- Data contoh tidak disajikan sebagai statistik nyata.

## Commit
Contoh: `feat(admin): add admin layout and UI components`

---

# Tahap 6 — Autentikasi dan dasar keamanan

## Tujuan
Memastikan hanya pengguna yang berhak dapat mengakses area admin.

## Langkah kerja
- [ ] Tentukan pendekatan autentikasi Laravel yang sesuai versi dan kebutuhan.
- [ ] Buat alur login dan logout.
- [ ] Lindungi rute admin dengan middleware autentikasi.
- [ ] Tentukan apakah perlu RBAC sejak awal atau dapat ditambahkan setelah fitur dasar stabil.
- [ ] Pastikan pemeriksaan otorisasi dilakukan di backend, bukan hanya dengan menyembunyikan menu.
- [ ] Periksa CSRF, validasi input, dan keamanan unggahan berkas.
- [ ] Jangan menyimpan kata sandi dalam bentuk teks biasa.

## Catatan otorisasi
Validasi dan otorisasi adalah dua hal berbeda. Form Request dapat memakai `authorize()`, Policy, atau Gate. Jika menggunakan kemampuan seperti `can('manage-news')`, pastikan Gate, Policy, atau sistem permission tersebut benar-benar sudah didefinisikan.

## Kriteria selesai
- Pengguna dapat login dan logout dengan benar.
- Pengunjung yang belum login tidak dapat membuka halaman admin.
- Hak akses diperiksa di server.
- Pengujian akses dasar berhasil.

## Commit
Contoh: `feat(auth): add protected admin access`

---

# Tahap 7 — Menyiapkan pola backend untuk setiap fitur

## Tujuan
Menentukan pola implementasi yang konsisten sebelum membuat CRUD satu per satu.

## Pola kerja per fitur
1. Rancang tabel dan relasi.
2. Buat migration.
3. Buat Model dan aturan mass assignment yang aman.
4. Buat Form Request untuk validasi.
5. Buat Controller.
6. Definisikan route.
7. Hubungkan Blade dengan data database.
8. Tambahkan pesan sukses dan gagal.
9. Uji validasi, otorisasi, dan alur CRUD.
10. Tinjau perubahan dan buat commit.

Contoh membuat Form Request:

```bash
php artisan make:request Admin/StoreNewsRequest
php artisan make:request Admin/UpdateNewsRequest
```

Lokasi yang disarankan: `app/Http/Requests/Admin/`.

Form Request menyimpan aturan validasi di `rules()` dan pesan khusus di `messages()`. Gunakan `$request->validated()` untuk memperoleh input yang sudah tervalidasi.

## Kriteria selesai
- Pola folder dan penamaan konsisten.
- Validasi tidak menumpuk di Controller.
- Input yang disimpan berasal dari data tervalidasi.
- Otorisasi tetap diperiksa secara terpisah.

## Commit
Contoh: `refactor(backend): establish feature implementation pattern`

---

# Tahap 8 — Implementasi fitur konten inti

Kerjakan satu fitur sampai selesai sebelum berpindah ke fitur berikutnya.

Urutan yang disarankan:

1. **Pengaturan identitas website** — nama website, logo, favicon, kontak, dan media sosial.
2. **Profil program studi** — sejarah, visi-misi, sambutan, dan struktur organisasi.
3. **Dosen dan tenaga kependidikan** — hanya data yang layak dipublikasikan.
4. **Berita dan kategori berita**.
5. **Pengumuman akademik**.
6. **Agenda kegiatan**.

Untuk setiap fitur:
- [ ] Selesaikan UI daftar, tambah, detail bila diperlukan, edit, dan hapus.
- [ ] Buat migration dan Model.
- [ ] Buat Form Request.
- [ ] Buat Controller dan route.
- [ ] Hubungkan UI dengan database.
- [ ] Tambahkan pencarian, filter, dan pagination bila relevan.
- [ ] Tambahkan status draft/published jika fitur memerlukannya.
- [ ] Tambahkan validasi dan konfirmasi penghapusan.
- [ ] Uji akses pengguna dan validasi.
- [ ] Buat commit khusus fitur tersebut.

Contoh commit:
- `feat(settings): manage website identity`
- `feat(profile): manage study program profile`
- `feat(staff): manage lecturer data`
- `feat(news): add news CRUD`
- `feat(announcements): manage academic announcements`
- `feat(events): manage program events`

---

# Tahap 9 — Implementasi fitur akademik

Kerjakan satu per satu:
1. Kurikulum
2. Mata kuliah
3. Kalender akademik
4. Capaian Pembelajaran Lulusan (CPL)
5. Profil lulusan

## Catatan desain
- Rancang relasi antara kurikulum dan mata kuliah bila sesuai kebutuhan data.
- Tentukan format kalender akademik dan apakah perlu unggah dokumen.
- Simpan CPL dalam struktur yang mudah dibaca dan dikelola.
- Pastikan informasi akademik yang dipublikasikan telah diverifikasi.

## Kriteria selesai
Setiap fitur terhubung ke database, tervalidasi, terlindungi sesuai peran, dan tampil dengan benar di website publik.

## Commit
Gunakan satu commit untuk satu unit perubahan yang selesai, misalnya `feat(academic): manage curriculum`.

---

# Tahap 10 — Implementasi fasilitas, galeri, dan media

## Fasilitas
- [ ] Buat daftar fasilitas.
- [ ] Tambahkan deskripsi dan foto jika tersedia.
- [ ] Validasi unggahan gambar.

## Galeri
- [ ] Buat album galeri.
- [ ] Tambahkan foto dan keterangan.
- [ ] Hubungkan foto dengan album bila diperlukan.
- [ ] Atur gambar utama dan urutan tampilan jika dibutuhkan.

## Manajemen media
- [ ] Putuskan apakah pengelolaan media terpusat memang diperlukan.
- [ ] Batasi jenis berkas dan ukuran unggahan.
- [ ] Gunakan Laravel Storage dan nama berkas yang aman.
- [ ] Tangani penghapusan berkas tanpa merusak data yang masih digunakan.

## Kriteria selesai
- Fasilitas dan galeri dapat dikelola.
- Berkas tersimpan dengan aman.
- Gambar ditampilkan dengan benar di berbagai ukuran layar.

## Commit
Contoh: `feat(gallery): manage photo albums`

---

# Tahap 11 — Menghubungkan konten ke website publik

## Tujuan
Mengganti data dummy dengan data database yang sebenarnya.

## Langkah kerja
- [ ] Hubungkan profil, dosen, dan tenaga kependidikan.
- [ ] Hubungkan kurikulum dan informasi akademik.
- [ ] Tampilkan berita dan pengumuman yang berstatus publik.
- [ ] Hubungkan fasilitas dan galeri.
- [ ] Tampilkan kontak dari pengaturan website.
- [ ] Tambahkan kondisi tampilan ketika data belum tersedia.
- [ ] Pastikan draft tidak tampil di website publik.
- [ ] Hindari menampilkan data admin atau informasi internal.

## Kriteria selesai
Website publik membaca data dari sumber yang benar dan menangani kondisi data kosong tanpa error.

## Commit
Contoh: `feat(public): connect pages to database content`

---

# Tahap 12 — Pengguna, peran, dan hak akses

## Tujuan
Menerapkan RBAC jika kebutuhan pengelolaan memerlukan beberapa jenis admin.

## Langkah kerja
- [ ] Identifikasi peran nyata yang dibutuhkan.
- [ ] Definisikan izin per tindakan, misalnya melihat, membuat, mengubah, dan menghapus.
- [ ] Terapkan pemeriksaan izin di backend.
- [ ] Sesuaikan tampilan menu berdasarkan izin.
- [ ] Uji akses yang diizinkan dan ditolak.
- [ ] Buat akun dengan hak minimum yang diperlukan.

Jangan menambah peran hanya untuk memperbanyak fitur. Mulailah dari kebutuhan pengelolaan yang nyata. Jika menggunakan paket permission, periksa kompatibilitasnya dengan versi Laravel.

## Kriteria selesai
Pengguna hanya dapat melakukan tindakan yang diizinkan, termasuk ketika mencoba mengakses URL secara langsung.

## Commit
Contoh: `feat(auth): implement role-based permissions`

---

# Tahap 13 — Pengujian dan pemeriksaan kualitas

## Daftar pemeriksaan
- [ ] Uji alur tambah, lihat, ubah, dan hapus setiap fitur.
- [ ] Uji validasi input kosong dan input tidak valid.
- [ ] Uji otorisasi dan akses langsung ke URL admin.
- [ ] Uji unggahan berkas yang tidak diizinkan dan berukuran terlalu besar.
- [ ] Uji tampilan desktop dan perangkat seluler.
- [ ] Periksa tautan, gambar, dan kondisi data kosong.
- [ ] Jalankan pengujian otomatis yang tersedia.
- [ ] Periksa log aplikasi dan error di browser.
- [ ] Periksa `git diff` dan pastikan rahasia tidak ikut ter-commit.

Perintah yang mungkin digunakan, sesuai konfigurasi proyek:

```bash
php artisan test
npm run build
git status
git diff
```

## Kriteria selesai
Masalah yang menghalangi fungsi utama telah diselesaikan atau didokumentasikan. Tidak ada rahasia yang ikut dalam repository.

## Commit
Contoh: `test(app): cover core website workflows`

---

# Tahap 14 — Persiapan deployment

## Langkah kerja
- [ ] Tentukan lingkungan server dan domain.
- [ ] Siapkan database produksi.
- [ ] Atur environment variables melalui mekanisme aman.
- [ ] Pastikan `APP_DEBUG=false` di produksi.
- [ ] Jalankan migration dengan prosedur deployment yang tepat.
- [ ] Pastikan konfigurasi storage dan izin direktori benar.
- [ ] Bangun aset frontend untuk produksi.
- [ ] Siapkan backup database dan berkas penting.
- [ ] Uji login, halaman publik, dan pengelolaan konten setelah deployment.

## Kriteria selesai
Website berjalan di lingkungan target, konfigurasi sensitif tidak terekspos, dan proses backup/pemulihan telah dipertimbangkan.

## Commit
Contoh bila ada perubahan konfigurasi deployment dalam repository: `build(deploy): prepare production configuration`.

---

# Standar Git dan Conventional Commits

Format:

```text
<type>(<scope>): <deskripsi singkat>
```

Jenis commit yang umum:
- `feat`: fitur baru
- `fix`: perbaikan bug
- `refactor`: perubahan struktur tanpa mengubah perilaku yang dimaksud
- `style`: perubahan format atau gaya kode yang tidak mengubah logika
- `docs`: dokumentasi
- `test`: pengujian
- `build`: dependensi atau proses build
- `chore`: pemeliharaan
- `perf`: peningkatan performa
- `ci`: konfigurasi integrasi berkelanjutan

Alur sebelum commit:

```bash
git status
git diff
# Jalankan pengujian yang relevan
git add <file-atau-direktori-yang-relevan>
git diff --cached
git commit -m "feat(news): add news creation form"
```

Gunakan `git add` secara selektif jika ada perubahan lain yang belum siap. Jangan commit `.env`, kata sandi, token, atau rahasia lainnya. Buat commit setelah satu unit pekerjaan yang bermakna selesai, bukan setiap kali mengubah satu baris.

---

# Checklist penyelesaian fitur

Gunakan checklist ini untuk setiap fitur:

- [ ] Ruang lingkup fitur jelas.
- [ ] UI selesai dan responsif.
- [ ] Migration dan Model sesuai kebutuhan.
- [ ] Validasi menggunakan Form Request.
- [ ] Otorisasi backend diterapkan.
- [ ] CRUD dan alur utama berfungsi.
- [ ] Penanganan error dan pesan pengguna tersedia.
- [ ] Unggahan berkas aman jika digunakan.
- [ ] Pengujian relevan berhasil.
- [ ] `git diff` sudah ditinjau.
- [ ] Commit sesuai perubahan aktual.
- [ ] Dokumentasi diperbarui jika diperlukan.

---

# Dokumentasi resmi

Gunakan dokumentasi sesuai versi yang terpasang:
- Laravel: https://laravel.com/docs
- Blade: https://laravel.com/docs/blade
- Validation: https://laravel.com/docs/validation
- Eloquent: https://laravel.com/docs/eloquent
- Filesystem: https://laravel.com/docs/filesystem
- Tailwind CSS: https://tailwindcss.com/docs
- Alpine.js: https://alpinejs.dev/

## Prinsip utama

**Kerjakan satu tahap, verifikasi hasilnya, buat commit yang sesuai, lalu lanjut ke tahap berikutnya.** Jika menemukan masalah, selesaikan masalah tersebut sebelum memperluas ruang lingkup pekerjaan.
