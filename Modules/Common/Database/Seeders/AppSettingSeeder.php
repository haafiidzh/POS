<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Modules\Common\Contracts\Cacheable;
use Modules\Common\Models\AppSetting;

class AppSettingSeeder extends Seeder
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
            self::ecommerce(),
            self::website(),
            self::contact(),
            self::social(),
            // self::front(),
        );

        // Cache::flush();
        foreach ($settings as $setting) {
            $this->updateCache($setting['key'], $setting['value']);
        }

        AppSetting::insert($settings);
    }

    /**
     * Handle default app settings -> ecommerce
     * @return array
     */
    public static function ecommerce(): array
    {
        return [
            [
                'group' => 'ecommerce',
                'name' => 'Aktifkan Pajak?',
                'key' => 'ecommerce_tax_status',
                'value' => true,
                'type' => 'input:checkbox',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'ecommerce',
                'name' => 'PPN',
                'key' => 'ecommerce_tax_rate',
                'value' => '12%',
                'type' => 'input:number',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'ecommerce',
                'name' => 'Aktifkan Biaya Admin?',
                'key' => 'ecommerce_admin_fee_status',
                'value' => true,
                'type' => 'input:checkbox',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'ecommerce',
                'name' => 'Biaya Admin',
                'key' => 'ecommerce_admin_fee_rate',
                'value' => 2500,
                'type' => 'input:number',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default app settings -> website
     * @return array
     */
    public static function website(): array
    {
        return [
            [
                'group' => 'website_general',
                'name' => 'Nama Website',
                'key' => 'app_name',
                'value' => config('app.name'),
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Copyright',
                'key' => 'copyright',
                'value' => 'Copyright © ' . config('app.name') . ' ' . date('Y') . '. All rights reserved.',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Logo Kecil',
                'key' => 'small_logo',
                'value' => '/assets/default/images/logo.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Logo',
                'key' => 'logo',
                'value' => '/assets/default/images/logo.png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Logo Footer',
                'key' => 'footer_logo',
                'value' => '/assets/default/images/footer_logo.png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Deskripsi Footer',
                'key' => 'footer_description',
                'value' => 'Tingkatkan skill digitalmu di SOC Media Academy! Kami menyediakan video pelatihan berkualitas yang dirancang khusus untuk memenuhi kebutuhanmu  . Bergabunglah sekarang dan jadilah ahli dalam dunia digital!                ',
                'type' => 'textareea',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Favicon',
                'key' => 'favicon',
                'value' => '/assets/default/images/favicon.png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Gambar Thumbnail (16:9)',
                'key' => 'thumbnail',
                'value' => '/assets/default/images/thumbnail_16_9.png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Gambar Thumbnail (1:1)',
                'key' => 'thumbnail_square',
                'value' => '/assets/default/images/thumbnail_square.png',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Gambar 404 (Not Found)',
                'key' => 'not_found_image',
                'value' => '/assets/default/images/data_not_found.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => '404 (Not Found)',
                'key' => 'image_not_found',
                'value' => '/assets/default/images/not_found.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Payment Success',
                'key' => 'image_payment_success',
                'value' => '/assets/default/images/payment_success.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Payment Error',
                'key' => 'image_payment_error',
                'value' => '/assets/default/images/payment_error.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Empty Cart',
                'key' => 'image_empty_cart',
                'value' => '/assets/default/images/empty_cart.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'website_general',
                'name' => 'Need Authentication',
                'key' => 'image_authentication',
                'value' => '/assets/default/images/authentication.svg',
                'type' => 'image',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default app settings -> contact
     * @return array
     */
    public static function contact(): array
    {
        return [
            [
                'group' => 'contact',
                'name' => 'Alamat',
                'key' => 'contact_address',
                'value' => 'Ndalem Asri Residence, Jl. Nila, Tegalrejo, Paulan, Kec. Colomadu, Kabupaten Karanganyar, Jawa Tengah 57177',
                'type' => 'textarea',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'Telepon',
                'key' => 'contact_phone',
                'value' => '081327105454',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'WhatsApp',
                'key' => 'contact_whatsapp',
                'value' => '081327105454',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'Email - Official',
                'key' => 'contact_email',
                'value' => 'official@academy.socmediaagency.com',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'Email - Support',
                'key' => 'contact_support_email',
                'value' => 'support@academy.socmediaagency.com',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'embed_maps',
                'key' => 'contact_embed_maps',
                'value' => '<iframe height="200px" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2705863791434!2d110.7894465147766!3d-7.545442794558176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a15a3c8b8860b%3A0x82b030275ccc4bc0!2sSOCMedia%20Agency%20(Jasa%20Digital%20Marketing%20-%20Creative%20Agency%20Solo)!5e0!3m2!1sen!2sid!4v1686810164244!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'contact',
                'name' => 'maps_link',
                'key' => 'contact_maps_link',
                'value' => 'https://goo.gl/maps/ydvcYi7wj3qYDxnHA',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Handle default app settings -> social
     * @return array
     */
    public static function social(): array
    {
        return [
            [
                'group' => 'social',
                'name' => 'Nama Instagram',
                'key' => 'social_instagram_name',
                'value' => 'socmedia.agency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Nama Facebook',
                'key' => 'social_facebook_name',
                'value' => 'SOCMedia Agency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Nama TikTok',
                'key' => 'social_tiktok_name',
                'value' => 'SOCMedia Agency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Nama LinkedIn',
                'key' => 'social_linkedin_name',
                'value' => 'SOCMedia Group',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Nama YouTube',
                'key' => 'social_youtube_name',
                'value' => 'SOC MEDIA GROUP',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat WhatsApp',
                'key' => 'social_whatsapp_link',
                'value' => null,
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat Instagram',
                'key' => 'social_instagram_link',
                'value' => 'https://www.instagram.com/socmedia.agency/',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat TikTok',
                'key' => 'social_tiktok_link',
                'value' => 'https://www.tiktok.com/@socmediaagency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat LinkedIn',
                'key' => 'social_linkedin_link',
                'value' => 'https://www.linkedin.com/company/soc-media-agency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat Facebook',
                'key' => 'social_facebook_link',
                'value' => 'https://www.facebook.com/socmedia.agency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'group' => 'social',
                'name' => 'Alamat Youtube',
                'key' => 'social_youtube_link',
                'value' => 'https://www.youtube.com/@socmediaagency',
                'type' => 'input',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }
}
