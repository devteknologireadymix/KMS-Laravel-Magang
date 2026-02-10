<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Content;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data yang sudah dibuat oleh InitKmsSeeder
        $app1 = App::where('slug', 'app1')->first();
        $app2 = App::where('slug', 'app2')->first();
        $app3 = App::where('slug', 'app3')->first();

        $superadmin = User::where('email', 'super@readymix.com')->first();
        $admin = User::where('email', 'admin@readymix.com')->first();
        $niam = User::where('email', 'niam@readymix.com')->first();
        $public = User::where('email', 'public@readymix.com')->first();

        // Sample contents untuk App1
        $contentsApp1 = [
            [
                'app_id' => $app1->id,
                'user_id' => $admin->id,
                'title' => 'Pengiriman Beton K-225 ke Proyek Perumahan Grand View',
                'body' => 'Laporan pengiriman beton ready mix K-225 sebanyak 15 m³ ke proyek pembangunan perumahan Grand View, Tangerang. Pengiriman dilakukan pada pukul 08:00 WIB dengan 2 truk mixer. Kondisi cuaca cerah, proses pengecoran berjalan lancar tanpa kendala.',
                'status' => 'draft',
                'published_at' => null,
                'approved_by' => null,
                'note_project' => null,
            ],
            [
                'app_id' => $app1->id,
                'user_id' => $admin->id,
                'title' => 'Pengiriman Beton K-300 ke Proyek Gedung Perkantoran Sudirman',
                'body' => 'Pengiriman beton ready mix K-300 sebanyak 30 m³ untuk proyek pembangunan gedung perkantoran 10 lantai di Jl. Sudirman, Jakarta Pusat. Pengiriman terbagi dalam 3 batch dengan interval 30 menit. Total 4 truk mixer digunakan. Proses slump test menunjukkan hasil sesuai standar 12±2 cm.',
                'status' => 'pending',
                'published_at' => null,
                'approved_by' => null,
                'note_project' => 'Menunggu approval dari project manager untuk proses selanjutnya',
            ],
            [
                'app_id' => $app1->id,
                'user_id' => $niam->id,
                'title' => 'Pengiriman Beton K-250 ke Proyek Jembatan Layang Tol',
                'body' => 'Laporan pengiriman beton K-250 untuk proyek pembangunan jembatan layang tol Jakarta-Cikampek KM 35. Total volume 50 m³ dengan mutu beton K-250. Pengiriman menggunakan 6 truk mixer dengan sistem continuous pour. Quality control dilakukan oleh tim QC kontraktor dan sudah dinyatakan lolos standar SNI.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
                'approved_by' => $superadmin->id,
                'note_project' => 'Approved - Sesuai spesifikasi teknis proyek. Kualitas excellent.',
            ],
        ];

        // Sample contents untuk App2
        $contentsApp2 = [
            [
                'app_id' => $app2->id,
                'user_id' => $niam->id,
                'title' => 'Pengiriman Beton K-350 ke Proyek Apartemen High Rise BSD',
                'body' => 'Pengiriman beton mutu tinggi K-350 untuk struktur core wall apartemen 25 lantai di BSD City. Total volume 40 m³ dengan additive superplasticizer untuk workability tinggi. Pengiriman menggunakan concrete pump dengan tinggi pompa 80 meter. Proses pengecoran core wall lantai 15-17 berjalan sukses.',
                'status' => 'pending',
                'published_at' => null,
                'approved_by' => null,
                'note_project' => 'Urgent - Butuh approval sebelum pengecoran besok pagi jam 06:00',
            ],
            [
                'app_id' => $app2->id,
                'user_id' => $admin->id,
                'title' => 'Pengiriman Beton K-400 ke Proyek Basement Mall Pondok Indah',
                'body' => 'Laporan pengiriman beton K-400 untuk struktur basement 3 lantai mall di kawasan Pondok Indah. Volume total 60 m³ dengan spesifikasi waterproof additive dan steel fiber reinforcement. Pengiriman dilakukan malam hari (23:00-04:00 WIB) untuk menghindari traffic jam. Quality test menunjukkan slump 12 cm dan compressive strength sesuai standar.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'approved_by' => $superadmin->id,
                'note_project' => 'Approved - Excellent quality, sesuai timeline. Good job team!',
            ],
            [
                'app_id' => $app2->id,
                'user_id' => $public->id,
                'title' => 'Pengiriman Beton K-175 ke Proyek Jalan Raya Cibitung',
                'body' => 'Pengiriman beton K-175 untuk perbaikan jalan raya di kawasan industri Cibitung. Volume pengiriman 20 m³. Pengiriman dilakukan dengan 3 truk mixer pada pukul 10:00 WIB.',
                'status' => 'rejected',
                'published_at' => null,
                'approved_by' => $superadmin->id,
                'note_project' => 'Rejected - Spesifikasi mutu beton tidak sesuai dengan request order. Harap gunakan K-225 sesuai dokumen tender. Silakan revisi dan submit ulang.',
            ],
        ];

        // Sample contents untuk App3
        $contentsApp3 = [
            [
                'app_id' => $app3->id,
                'user_id' => $admin->id,
                'title' => 'Pengiriman Beton K-200 ke Proyek Gudang Logistik Karawang',
                'body' => 'Draft laporan pengiriman beton K-200 untuk lantai gudang logistik di Karawang Industrial Estate. Estimasi volume 35 m³ dengan ketebalan lantai 15 cm. Masih dalam tahap koordinasi dengan site manager untuk jadwal pengecoran yang optimal.',
                'status' => 'draft',
                'published_at' => null,
                'approved_by' => null,
                'note_project' => null,
            ],
            [
                'app_id' => $app3->id,
                'user_id' => $niam->id,
                'title' => 'Pengiriman Beton K-275 ke Proyek Pabrik Manufaktur Cikarang',
                'body' => 'Pengiriman beton K-275 untuk pondasi mesin-mesin berat di pabrik manufaktur Cikarang. Volume 25 m³ dengan reinforcement fiber untuk ketahanan tambahan terhadap getaran mesin. Jadwal pengiriman Sabtu pagi jam 07:00 untuk menghindari gangguan operasional pabrik.',
                'status' => 'pending',
                'published_at' => null,
                'approved_by' => null,
                'note_project' => 'Perlu koordinasi dengan safety officer untuk akses truk mixer ke area produksi',
            ],
            [
                'app_id' => $app3->id,
                'user_id' => $admin->id,
                'title' => 'Pengiriman Beton K-325 untuk Kolom Gedung Bertingkat Kuningan',
                'body' => 'Laporan pengiriman beton K-325 untuk pengecoran kolom struktur gedung bertingkat 15 lantai di kawasan Kuningan, Jakarta Selatan. Volume 45 m³ dengan additive retarder untuk memperlambat setting time selama proses pengecoran. Proses continuous pour selama 6 jam berjalan sukses tanpa cold joint. Curing dilakukan dengan water spraying setiap 2 jam.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDay(),
                'approved_by' => $superadmin->id,
                'note_project' => 'Approved - Kualitas sangat baik, tidak ada segregasi. Proses curing sudah sesuai SOP.',
            ],
            [
                'app_id' => $app3->id,
                'user_id' => $public->id,
                'title' => 'Pengiriman Beton K-150 ke Proyek Saluran Drainase',
                'body' => 'Pengiriman beton K-150 untuk pembuatan saluran drainase di kompleks perumahan. Volume 10 m³ untuk panjang drainase 50 meter.',
                'status' => 'rejected',
                'published_at' => null,
                'approved_by' => $niam->id,
                'note_project' => 'Rejected - Volume tidak mencukupi kebutuhan proyek, perlu revisi order. Minimal order untuk proyek ini adalah 15 m³. Silakan submit order baru.',
            ],
        ];

        // Insert semua data
        $allContents = array_merge($contentsApp1, $contentsApp2, $contentsApp3);
        
        foreach ($allContents as $content) {
            Content::create($content);
        }

        $this->command->info('' . count($allContents) . ' sample contents created successfully!');
        $this->command->info('   - App1: ' . count($contentsApp1) . ' contents');
        $this->command->info('   - App2: ' . count($contentsApp2) . ' contents');
        $this->command->info('   - App3: ' . count($contentsApp3) . ' contents');
    }
}