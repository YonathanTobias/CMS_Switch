<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin IT (Super User) and Admin Divisi
        $superAdmin = User::updateOrCreate(
            ['email' => 'it@pantiwaluya.ac.id'],
            [
                'name' => 'Admin IT (Super User)',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $divisionAdmin = User::updateOrCreate(
            ['email' => 'divisi@pantiwaluya.ac.id'],
            [
                'name' => 'Staf Admin Divisi',
                'role' => 'division_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Alias for admin@pantiwaluya.ac.id as Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@pantiwaluya.ac.id'],
            [
                'name' => 'Administrator Utama (Super User)',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Default Division Settings (Default: LPPM STIKES Panti Waluya)
        $defaultSettings = [
            // Identitas Divisi
            'division_name' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)',
            'division_short_name' => 'LPPM STIKES Panti Waluya',
            'division_acronym' => 'LPPM',
            'division_tagline' => 'Mendorong Riset & Pengabdian Berbasis Pelayanan Kesehatan Holistik',
            'parent_institution' => 'STIKES Panti Waluya Malang',
            
            // Visual & Branding
            'theme_primary_color' => '#0e7490', // Cyan-700 / Teal
            'theme_secondary_color' => '#0369a1', // Sky-700
            'theme_accent_color' => '#059669', // Emerald-600
            'logo_url' => '',
            'hero_banner_title' => 'Pusat Penelitian & Pengabdian Masyarakat Unggul',
            'hero_banner_subtitle' => 'Mengembangkan ilmu pengetahuan, riset klinis, dan pemberdayaan masyarakat di bidang kesehatan yang berkualitas dan berdaya saing.',

            // Tentang & Visi Misi
            'about_title' => 'Tentang LPPM STIKES Panti Waluya',
            'about_description' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) STIKES Panti Waluya Malang merupakan unit pelaksana akademik yang bertugas mengoordinasikan, memfasilitasi, dan mengarahkan kegiatan penelitian dan pengabdian masyarakat dosen dan mahasiswa.',
            'vision' => 'Menjadi pusat pengembangan riset kesehatan dan pengabdian masyarakat yang inovatif, berlandaskan cinta kasih dan etika profesi kesehatan pada tahun 2030.',
            'mission' => "1. Menumbuhkembangkan budaya riset kesehatan yang berorientasi pada peningkatan kualitas asuhan kesehatan.\n2. Melaksanakan pengabdian kepada masyarakat yang berbasis hasil riset untuk meningkatkan derajat kesehatan komunitas.\n3. Memfasilitasi hilirisasi, publikasi ilmiah di jurnal nasional/internasional terakreditasi, serta perolehan Hak Kekayaan Intelektual (HKI).\n4. Membangun kemitraan strategis dengan institusi pelayanan kesehatan, pemerintah daerah, dan industri.",
            
            // Kontak & Lokasi
            'contact_email' => 'lppm@pantiwaluya.ac.id',
            'contact_phone' => '(0341) 569275',
            'contact_whatsapp' => '081234567890',
            'contact_room' => 'Gedung Rektorat Lt. 2, Kampus STIKES Panti Waluya Malang',
            'contact_address' => 'Jl. Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang, Jawa Timur 65117',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.213601444588!2d112.62473467499647!3d-7.976868692048386!2m3!1f0!2f0!3f0!3m2!1i1024!2f768!4f13.1!3m3!1m2!1s0x2dd62828b49e1a17%3A0xc3cb73f1d3c01fa9!2sSTIKes%20Panti%20Waluya%20Malang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',

            // Media Sosial
            'social_instagram' => 'https://instagram.com/stikespantiwaluya',
            'social_facebook' => 'https://facebook.com/stikespantiwaluyamalang',
            'social_youtube' => 'https://youtube.com/@stikespantiwaluya',
            'social_website' => 'https://pantiwaluya.ac.id',

            // Statistik Ringkas di Beranda
            'stat_1_number' => '120+',
            'stat_1_label' => 'Publikasi Ilmiah',
            'stat_2_number' => '45+',
            'stat_2_label' => 'Pengabdian Masyarakat',
            'stat_3_number' => '25+',
            'stat_3_label' => 'HKI & Hak Cipta',
            'stat_4_number' => '15+',
            'stat_4_label' => 'Mitra Kerjasama',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        // 3. Categories
        $cat1 = Category::updateOrCreate(['slug' => 'penelitian'], ['name' => 'Penelitian & Riset', 'type' => 'post', 'description' => 'Informasi hibah dan riset dosen']);
        $cat2 = Category::updateOrCreate(['slug' => 'pengabdian'], ['name' => 'Pengabdian Masyarakat', 'type' => 'post', 'description' => 'Kegiatan pengmas dan bakti sosial']);
        $cat3 = Category::updateOrCreate(['slug' => 'pengumuman-hibah'], ['name' => 'Pengumuman & Hibah', 'type' => 'post', 'description' => 'Info call for proposal dan edaran']);
        $catDoc1 = Category::updateOrCreate(['slug' => 'panduan-sop'], ['name' => 'Panduan & SOP', 'type' => 'document', 'description' => 'Buku pedoman & SOP']);
        $catDoc2 = Category::updateOrCreate(['slug' => 'template-form'], ['name' => 'Template & Formulir', 'type' => 'document', 'description' => 'Formulir pengajuan']);

        // 4. Sample Posts (Berita & Pengumuman)
        Post::updateOrCreate(
            ['slug' => 'penerimaan-proposal-penelitian-dan-pengabdian-internal-tahun-2025'],
            [
                'title' => 'Penerimaan Proposal Penelitian dan Pengabdian Internal Tahun 2025',
                'category_id' => $cat3->id,
                'user_id' => $admin->id,
                'type' => 'pengumuman',
                'summary' => 'LPPM STIKES Panti Waluya membuka pendaftaran hibah penelitian dan pengmas internal untuk dosen dan mahasiswa.',
                'content' => '<p>Diberitahukan kepada seluruh dosen dan sivitas akademika STIKES Panti Waluya Malang, bahwa pendaftaran proposal hibah internal untuk skim penelitian dosen pemula, penelitian terapan, dan pengabdian masyarakat telah resmi dibuka mulai 1 Maret hingga 15 April 2025.</p><p>Panduan pengusulan dapat diunduh pada menu Pusat Unduhan. Pengumpulan proposal dilakukan secara daring melalui sistem LPPM.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 142,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'pelatihan-penulisan-artikel-ilmiah-bereputasi-internasional-scopus'],
            [
                'title' => 'Workshop Penulisan Artikel Ilmiah Bereputasi Internasional Scopus & Sinta',
                'category_id' => $cat1->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'Meningkatkan produktivitas publikasi dosen di bidang keperawatan dan farmasi melalui workshop intensif.',
                'content' => '<p>Dalam rangka mendorong peningkatan jumlah publikasi internasional, LPPM STIKES Panti Waluya menyelenggarakan Workshop Penulisan Artikel Ilmiah Bereputasi yang dihadiri oleh seluruh dosen prodi Keperawatan dan Farmasi. Narasumber terkemuka membagikan strategi submit jurnal Q1 dan tips menghadapi reviewer.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 218,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'kegiatan-pemberdayaan-kader-kesehatan-lansia-di-wilayah-malang'],
            [
                'title' => 'Kegiatan Pemberdayaan Kader Kesehatan Lansia di Wilayah Malang',
                'category_id' => $cat2->id,
                'user_id' => $admin->id,
                'type' => 'berita',
                'summary' => 'Tim Pengabdi STIKES Panti Waluya mengadakan pelatihan deteksi dini penyakit degeneratif bagi kader lansia.',
                'content' => '<p>Sebagai wujud Tri Dharma Perguruan Tinggi, tim dosen dan mahasiswa melaksanakan pengabdian masyarakat di Posyandu Lansia. Kegiatan meliputi pemeriksaan tekanan darah, gula darah, edukasi nutrisi lansia, dan senam kebugaran lansia.</p>',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views_count' => 89,
            ]
        );

        // 5. Sample Services (Layanan Divisi)
        Service::updateOrCreate(
            ['slug' => 'layanan-ethical-clearance-komisi-etik'],
            [
                'title' => 'Layanan Kaji Etik Penelitian (Ethical Clearance)',
                'icon' => 'fa-solid fa-file-shield',
                'summary' => 'Pengajuan dan telaah kelayakan etik untuk penelitian kesehatan yang melibatkan subjek manusia.',
                'description' => 'Komite Etik Penelitian Kesehatan (KEPK) di bawah koordinasi LPPM memberikan sertifikat Ethical Clearance bagi peneliti dosen dan mahasiswa untuk memastikan penelitian memenuhi standar perlindungan subjek manusia.',
                'requirements' => "1. Surat Pengantar dari Prodi / Institusi\n2. Proposal Penelitian Lengkap\n3. Lembar Informed Consent & Kuesioner/Alat Ukur\n4. Curriculum Vitae Peneliti Utama",
                'procedure' => "1. Peneliti mengisi form permohonan etik di web LPPM.\n2. Mengunggah berkas proposal & instrumen.\n3. Tim penelaah KEPK melakukan review etik (Full board / Expedited).\n4. Terbitnya Surat Keterangan Lolos Kaji Etik (Ethical Approval).",
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'fasilitasi-hki-dan-hak-cipta'],
            [
                'title' => 'Fasilitasi Pendaftaran HKI & Hak Cipta',
                'icon' => 'fa-solid fa-certificate',
                'summary' => 'Bantuan pengurusan pendaftaran hak cipta modul, buku, aplikasi, dan paten ke DJKI Kemenkumham.',
                'description' => 'Membantu dosen dan mahasiswa dalam proses perlindungan hak kekayaan intelektual atas karya inovasi, modul pembelajaran kesehatan, dan karya cipta lainnya.',
                'requirements' => "1. Karya Cipta (Buku/Modul/Software/Poster)\n2. Form Pendaftaran Hak Cipta\n3. Surat Pernyataan Keaslian Karya Bermaterai\n4. KTP Seluruh Pencipta",
                'procedure' => "1. Mengajukan draf karya ke LPPM.\n2. Verifikasi berkas oleh admin Sentra HKI.\n3. Pendaftaran ke portal DJKI Kemenkumham.\n4. Penyerahan Sertifikat Hak Cipta resmi.",
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'klinik-manuskrip-dan-insentif-publikasi'],
            [
                'title' => 'Klinik Manuskrip & Insentif Publikasi',
                'icon' => 'fa-solid fa-pen-nib',
                'summary' => 'Pendampingan penulisan naskah jurnal, proofreading, cek plagiarisme Turnitin, dan insentif publikasi.',
                'description' => 'Layanan bantuan peningkatan kualitas naskah ilmiah dosen sebelum disubmit ke jurnal nasional terakreditasi SINTA atau jurnal internasional bereputasi.',
                'requirements' => "1. Draf Naskah Lengkap (IMRAD format)\n2. Target Jurnal Tujuan\n3. Hasil Cek Similaritas Turnitin (bisa difasilitasi LPPM)",
                'procedure' => "1. Kirim draf naskah via sistem.\n2. Review oleh reviewer internal LPPM.\n3. Perbaikan draf dan proofreading.\n4. Bantuan submit jurnal dan klaim insentif jika telah terbit.",
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        // 6. Sample Team Members
        TeamMember::updateOrCreate(
            ['name' => 'Ns. Maria Magdalena, M.Kep.'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.MB',
                'identifier' => 'NIDN. 0712058501',
                'position' => 'Kepala LPPM',
                'bio' => 'Dosen Keperawatan Medikal Bedah dengan fokus riset manajemen luka kronis dan keperawatan kardiovaskuler.',
                'email' => 'maria.magdalena@pantiwaluya.ac.id',
                'phone' => '081234567891',
                'order_index' => 1,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'apt. Yohanes Baptista, M.Farm.'],
            [
                'title_degree' => 'M.Farm.',
                'identifier' => 'NIDN. 0725088902',
                'position' => 'Sekretaris & Koordinator Penelitian',
                'bio' => 'Dosen Farmasi dengan fokus riset formulasi obat herbal dan farmasi klinis komunitas.',
                'email' => 'yohanes.baptista@pantiwaluya.ac.id',
                'phone' => '081234567892',
                'order_index' => 2,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Theresia Avila, M.Kes.'],
            [
                'title_degree' => 'M.Kes.',
                'identifier' => 'NIDN. 0718109003',
                'position' => 'Koordinator Pengabdian Masyarakat',
                'bio' => 'Dosen Keperawatan Komunitas dengan keahlian dalam promosi kesehatan masyarakat dan penanganan stunting.',
                'email' => 'theresia.avila@pantiwaluya.ac.id',
                'phone' => '081234567893',
                'order_index' => 3,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Antonius Joko Santoso, S.Kom.'],
            [
                'title_degree' => 'S.Kom.',
                'identifier' => 'NIP. 202109004',
                'position' => 'Staf Administrasi & Sentra HKI',
                'bio' => 'Pengelola sistem informasi riset, repository dokumen LPPM, dan administrasi pendaftaran HKI.',
                'email' => 'antonius.joko@pantiwaluya.ac.id',
                'phone' => '081234567894',
                'order_index' => 4,
            ]
        );

        // 7. Sample Events
        Event::updateOrCreate(
            ['slug' => 'seminar-nasional-keperawatan-dan-kesehatan-2025'],
            [
                'title' => 'Seminar Nasional Kesehatan: Inovasi Asuhan Keperawatan Berbasis Bukti di Era Digital',
                'location' => 'Auditorium STIKES Panti Waluya & Zoom Meeting',
                'start_date' => now()->addDays(14)->setTime(8, 30),
                'end_date' => now()->addDays(14)->setTime(16, 0),
                'description' => 'Seminar nasional tahunan menghadirkan pakar kesehatan nasional dan internasional serta sesi oral presentation riset terpilih.',
                'registration_link' => 'https://bit.ly/SemnasPantiwaluya2025',
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'batas-akhir-pengumpulan-laporan-kemajuan-hibah-internal'],
            [
                'title' => 'Deadline Unggah Laporan Kemajuan Hibah Internal 2025',
                'location' => 'Portal Sistem LPPM Online',
                'start_date' => now()->addDays(30)->setTime(23, 59),
                'end_date' => now()->addDays(30)->setTime(23, 59),
                'description' => 'Batas akhir pengunggahan laporan kemajuan 70% dan laporan penggunaan anggaran termin pertama bagi penerima hibah.',
                'registration_link' => '',
                'is_active' => true,
            ]
        );

        // 8. Sample Documents
        Document::updateOrCreate(
            ['title' => 'Buku Panduan Penelitian dan Pengabdian Masyarakat Edisi 2025'],
            [
                'category_id' => $catDoc1->id,
                'file_path' => 'documents/sample_panduan_lppm_2025.pdf',
                'file_type' => 'PDF',
                'file_size' => '2.4 MB',
                'description' => 'Pedoman teknis pengusulan proposal, format laporan kemajuan, dan kriteria penilaian hibah internal.',
                'downloads_count' => 320,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Formulir Permohonan Kaji Etik Penelitian (KEPK)'],
            [
                'category_id' => $catDoc2->id,
                'file_path' => 'documents/form_pengajuan_etik.docx',
                'file_type' => 'DOCX',
                'file_size' => '450 KB',
                'description' => 'Form isian protokol etik, informed consent, dan daftar tilang mandiri KEPK.',
                'downloads_count' => 185,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'SOP Pengajuan Insentif Publikasi Artikel Ilmiah'],
            [
                'category_id' => $catDoc1->id,
                'file_path' => 'documents/sop_insentif_publikasi.pdf',
                'file_type' => 'PDF',
                'file_size' => '820 KB',
                'description' => 'Prosedur operasional baku pencairan reward publikasi jurnal nasional Sinta dan Scopus.',
                'downloads_count' => 97,
                'is_published' => true,
            ]
        );

        // 10. Sample Carousel Banner Slides
        \App\Models\Carousel::updateOrCreate(
            ['title' => 'Pusat Riset Kesehatan & Pengabdian Masyarakat Unggul'],
            [
                'subtitle' => 'Mendorong inovasi asuhan kesehatan, publikasi internasional bereputasi, serta hilirisasi produk herbal terapan.',
                'image_path' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Jelajahi Layanan Divisi',
                'button_link' => '/layanan',
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        \App\Models\Carousel::updateOrCreate(
            ['title' => 'Layanan Kaji Etik Penelitian Kesehatan (Ethical Clearance)'],
            [
                'subtitle' => 'Fasilitasi telaah kelayakan etik penelitian untuk dosen, mahasiswa, dan peneliti eksternal secara terstandar.',
                'image_path' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Ajukan Kaji Etik',
                'button_link' => '/layanan/layanan-ethical-clearance-komisi-etik',
                'order_index' => 2,
                'is_active' => true,
            ]
        );
    }
}
