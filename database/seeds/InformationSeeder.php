<?php

use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Information::create([
            'title' => 'Syarat Donor Darah',
            'image' => 'php3C25.tmp.jpg',
            'kategori' => 'informasi',
            'content' => '1. Usia 17-60 tahun (usia 17 tahun diperbolehkan menjadi donor bila mendapat izin tertulis dari orang tua)\r\n\r\n2. Berat badan minimal 45 kg Temperatur tubuh 36,6 &ndash; 37,5 derajat Celcius\r\n\r\n3. Tekanan darah baik yaitu sistole = 110-160 mmHg, diastole = 70-100 mmHg\r\n\r\n4. Denyut nadi teratur yaitu sekitar 50-100 kali/menit>\r\n\r\n5. Hemoglobin perempuan minimal 12 gram, sedangkan untuk laki-laki minimal 12,5 gram\r\n\r\n6. Jumlah penyumbangan per tahun paling banyak 5 kali dengan jarak penyumbangan sekurang-kurangnya 3 bulan\r\n\r\n7. Calon donor dapat mengambil dan menandatangani formulir pendaftaran, lalu menjalani pemeriksaan pendahuluan, seperti kondisi berat badan, HB, golongan darah, dan dilanjutkan dengan pemeriksaan dokter.'
        ]);

        Information::create([
            'title' => 'Manfaat Donor Darah',
            'image' => 'phpB49A.tmp.jpg',
            'kategori' => 'informasi',
            'content' => '1. Mengurangi penyakit jantung \r\n\r\nSalah satu manfaat kesehatan dari mendonorkan darah secara teratur adalah membuat jantung Anda senantiasa sehat. \r\n\r\nDengan melakukan donor darah, otomatis sirkulas darah Anda akan mejadi lebih baik, jantung akan terlatih untuk terus memompa darah sehingga dapat meningkatkan zat besi dalam darah dan menjadikan tubuh lebih sehat serta mengurangi Anda menderita penyakit jantung\r\n\r\n2. Membakar kalori\r\n\r\nMendonorkan darah secara teratur akan membantu Anda membakar kalori dalam tubuh, tidak percaya? Bayangkan saja, ketika darah yang Anda donorkan sebanyak 450 ml, maka Anda pun kehilangan sekitar 650 kalori\r\n\r\n3. Menurunkan risiko kanker\r\n\r\nSelain membantu membakar kalori, mendonorkan darah pun dapat menurnkan risiko terjadinya kanker. Termasuk kanker hati, paru-paru, usus besar, perut, dan kanker tenggorokan\r\n\r\n4. Meningkatkan produksi darah\r\n\r\nManfaat mendonorkandarah secara teratur dapat membantu merangsang produksi sel-sel darah baru. Proses mendonorkan darah ini, akan membantu tubuh tetap sehat dan bekerja lebih efisien.'
        ]);

        Information::create([
            'title' => 'Kenapa Harus Donor?',
            'image' => 'php165.tmp.jpg',
            'kategori' => 'berita',
            'content' => 'Palang Merah Indonesia (PMI) adalah sebuah organisasi perhimpunan nasional yang membantu pemerintah di bidang sosial kemanusiaan. \r\n\r\nPMI didirikan pada 17 Septemper 1945 dan Moh. Hatta sebgai ketuanya. Tugas pokok PMI antara lain adalah kesiapsiagaan bantuan dan penanggulangan bencana, pelatihan pertolongan pertama untuk sukarelawan, pelayanan kesehatan dan kesejahteraan masyarakat, dan pelayanan transfusi darah. \r\nSeperti yang diketahui, ada 4 golongan darah utama yaitu A, B, AB, dan 0. Secara umum, rata-rata populasi terbanyak adalah golongan darah 0, disusul A, B, lalu AB. Setiap golongan terbagi atas darah be-Rhesus positif atau negatif. \r\n\r\nDi Indonesia sendiri, stok darah dari sukarelawan belum mencukupi akan kebutuhan transfusi darah. Menurut WHO secara ideal ketersediaan darah untuk donor minimal 2% dari jumlah penduduk. Sehingga jika jumlah penduduk Indonesia adalah 247,8 juta jiwa, maka idealnya dibutuhkan darah sebanyak 4,9 juta kantong darah. Jumlah ideal yang dibutuhkan adalah 2,5% dari jumlah penduduk atau sekitar 670 UTD.\r\nTidak kalah penting, ada begitu banyak manfaat bagi pendonor antara lain melindungi jantung, menurunkan resiko terkena kanker, menurunkan level zat besi dalam darah, pembaharuan sel darah secara rutin, mencegah penuaan dini, dan masih banyak lagi. \r\nTerakhir, tahukah anda? Satu kantung darah bisa menyumbang tiga kehidupan.'
        ]);
    }
}
