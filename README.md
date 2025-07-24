# 📚 FreeClass – Sistem Peminjaman Ruang Kelas

FreeClass adalah sistem peminjaman ruang kelas yang memisahkan akses antara **admin (web)** dan **pengguna (mobile app)**. Didesain untuk mempermudah pengelolaan jadwal penggunaan ruang kelas secara real-time oleh mahasiswa, dosen, dan admin kampus.

---

## ✨ Fitur Utama

### 🔒 Website Admin (Laravel)
- Dashboard status ruang kelas: total kelas, kelas sedang dipakai, dan permintaan pending.
- Lihat dan kelola daftar peminjaman.
- Setujui atau tolak permintaan peminjaman (termasuk catatan log).
- Fitur undo keputusan (pending).
- Ganti ruangan pada saat konfirmasi peminjaman.
- Kelola jadwal rutin dan ruangan.

### 📱 Mobile App (React Native)
- Lihat daftar ruang kelas yang sedang terpakai.
- Ajukan peminjaman ruang dengan memilih tanggal, jam, dan ruangan yang tersedia.
- Lacak status peminjaman menggunakan kode unik.

---

## ⚙️ Teknologi yang Digunakan

| Layer     | Teknologi                                                 |
|-----------|-----------------------------------------------|
| Backend   | Laravel 10, MySQL, REST API                   |
| Frontend  | React Native, Async Storage                   |
| API Tunnel| Baseurl web device(otomatis diperbarui via script)        |
| Tools     | Axios, Carbon, Bootstrap, Exposio UI          |

## ⚙️ Kontributor
- 👩‍💻 Tiurma (Data Analyst)
- 👩‍💻 Rhainy (Mobile Dev)
- 👩‍💻 Utza (Web Dev)
- 👩‍💻 Pak Febri (Dosen Pengampu)
- 👩‍💻 Teh Risma & Teh Rohmah (Asisten Dosen)


### Dibuat untuk menyelesaikan tugas akhir Mata Kuliah Pemograman Web dan Pemograman Perangkat Bergerak TA. 2025, Teknologi Informasi, Fakultas Informatika & Pariwisata, IBI Kesatuan Bogor 
