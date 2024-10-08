<?php

namespace Modules\Common\Database\Seeders;

use Modules\Core\Models\User;
use Illuminate\Database\Seeder;
use Modules\Common\Models\Page;
use Illuminate\Support\Facades\File;
use Modules\Common\Models\AppSetting;
use Modules\Common\Contracts\Cacheable;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert(self::data());
    }

    /**
     * Generate seo datas
     * @return array
     */
    public function data()
    {
        $creator = User::first();
        return [
            [
                'title' => 'Metode Pembayaran',
                'slug' => 'metode-pembayaran',
                'short_description' => 'Kami adalah SOC Media Group, menjalankan bisnis sebagai SOCMedia Academy, sebuah perusahaan yang terdaftar di Kab. Karanganyar Indonesia.',
                'description' => null,
                'is_active' => 1,
                // 'created_by' => $creator->id,
                // 'updated_by' => $creator->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'short_description' => 'Kami adalah SOC Media Group, menjalankan bisnis sebagai SOCMedia Academy, sebuah perusahaan yang terdaftar di Kab. Karanganyar Indonesia.',
                'description' => self::privacyPolicy(),
                'is_active' => 1,
                // 'created_by' => $creator->id,
                // 'updated_by' => $creator->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'title' => 'Syarat & Ketentuan',
                'slug' => 'syarat-ketentuan',
                'short_description' => 'Kami adalah SOC Media Group, menjalankan bisnis sebagai SOCMedia Academy, sebuah perusahaan yang terdaftar di Kab. Karanganyar Indonesia.',
                'description' => self::termsAndConditions(),
                'is_active' => 1,
                // 'created_by' => $creator->id,
                // 'updated_by' => $creator->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }

    /**
     * Terms of conditions page
     * @return html
     */
    public function termsAndConditions()
    {
        return File::get(base_path('Modules/Common/Database/Seeders/markdown/terms-conditions.md'));
    }

    /**
     * Terms of conditions page
     * @return html
     */
    public function privacyPolicy()
    {
        return File::get(base_path('Modules/Common/Database/Seeders/markdown/privacy-policy.md'));
    }
}
