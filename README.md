# Sistem Pendaftaran Magang (Laravel 12)

Sistem informasi pendaftaran magang berbasis web yang dibangun menggunakan **Laravel 12**, **Tailwind CSS**, dan **MySQL**. Aplikasi ini dirancang untuk memudahkan manajemen pendaftar dan instansi dalam satu platform terpusat.

## Fitur Utama
- **Manajemen Pendaftar**: CRUD data pendaftar magang.
- **Manajemen Instansi**: CRUD data instansi/perusahaan tujuan.
- **Status Approval**: Pengelolaan status (Pending, Diterima, Ditolak).
- **Export Data**: Export daftar pendaftar ke format Excel dan PDF.
- **UI/UX Modern**: Antarmuka responsif dengan desain minimalis menggunakan Tailwind CSS.

---

## Panduan Instalasi Localhost

Ikuti langkah-langkah di bawah ini untuk menjalankan project di komputer lokal Anda (menggunakan XAMPP/Laragon).

### 1. Persyaratan Sistem
Pastikan komputer Anda sudah terinstal:
- PHP >= 8.2
- Composer
- MySQL (XAMPP/Laragon)
- Node.js & NPM

### 2. Clone Repository
Buka terminal atau CMD, arahkan ke folder `htdocs` (jika menggunakan XAMPP), lalu jalankan:
```bash
git clone [https://github.com/muhammadfauzi440/Pendaftaran.git](https://github.com/muhammadfauzi440/Pendaftaran.git)
cd Pendaftaran
```
### 3. Instalasi Dependency
Instal library PHP melalui Composer:

```bash
composer install
```
### Instal asset frontend melalui NPM:
```bash
npm install
```
### 4. Konfigurasi Environment
Salin fle `.env.example` menjadi `.env`:
```bash
cp .env.example .env
