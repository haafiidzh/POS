<?php

namespace Modules\Common\Database\Seeders;

use Modules\Common\Models\Faq;
use Illuminate\Database\Seeder;
use Modules\Common\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Html;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // Faq::factory()->count(100)->create();
        Faq::insert(self::data());
    }


    /**
     * All faq data
     * @return array
     */
    public function data()
    {
        $category = Category::where('group', 'faqs')->where('name', 'Umum')->first('id');
        return [
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Apa itu SOC Media Academy?',
                'slug' => slug('Apa itu SOC Media Academy?'),
                'answer' => 'SOC Media Academy adalah platform pelatihan daring yang menawarkan berbagai kursus untuk mengembangkan keterampilan Anda di bidang media sosial dan pemasaran digital. Kami menyediakan materi yang mudah diikuti dan praktis untuk diaplikasikan langsung.',
                'sort_order' => 1,
                'is_featured' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Siapa saja yang bisa mengikuti kursus di SOC Media Academy?',
                'slug' => slug('Siapa saja yang bisa mengikuti kursus di SOC Media Academy?'),
                'answer' => 'Kursus kami dirancang untuk semua tingkat kemampuan, mulai dari pemula hingga profesional yang ingin meningkatkan keterampilan mereka. Baik Anda seorang pelajar, pengusaha, atau pekerja profesional, kami memiliki kursus yang sesuai untuk Anda.',
                'sort_order' => 2,
                'is_featured' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Bagaimana cara mendaftar kursus di SOC Media Academy?',
                'slug' => slug('Bagaimana cara mendaftar kursus di SOC Media Academy?'),
                'answer' => 'Untuk mendaftar, kunjungi halaman kursus kami, pilih kursus yang Anda minati, dan klik tombol \'Daftar Sekarang\'. Ikuti instruksi untuk menyelesaikan pendaftaran dan pembayaran.',
                'sort_order' => 3,
                'is_featured' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Apakah saya mendapatkan sertifikat setelah menyelesaikan kursus?',
                'slug' => slug('Apakah saya mendapatkan sertifikat setelah menyelesaikan kursus?'),
                'answer' => 'Ya, setelah menyelesaikan kursus dan lulus ujian akhir, Anda akan menerima sertifikat yang dapat diunduh dan dibagikan pada profil platform lain atau CV Anda.',
                'sort_order' => 4,
                'is_featured' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Apakah materi kursus bisa diakses selamanya?',
                'slug' => slug('Apakah materi kursus bisa diakses selamanya?'),
                'answer' => 'Setelah mendaftar, Anda memiliki akses seumur hidup ke materi kursus, termasuk semua pembaruan yang akan datang.',
                'sort_order' => 5,
                'is_featured' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Bagaimana Cara Mengecek Keaslian Sertifikat Saya?',
                'slug' => slug('Bagaimana Cara Mengecek Keaslian Sertifikat Saya?'),
                'answer' => '- Kunjungi halaman Cek Sertifikat.
                - Masukkan kode sertifikat Anda pada kolom yang disediakan.
                - Klik tombol "Cek Sertifikat".
                - Tunggu beberapa saat hingga proses verifikasi selesai.
                Anda akan diberitahu apakah sertifikat Anda valid atau tidak.',
                'sort_order' => 6,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Bagaimana Cara Mendapatkan dan Menggunakan Kupon Diskon?',
                'slug' => slug('Bagaimana Cara Mendapatkan dan Menggunakan Kupon Diskon?'),
                'answer' => '- Kunjungi halaman Kupon.
                - Cari kupon yang tersedia dan salin kode kupon tersebut.
                - Saat melakukan checkout, masukkan kode kupon pada kolom yang tersedia untuk mendapatkan diskon.
                - Pastikan kupon masih berlaku dan memenuhi syarat dan ketentuan yang berlaku.',
                'sort_order' => 7,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Metode Pembayaran Apa Saja yang Diterima?',
                'slug' => slug('Metode Pembayaran Apa Saja yang Diterima?'),
                'answer' => '- Transfer Bank: Anda bisa melakukan pembayaran melalui transfer bank ke rekening yang akan diinformasikan pada saat checkout.
                - Virtual Account: Pembayaran melalui virtual account dari berbagai bank juga tersedia untuk kenyamanan Anda.
                - E-Wallet: Kami juga menerima pembayaran melalui e-wallet populer seperti OVO, GoPay, dan Dana.',
                'sort_order' => 8,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Bagaimana Saya Bisa Menghubungi Tim Support SOC Media Academy?',
                'slug' => slug('Bagaimana Saya Bisa Menghubungi Tim Support SOC Media Academy?'),
                'answer' => 'Anda dapat mengakses halaman berikut <a href="https://academy.socmediaagency.com/hubungi-kami">Hubungi Kami</a> untuk mendapatkan informasi lainnya dari Tim Support Kami.',
                'sort_order' => 9,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Bagaimana Cara Melihat Riwayat Pembelian Saya?',
                'slug' => slug('Bagaimana Cara Melihat Riwayat Pembelian Saya?'),
                'answer' => '- Login ke akun SOC Media Academy Anda.
                - Buka menu "Akun Saya" dan pilih "Riwayat Pembelian".
                - Di halaman ini, Anda dapat melihat semua transaksi yang telah Anda lakukan beserta detailnya.',
                'sort_order' => 10,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Faq::generateId(),
                'category_id' => $category->id,
                'question' => 'Apakah Ada Kebijakan Pengembalian Dana?',
                'slug' => slug('Apakah Ada Kebijakan Pengembalian Dana?'),
                'answer' => 'Kami tidak melayani pengembalian dana apapun. Untuk detail lengkap Anda dapat mengunjungi halaman <a href="https://academy.socmediaagency.com/syarat-ketentuan">Syarat & Ketentuan</a>.',
                'sort_order' => 11,
                'is_featured' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }
}
