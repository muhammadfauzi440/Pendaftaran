<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Instansi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([InstansiSeeder::class]);

        User::create([
            'name' => 'Admin Global Intermedia',
            'email' => 'admin@gi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        $instansis = Instansi::all();

        $daftarStatus = ['pending', 'diterima', 'ditolak'];

        foreach ($daftarStatus as $status) {
            $user = User::create([
                'name' => "Pendaftar " . ucfirst($status),
                'email' => "user_$status@gmail.com",
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]);

            Pendaftaran::create([
                'user_id' => $user->id,
                'instansi_id' => $instansis->random()->id,
                'kategori' => 'Mahasiswa',
                'kelas_semester' => 'Semester 5',
                'nim_nisn' => rand(10000000, 99999999),
                'jurusan' => 'Teknik Informatika',
                'tanggal_mulai' => now()->addDays(14),
                'tanggal_selesai' => now()->addMonths(4),
                'durasi_bulan' => 4,
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => now()->subYears(20)->format('Y-m-d'),
                'alamat' => 'Jl Pegangsaan Timur',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'kontak' => '081234567' . rand(100, 999),
                'status' => $status,
                'catatan_admin' => ($status == 'pending') 
                ? null : 
                ($status == 'diterima' ? "Selamat, pendaftaran Anda diterima!" : "Mohon Maaf, pendaftaran Anda belum bisa kami terima.")
            ]);
        }
    }
}
