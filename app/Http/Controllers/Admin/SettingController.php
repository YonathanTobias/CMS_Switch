<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $presets = $this->getAvailablePresets();

        return view('admin.settings.index', compact('settings', 'presets'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo', 'hero_image']);

        // Handle file uploads (Logo & Hero Image)
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('branding', 'public');
            Setting::set('logo_url', '/storage/' . $logoPath);
        }

        if ($request->hasFile('hero_image')) {
            $heroPath = $request->file('hero_image')->store('branding', 'public');
            Setting::set('hero_image_url', '/storage/' . $heroPath);
        }

        // Save all text settings
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        Setting::clearCache();

        return back()->with('success', 'Pengaturan identitas divisi dan tampilan berhasil disimpan.');
    }

    /**
     * Apply Preset to instantly change the website to another division
     */
    public function applyPreset(Request $request)
    {
        $request->validate(['preset_key' => 'required|string']);
        $presets = $this->getAvailablePresets();

        if (!isset($presets[$request->preset_key])) {
            return back()->with('error', 'Preset divisi tidak ditemukan.');
        }

        $selectedPreset = $presets[$request->preset_key]['settings'];

        foreach ($selectedPreset as $key => $value) {
            Setting::set($key, $value);
        }

        Setting::clearCache();

        return back()->with('success', 'Berhasil menerapkan preset divisi: ' . $presets[$request->preset_key]['name'] . '. Seluruh identitas website telah diperbarui.');
    }

    /**
     * Definition of available division presets for STIKES Panti Waluya
     */
    private function getAvailablePresets(): array
    {
        return [
            'lpmi' => [
                'name' => 'Lembaga Penjaminan Mutu Internal (LPMI)',
                'badge' => 'Mutu & SPMI',
                'color' => '#0f766e',
                'description' => 'Preset untuk Lembaga Penjaminan Mutu Internal (LPMI) STIKES Panti Waluya.',
                'settings' => [
                    'division_type' => 'lembaga',
                    'division_name' => 'Lembaga Penjaminan Mutu Internal (LPMI)',
                    'division_short_name' => 'LPMI STIKES Panti Waluya',
                    'division_acronym' => 'LPMI',
                    'division_tagline' => 'Mengawal Mutu Pendidikan Tinggi Kesehatan Menuju Akreditasi Unggul',
                    'theme_primary_color' => '#0f766e', // Teal 700
                    'theme_secondary_color' => '#115e59',
                    'hero_banner_title' => 'Sistem Penjaminan Mutu Internal (SPMI) Terpadu',
                    'hero_banner_subtitle' => 'Melaksanakan siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, Peningkatan) secara berkelanjutan.',
                    'about_title' => 'Tentang Lembaga Penjaminan Mutu Internal',
                    'about_description' => 'LPMI bertanggung jawab dalam perumusan standar mutu, pelaksanaan Audit Mutu Internal (AMI), monitoring kepuasan pemangku kepentingan, dan pendampingan akreditasi LAM-PTKes.',
                    'vision' => 'Menjadi pengawal penjaminan mutu yang kredibel dan terpercaya untuk mewujudkan budaya mutu berkarakter kasih di STIKES Panti Waluya pada tahun 2030.',
                    'mission' => "1. Merumuskan dan memutakhirkan Standar SPMI berbasis SN-Dikti.\n2. Melaksanakan Audit Mutu Internal (AMI) secara berkala dan konsisten.\n3. Mengukur kepuasan mahasiswa, dosen, tenaga kependidikan, dan mitra pengguna lulusan.\n4. Mengawal tindak lanjut temuan audit melalui Rapat Tinjauan Manajemen (RTM).",
                    'contact_email' => 'lpmi@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 105',
                    'contact_room' => 'Gedung Rektorat Lt. 2',
                    'stat_1_number' => '48',
                    'stat_1_label' => 'Standar Mutu SPMI',
                    'stat_2_number' => '2x / Thn',
                    'stat_2_label' => 'Siklus Audit Mutu (AMI)',
                    'stat_3_number' => '20',
                    'stat_3_label' => 'Auditor Bersertifikat',
                    'stat_4_number' => '97%',
                    'stat_4_label' => 'Indeks Kepuasan Layanan',
                ],
            ],
            'lppm' => [
                'name' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)',
                'badge' => 'Riset & Pengmas',
                'color' => '#0e7490',
                'description' => 'Preset untuk Lembaga Penelitian dan Pengabdian kepada Masyarakat STIKES Panti Waluya.',
                'settings' => [
                    'division_type' => 'lembaga',
                    'division_name' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)',
                    'division_short_name' => 'LPPM STIKES Panti Waluya',
                    'division_acronym' => 'LPPM',
                    'division_tagline' => 'Mendorong Riset Klinis Kesehatan & Pengabdian Masyarakat Berkarakter Kasih',
                    'theme_primary_color' => '#0e7490', // Cyan 700
                    'theme_secondary_color' => '#0369a1',
                    'hero_banner_title' => 'Pusat Riset Kesehatan & Pengabdian Masyarakat Unggul',
                    'hero_banner_subtitle' => 'Mengembangkan riset klinis kesehatan, inovasi herbal, komisi etik (KEPK), dan sentra HKI berdaya saing.',
                    'about_title' => 'Tentang LPPM STIKES Panti Waluya',
                    'about_description' => 'LPPM mengoordinasikan, memfasilitasi, dan meningkatkan kualitas riset ilmiah dosen-mahasiswa, hilirisasi produk inovasi, pengabdian masyarakat, sentra HKI, serta Komite Etik Penelitian Kesehatan (KEPK).',
                    'vision' => 'Menjadi pusat penelitian kesehatan dan pengabdian masyarakat unggul, inovatif, dan berkarakter kasih pada tahun 2030.',
                    'mission' => "1. Menumbuhkan iklim riset kesehatan holistik yang berkualitas.\n2. Melaksanakan pengabdian masyarakat berbasis bukti ilmiah (evidence-based).\n3. Memfasilitasi publikasi jurnal nasional terakreditasi Sinta, internasional Scopus, dan perolehan HKI.\n4. Memperluas jejaring riset dengan rumah sakit dan institusi mitra nasional & global.",
                    'contact_email' => 'lppm@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 104',
                    'contact_room' => 'Gedung Rektorat Lt. 2',
                    'stat_1_number' => '135+',
                    'stat_1_label' => 'Publikasi Ilmiah',
                    'stat_2_number' => '50+',
                    'stat_2_label' => 'Pengmas Terlaksana',
                    'stat_3_number' => '30+',
                    'stat_3_label' => 'HKI & Paten',
                    'stat_4_number' => '22',
                    'stat_4_label' => 'Mitra Kerjasama Riset',
                ],
            ],
            'cdc' => [
                'name' => 'Career Development Center (CDC)',
                'badge' => 'Pusat Karir',
                'color' => '#ea580c',
                'description' => 'Preset untuk Career Development Center & Pusat Karir Alumni.',
                'settings' => [
                    'division_type' => 'unit',
                    'division_name' => 'Career Development Center & Pusat Karir Alumni (CDC)',
                    'division_short_name' => 'CDC STIKES Panti Waluya',
                    'division_acronym' => 'CDC',
                    'division_tagline' => 'Jembatan Emas Menuju Karir Tenaga Kesehatan Profesional & Global',
                    'theme_primary_color' => '#ea580c', // Orange 600
                    'theme_secondary_color' => '#c2410c',
                    'hero_banner_title' => 'Pusat Bimbingan Karir & Bursa Kerja Tenaga Kesehatan',
                    'hero_banner_subtitle' => 'Menghubungkan lulusan dengan ratusan rumah sakit mitra, klinik, industri farmasi, dan peluang karir internasional.',
                    'about_title' => 'Tentang Career Development Center (CDC)',
                    'about_description' => 'CDC STIKES Panti Waluya berfokus pada kesiapan kerja lulusan, pembekalan sertifikasi kompetensi, job fair kampus, tracer study alumni, dan bimbingan karir keperawatan, farmasi, serta manajemen rekam medis.',
                    'vision' => 'Menjadi pusat pengembangan karir dan penelusuran alumni yang unggul dan terpercaya dalam menyalurkan tenaga kesehatan berkarakter kasih.',
                    'mission' => "1. Menyelenggarakan pelatihan kesiapan kerja, interview, dan sertifikasi profesi kesehatan.\n2. Mengadakan Campus Hiring dan Job Fair bersama Rumah Sakit mitra.\n3. Melaksanakan Tracer Study berkala untuk mengukur relevansi kurikulum dan serapan kerja lulusan.\n4. Memperluas peluang penempatan kerja di luar negeri (Jepang, Jerman, Timur Tengah).",
                    'contact_email' => 'cdc@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 106',
                    'contact_room' => 'Gedung Student Center Lt. 1',
                    'stat_1_number' => '96%',
                    'stat_1_label' => 'Terserap Kerja < 3 Bulan',
                    'stat_2_number' => '45+',
                    'stat_2_label' => 'RS & Faskes Mitra',
                    'stat_3_number' => '1.200+',
                    'stat_3_label' => 'Alumni Terhubung',
                    'stat_4_number' => '25+',
                    'stat_4_label' => 'Alumni Berkarir Luar Negeri',
                ],
            ],
            'belmawa' => [
                'name' => 'Belmawa / Kemahasiswaan',
                'badge' => 'Kemahasiswaan',
                'color' => '#1d4ed8',
                'description' => 'Preset untuk Biro Pembelajaran & Kemahasiswaan (Belmawa).',
                'settings' => [
                    'division_type' => 'biro',
                    'division_name' => 'Biro Pembelajaran & Kemahasiswaan (Belmawa)',
                    'division_short_name' => 'Belmawa STIKES Panti Waluya',
                    'division_acronym' => 'BELMAWA',
                    'division_tagline' => 'Wadah Pengembangan Prestasi, Karakter Kasih, dan Kreativitas Mahasiswa',
                    'theme_primary_color' => '#1d4ed8', // Blue 700
                    'theme_secondary_color' => '#1e40af',
                    'hero_banner_title' => 'Membina Mahasiswa Berprestasi & Berintegritas',
                    'hero_banner_subtitle' => 'Mendukung organisasi kemahasiswaan (BEM/DPM/HIMA/UKM), beasiswa, kompetisi nasional (PKM/NUDC/ONMIPA), dan konseling mahasiswa.',
                    'about_title' => 'Tentang Biro Belmawa & Kemahasiswaan',
                    'about_description' => 'Belmawa bertanggung jawab memfasilitasi pembinaan penalaran, minat, bakat, organisasi kemahasiswaan, beasiswa pemerintah & yayasan, serta layanan bimbingan konseling mahasiswa.',
                    'vision' => 'Mewujudkan insan mahasiswa kesehatan yang cerdas, berprestasi, berjiwa kepemimpinan, dan berkarakter kasih.',
                    'mission' => "1. Meningkatkan pembinaan minat, bakat, dan prestasi mahasiswa tingkat nasional.\n2. Mengoptimalkan penyaluran beasiswa KIP-Kuliah, beasiswa prestasi, dan yayasan.\n3. Memfasilitasi tata kelola ormawa dan UKM yang kreatif dan akuntabel.\n4. Memberikan layanan konseling dan kesehatan mental bagi mahasiswa.",
                    'contact_email' => 'kemahasiswaan@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 102',
                    'contact_room' => 'Gedung Student Center Lt. 1',
                    'stat_1_number' => '850+',
                    'stat_1_label' => 'Mahasiswa Aktif',
                    'stat_2_number' => '35+',
                    'stat_2_label' => 'Prestasi Nasional',
                    'stat_3_number' => '12',
                    'stat_3_label' => 'Organisasi & UKM',
                    'stat_4_number' => '9',
                    'stat_4_label' => 'Program Beasiswa',
                ],
            ],
            'keperawatan_ners' => [
                'name' => 'PRODI S1 Keperawatan & Profesi Ners',
                'badge' => 'Program Studi',
                'color' => '#ca8a04',
                'description' => 'Preset untuk Program Studi S1 Keperawatan dan Pendidikan Profesi Ners (1 Web Terpadu).',
                'settings' => [
                    'division_type' => 'prodi',
                    'division_name' => 'Program Studi S1 Keperawatan & Pendidikan Profesi Ners',
                    'division_short_name' => 'Prodi Keperawatan & Ners Panti Waluya',
                    'division_acronym' => 'KEP-NERS',
                    'division_tagline' => 'Mencetak Perawat Profesional Beretika, Unggul dalam Asuhan Geriatri & Gawat Darurat',
                    'theme_primary_color' => '#ca8a04', // Golden Yellow
                    'theme_secondary_color' => '#a16207',
                    'hero_banner_title' => 'Pendidikan Sarjana Keperawatan & Profesi Ners Terpadu',
                    'hero_banner_subtitle' => 'Pendidikan terintegrasi tahap akademik (S1) dan profesi (Ners) dengan laboratorium OSCE/RS simulasi modern.',
                    'about_title' => 'Profil Program Studi S1 Keperawatan & Profesi Ners',
                    'about_description' => 'Prodi S1 Keperawatan & Profesi Ners STIKES Panti Waluya menyelenggarakan pendidikan berkesinambungan untuk mencetak perawat berdaya saing global, menguasai asuhan keperawatan paliatif, geriatri, dan emergency.',
                    'vision' => 'Menjadi Program Studi S1 Keperawatan dan Profesi Ners terkemuka berkeunggulan keperawatan geriatri dan gawat darurat berkarakter kasih pada tahun 2030.',
                    'mission' => "1. Menyelenggarakan pendidikan S1 Keperawatan dan Profesi Ners berkualitas berbasis Outcome-Based Education (OBE).\n2. Melaksanakan riset klinis dan komunitas yang aplikatif serta terpublikasi bereputasi.\n3. Melaksanakan pengabdian asuhan keperawatan komunitas berkarakter kasih.\n4. Menjalin kerjasama rotasi klinik di Rumah Sakit Tipe A/B dan fasilitas kesehatan internasional.",
                    'prodi_degree' => 'Sarjana Keperawatan (S.Kep) & Ners (Ns.)',
                    'prodi_accreditation' => 'Terakreditasi Baik Sekali (LAM-PTKes)',
                    'prodi_graduate_profile' => 'Care Provider (Perawat Klinis RS & Komunitas), Communicator, Manager/Leader Keperawatan, Researcher Pemula, dan Educator Kesehatan',
                    'contact_email' => 'keperawatan@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 201',
                    'contact_room' => 'Gedung Laboratorium Terpadu Lt. 3',
                    'stat_1_number' => '99%',
                    'stat_1_label' => 'Kelulusan Uji Kompetensi Ners',
                    'stat_2_number' => '15',
                    'stat_2_label' => 'RS Mitra Praktik Klinik',
                    'stat_3_number' => '28',
                    'stat_3_label' => 'Dosen Spesialis & Ners',
                    'stat_4_number' => '8',
                    'stat_4_label' => 'Laboratorium Simulasi RS',
                ],
            ],
            'farmasi' => [
                'name' => 'Prodi S1 Farmasi',
                'badge' => 'Program Studi',
                'color' => '#7c2d12',
                'description' => 'Preset untuk Program Studi S1 Farmasi.',
                'settings' => [
                    'division_type' => 'prodi',
                    'division_name' => 'Program Studi S1 Farmasi',
                    'division_short_name' => 'Prodi S1 Farmasi Panti Waluya',
                    'division_acronym' => 'FARMASI',
                    'division_tagline' => 'Unggul dalam Riset Farmasi Bahan Alam, Formulasi Herbal, dan Farmasi Klinis-Komunitas',
                    'theme_primary_color' => '#7c2d12', // Warm Orange/Brown
                    'theme_secondary_color' => '#9a3412',
                    'hero_banner_title' => 'Pusat Keunggulan Farmasi Bahan Alam & Klinis',
                    'hero_banner_subtitle' => 'Mendidik sarjana farmasi yang kompeten dalam kimia farmasi, teknologi sediaan obat/kosmetik, dan pelayanan kefarmasian di apotek/RS.',
                    'about_title' => 'Profil Program Studi S1 Farmasi',
                    'about_description' => 'Prodi S1 Farmasi STIKES Panti Waluya memadukan sains modern dengan kekayaan herbal Indonesia untuk menghasilkan inovator farmasi yang kompeten dan berkarakter kasih.',
                    'vision' => 'Menjadi Program Studi S1 Farmasi terkemuka yang unggul dalam farmasi bahan alam dan pelayanan farmasi komunitas berkarakter kasih pada tahun 2030.',
                    'mission' => "1. Menyelenggarakan pendidikan sarjana farmasi berbasis Outcome-Based Education (OBE).\n2. Mengembangkan penelitian formulasi herbal, standarisasi ekstrak, dan uji farmakologi klinis.\n3. Melaksanakan pengabdian masyarakat berupa edukasi DAGUSIBU dan pelayanan kefarmasian promotif.\n4. Membina kemitraan dengan industri farmasi, apotek jaringan, dan BPOM.",
                    'prodi_degree' => 'Sarjana Farmasi (S.Farm)',
                    'prodi_accreditation' => 'Terakreditasi Baik Sekali (LAM-PTKes)',
                    'prodi_graduate_profile' => 'Farmasis Klinis & Komunitas, Formulator Industri Farmasi & Kosmetik, Pengelola Apotek, Quality Control/Assurance, dan Peneliti Herbal',
                    'contact_email' => 'farmasi@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 205',
                    'contact_room' => 'Gedung Laboratorium Farmasi Lt. 2',
                    'stat_1_number' => '100%',
                    'stat_1_label' => 'Akreditasi Baik Sekali',
                    'stat_2_number' => '8',
                    'stat_2_label' => 'Lab Kimia & Formulasi',
                    'stat_3_number' => '20',
                    'stat_3_label' => 'Industri & RS Mitra',
                    'stat_4_number' => '40+',
                    'stat_4_label' => 'Produk Inovasi Herbal',
                ],
            ],
            'mik' => [
                'name' => 'Prodi D4 Manajemen Informasi Kesehatan',
                'badge' => 'Program Studi',
                'color' => '#4338ca',
                'description' => 'Preset untuk Program Studi Sarjana Terapan Manajemen Informasi Kesehatan (D4 MIK).',
                'settings' => [
                    'division_type' => 'prodi',
                    'division_name' => 'Program Studi Sarjana Terapan Manajemen Informasi Kesehatan (D4 MIK)',
                    'division_short_name' => 'Prodi D4 MIK Panti Waluya',
                    'division_acronym' => 'D4-MIK',
                    'division_tagline' => 'Pelopor Transformasi Rekam Medis Elektronik (RME) & Analitika Data Kesehatan Digital',
                    'theme_primary_color' => '#4338ca', // Indigo 700
                    'theme_secondary_color' => '#3730a3',
                    'hero_banner_title' => 'Pusat Unggulan Rekam Medis Digital & Health Informatics',
                    'hero_banner_subtitle' => 'Mencetak Sarjana Terapan MIK yang ahli dalam koding klinis (ICD-10/ICD-9-CM), SIMRS, audit rekam medis, dan keamanan data kesehatan.',
                    'about_title' => 'Profil Program Studi D4 Manajemen Informasi Kesehatan',
                    'about_description' => 'Prodi D4 MIK STIKES Panti Waluya menghasilkan profesional rekam medis dan informasi kesehatan yang siap memimpin digitalisasi fasilitas pelayanan kesehatan di era SATUSEHAT Kemenkes.',
                    'vision' => 'Menjadi Program Studi Sarjana Terapan Manajemen Informasi Kesehatan yang unggul dalam sistem informasi kesehatan digital dan koding klinis berkarakter kasih pada tahun 2030.',
                    'mission' => "1. Menyelenggarakan pendidikan Sarjana Terapan MIK berstandar kurikulum digital health terkini.\n2. Mengembangkan penelitian terapan di bidang Rekam Medis Elektronik (RME), casemix, dan analitika data kesehatan.\n3. Melaksanakan pengabdian masyarakat berupa literasi informasi kesehatan digital di faskes primer.\n4. Menjalin kemitraan dengan RS, Dinas Kesehatan, BPJS Kesehatan, dan vendor SIMRS nasional.",
                    'prodi_degree' => 'Sarjana Terapan Manajemen Informasi Kesehatan (S.Tr.Kes)',
                    'prodi_accreditation' => 'Terakreditasi Baik Sekali (LAM-PTKes)',
                    'prodi_graduate_profile' => 'Manajer Rekam Medis & RME Rumah Sakit, Clinical Coder & Casemix Specialist BPJS, Health Data Analyst, dan Konsultan SIMRS',
                    'contact_email' => 'mik@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 208',
                    'contact_room' => 'Gedung Laboratorium Komputer Terpadu Lt. 2',
                    'stat_1_number' => '98%',
                    'stat_1_label' => 'Kelulusan UKOM MIK',
                    'stat_2_number' => '100%',
                    'stat_2_label' => 'Kebutuhan Kerja RME Tinggi',
                    'stat_3_number' => '16',
                    'stat_3_label' => 'RS Praktik RME & Casemix',
                    'stat_4_number' => '4',
                    'stat_4_label' => 'Lab SIMRS & Koding Medis',
                ],
            ],
            'rpl' => [
                'name' => 'Rekognisi Pembelajaran Lampau (RPL)',
                'badge' => 'Pusat Layanan',
                'color' => '#b91c1c',
                'description' => 'Preset untuk Pusat Layanan Rekognisi Pembelajaran Lampau (RPL Tipe A).',
                'settings' => [
                    'division_type' => 'unit',
                    'division_name' => 'Pusat Layanan Rekognisi Pembelajaran Lampau (RPL)',
                    'division_short_name' => 'Pusat RPL STIKES Panti Waluya',
                    'division_acronym' => 'RPL',
                    'division_tagline' => 'Konversi Pengalaman Kerja & Pendidikan Non-Formal Menjadi SKS Gelar Sarjana Kesehatan',
                    'theme_primary_color' => '#b91c1c', // Red 700
                    'theme_secondary_color' => '#991b1b',
                    'hero_banner_title' => 'Kuliah Cepat Jalur Pengalaman Kerja (RPL Tipe A)',
                    'hero_banner_subtitle' => 'Pengakuan capaian pembelajaran dari pengalaman kerja praktisi perawat, tenaga farmasi, dan perekam medis untuk melanjutkan ke jenjang S1/D4.',
                    'about_title' => 'Tentang Layanan Rekognisi Pembelajaran Lampau (RPL)',
                    'about_description' => 'Pusat RPL STIKES Panti Waluya memfasilitasi tenaga kesehatan yang telah bekerja untuk memperoleh pengakuan SKS akademik melalui asesmen portofolio dan asesmen mandiri sesuai regulasi Kemendikbudristek & Kemenkes.',
                    'vision' => 'Menjadi unit penyelenggara RPL yang akuntabel, transparan, dan inklusif dalam memperluas akses pendidikan tinggi tenaga kesehatan.',
                    'mission' => "1. Melaksanakan asesmen dan rekognisi capaian pembelajaran secara objektif dan terstandar.\n2. Memberikan layanan konsultasi dan pendampingan penyusunan portofolio RPL bagi calon mahasiswa.\n3. Mempercepat masa studi tenaga kesehatan aktif tanpa mengorbankan kualitas kompetensi lulusan.\n4. Menjalin kemitraan dengan organisasi profesi (PPNI, IAI, PORMIKI) dan institusi faskes.",
                    'contact_email' => 'rpl@pantiwaluya.ac.id',
                    'contact_phone' => '(0341) 569275 ext. 110',
                    'contact_room' => 'Gedung Rektorat Lt. 1 (Front Office RPL)',
                    'stat_1_number' => 'Hingga 50%',
                    'stat_1_label' => 'Pengakuan Beban SKS',
                    'stat_2_number' => '2 - 3 Smt',
                    'stat_2_label' => 'Masa Tempuh Studi',
                    'stat_3_number' => '100%',
                    'stat_3_label' => 'Resmi Kemendikbudristek',
                    'stat_4_number' => '15',
                    'stat_4_label' => 'Asesor RPL Tersertifikasi',
                ],
            ],
        ];
    }
}
