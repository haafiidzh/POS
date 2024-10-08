<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Modules\Common\Contracts\Cacheable;
use Modules\Common\Models\AppSetting;
use Modules\Common\Models\Content;

class ContentTableSeeder extends Seeder
{
    use Cacheable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array_merge(
            self::homepage(),
            self::course(),
            self::verifyCertificate(),
            self::coupon(),
            self::blog(),
            self::faq(),
            self::contactUs(),
            self::cart(),
            self::checkout(),
        );

        // Cache::flush();
        foreach ($settings as $setting) {
            $this->updateCache($setting['key'], $setting['value']);
        }

        Content::insert($settings);
    }

    /**
     * Handle default content -> homepage
     * @return array
     */
    public static function homepage(): array
    {
        return [
            // Welcome Banner
            [
                'slug_group' => 'homepage',
                'label' => 'Banner - Greetiig',
                'key' => 'homepage.banner.greeting',
                'value' => 'Selamat Datang di ' . cache('app_name'),
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Banner - Slogan',
                'key' => 'homepage.banner.slogan',
                'value' => 'New Moves, New Chances',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Banner - Deskripsi',
                'key' => 'homepage.banner.description',
                'value' => "Kembangkan karirmu di dunia digital bersama mentor yang tepat!",
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Banner - Gambar',
                'key' => 'homepage.banner.image',
                'value' => 'https://placehold.co/600x600/png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            // About
            [
                'slug_group' => 'homepage',
                'label' => 'Tentang Kami - Judul',
                'key' => 'homepage.about.title',
                'value' => env('APP_NAME'),
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Tentang Kami - Deskripsi',
                'key' => 'homepage.about.description',
                'value' => "Jembatan bagi para fresh graduates, profesional, dan pekerja yang ingin berkarir di dunia digital. Di bawah naungan SOC Media Group dengan filosofi 'Mergi Milining Berkah', kami berkomitmen untuk mengalirkan keberkahan ilmu melalui platform kami. Kami memahami bahwa setiap gerakan baru membawa peluang baru. Kami siap membimbing Anda melewati perubahan karir dengan percaya diri. Bergabunglah dengan SOC Media Academy dan mari bersama-sama kita mencari peluang baru di dunia digital!",
                'type' => 'textarea',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Tentang Kami - Gambar 1',
                'key' => 'homepage.about.image_1',
                'value' => 'https://placehold.co/400x600/png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Tentang Kami - Gambar 2',
                'key' => 'homepage.about.image_2',
                'value' => 'https://placehold.co/400x600/png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            // Why Us
            [
                'slug_group' => 'homepage',
                'label' => 'Mengapa Kami - Judul',
                'key' => 'homepage.why.title',
                'value' => 'Mengapa SOC Media Academy?',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Mengapa Kami - Deskripsi',
                'key' => 'homepage.why.description',
                'value' => "Kami hadirkan pengalaman belajar yang mengasyikkan, dengan fokus pada kualitas, fleksibilitas, dan
                    pemberdayaan pribadi. Kami di SOC Media Academy memahami keinginanmu untuk berkembang dalam era
                    digital. Kami menempatkan pengembangan dirimu sebagai prioritas utama.",
                'type' => 'textarea',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            // Kelas Terlaris
            [
                'slug_group' => 'homepage',
                'label' => 'Kelas Terlaris - Judul',
                'key' => 'homepage.course_popular.title',
                'value' => 'Kelas Terlaris',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Kelas Terlaris - Deskripsi',
                'key' => 'homepage.course_popular.description',
                'value' => "Pilihan Utama untuk Perkembanganmu!",
                'type' => 'editor',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],

            // Kelas Terbaru
            [
                'slug_group' => 'homepage',
                'label' => 'Kelas Terbaru - Judul',
                'key' => 'homepage.course_newest.title',
                'value' => 'Kelas Terbaru',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'Kelas Terbaru - Deskripsi',
                'key' => 'homepage.course_newest.description',
                'value' => "Upgrade keterampilanmu dengan kelas terbaru!",
                'type' => 'editor',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],

            // FAQ
            [
                'slug_group' => 'homepage',
                'label' => 'FAQ - Judul Kecil',
                'key' => 'homepage.faq.small_title',
                'value' => 'FAQ',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'FAQ - Judul',
                'key' => 'homepage.faq.title',
                'value' => 'Frequently Asked Questions',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'homepage',
                'label' => 'FAQ - Deskripsi',
                'key' => 'homepage.faq.description',
                'value' => "Temukan jawaban atas pertanyaan umum kamu dalam FAQ kami, membantu kamu memahami layanan kami dengan lebih baik.",
                'type' => 'editor',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> course
     * @return array
     */
    public static function course(): array
    {
        return [
            [
                'slug_group' => 'course',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.course.title',
                'value' => 'Kelas',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'course',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.course.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> verify certificate
     * @return array
     */
    public static function verifyCertificate(): array
    {
        return [
            [
                'slug_group' => 'verify_certificate',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.verify_certificate.title',
                'value' => 'Verifikasi Sertifikat',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'verify_certificate',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.verify_certificate.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'verify_certificate',
                'label' => 'Halaman - Heading',
                'key' => 'verify_certificate.title',
                'value' => 'Verifikasi Sertifikat by SOC Media Academy',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'verify_certificate',
                'label' => 'Halaman - Deskripsi',
                'key' => 'verify_certificate.description',
                'value' => 'Pastikan originalitas sertifikat e-course kamu dengan tools verifikasi kami yang cepat, akurat, dan mudah digunakan!',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> coupon
     * @return array
     */
    public static function coupon(): array
    {
        return [
            [
                'slug_group' => 'coupon',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.coupon.title',
                'value' => 'Kupon',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'coupon',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.coupon.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'coupon',
                'label' => 'Halaman - Heading',
                'key' => 'coupon.title',
                'value' => 'Mau cari kupon apa?',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'coupon',
                'label' => 'Halaman - Deskripsi',
                'key' => 'coupon.description',
                'value' => 'Dapetin kupon diskon eksklusif buat belanja kelas yang kamu inginkan. Nikmatin penawaran terbaik!',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> blog
     * @return array
     */
    public static function blog(): array
    {
        return [
            [
                'slug_group' => 'blog',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.blog.title',
                'value' => 'Blog',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'blog',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.blog.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> faq
     * @return array
     */
    public static function faq(): array
    {
        return [
            [
                'slug_group' => 'faq',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.faq.title',
                'value' => 'Frequently Ask Questions',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'faq',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.faq.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'faq',
                'label' => 'Halaman - Heading',
                'key' => 'faq.title',
                'value' => 'Ada Pertanyaan? Cari disini',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'faq',
                'label' => 'Halaman - Deskripsi',
                'key' => 'faq.description',
                'value' => 'Temukan jawaban atas pertanyaan umum kamu dalam FAQ kami, membantu kamu memahami layanan kami dengan lebih baik.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> contact us
     * @return array
     */
    public static function contactUs(): array
    {
        return [
            [
                'slug_group' => 'hubungi_kami',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.contact_us.title',
                'value' => 'Hubungi Kami',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'hubungi_kami',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.contact_us.description',
                'value' => 'Jangan ragu untuk menghubungi kami di sini.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'hubungi_kami',
                'label' => 'Halaman - Heading',
                'key' => 'contact_us.title',
                'value' => 'Punya Pertanyaan?',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'hubungi_kami',
                'label' => 'Halaman - Deskripsi',
                'key' => 'contact_us.description',
                'value' => 'Silahkan isi formulir berikut dan kami akan segera menghubungi kamu kembali.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> cart
     * @return array
     */
    public static function cart(): array
    {
        return [
            [
                'slug_group' => 'cart',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.cart.title',
                'value' => 'Keranjang Belanja',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'cart',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.cart.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default content -> checkout
     * @return array
     */
    public static function checkout(): array
    {
        return [
            [
                'slug_group' => 'checkout',
                'label' => 'Breadcrumb - Judul',
                'key' => 'breadcrumb.checkout.title',
                'value' => 'Checkout',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'checkout',
                'label' => 'Breadcrumb - Deskripsi',
                'key' => 'breadcrumb.checkout.description',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'checkout',
                'label' => 'Billing - Judul',
                'key' => 'checkout.billing.title',
                'value' => 'Billing Information',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'checkout',
                'label' => 'Billing - Judul',
                'key' => 'checkout.billing.description',
                'value' => 'Masukkan informasi tagihan dengan tepat untuk transaksi kamu. Pastikan data kamu telah sesuai demi pengalaman berbelanja yang nyaman.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'checkout',
                'label' => 'Order - Judul',
                'key' => 'checkout.order.title',
                'value' => 'Order Summary',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'slug_group' => 'checkout',
                'label' => 'Order - Judul',
                'key' => 'checkout.order.description',
                'value' => 'Pastikan produk yang telah kamu pilih dari keranjang belanja atau halaman kelas sebelumnnya telah sesuai, sebelum kamu melakukan pembayaran.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }
}
