<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Issue::factory(5)->create();
       $admin = User::where('email', 'admin@gmail.com')->first();

        if (!$admin) {
            $this->command->error('User dengan email admin@gmail.com tidak ditemukan.');
            return;
        }

        $issues = [
            [
                'title' => 'Tidak bisa login',
                'description' => 'Setelah update aplikasi, saya tidak bisa login menggunakan akun Google.',
                'status' => 'open',
                'response' => null,
            ],
            [
                'title' => 'Data jadwal tidak tersimpan',
                'description' => 'Saya sudah mengisi jadwal medis, tapi setelah submit datanya hilang.',
                'status' => 'in_progress',
                'response' => null,
            ],
            [
                'title' => 'Grafik tidak muncul di dashboard',
                'description' => 'Bagian grafik kesehatan hanya loading terus dan tidak muncul.',
                'status' => 'resolved',
                'response' => 'Masalah ini terjadi karena koneksi lambat. Kami sudah optimasi dan perbaiki pada versi terbaru.',
            ],
            [
                'title' => 'Notifikasi pengingat tidak jalan',
                'description' => 'Saya tidak menerima notifikasi padahal sudah atur pengingat.',
                'status' => 'open',
                'response' => null,
            ],
            [
                'title' => 'Kesalahan pada export PDF',
                'description' => 'Saat saya coba download hasil monitoring, file PDF tidak bisa dibuka.',
                'status' => 'resolved',
                'response' => 'Sudah diperbaiki. Sekarang PDF bisa diunduh dan dibuka dengan baik.',
            ],
            [
                'title' => 'Aplikasi crash saat membuka forum',
                'description' => 'Ketika saya buka fitur forum komunitas, aplikasinya langsung force close.',
                'status' => 'in_progress',
                'response' => null,
            ],
            [
                'title' => 'Tampilan halaman dashboard berantakan',
                'description' => 'Layout dashboard terlihat rusak setelah saya buka di tablet.',
                'status' => 'resolved',
                'response' => 'Sudah dilakukan penyesuaian tampilan responsive untuk tablet dan mobile.',
            ],
            [
                'title' => 'Saran: Tambah fitur dark mode',
                'description' => 'Akan lebih nyaman jika aplikasi punya dark mode.',
                'status' => 'open',
                'response' => null,
            ],
            [
                'title' => 'Gagal ubah password',
                'description' => 'Saat mencoba ubah password, muncul error "token invalid".',
                'status' => 'resolved',
                'response' => 'Token reset password sekarang sudah dibenahi, silakan coba ulangi.',
            ],
            [
                'title' => 'Loading lama di halaman login',
                'description' => 'Halaman login butuh waktu lama untuk tampil sepenuhnya.',
                'status' => 'in_progress',
                'response' => null,
            ],
        ];

        foreach ($issues as $issue) {
            Issue::create(array_merge($issue, [
                'user_id' => $admin->id,
            ]));
        }

        $this->command->info('Dummy issue berhasil dibuat untuk admin@gmail.com!');

    }
}
