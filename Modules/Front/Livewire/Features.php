<?php

namespace Modules\Front\Livewire;

use Livewire\Component;

class Features extends Component
{
    /**
     * Define all features
     *
     * @return array
     */
    public function allFeatures()
    {
        return [
            [
                'icon' => 'bxs-medal',
                'title' => 'Berkualitas',
                'description' => 'Materi pembelajaran yang disusun oleh mentor berpengalaman di bidangnya.'
            ],
            [
                'icon' => 'bxs-hourglass-bottom',
                'title' => 'Fleksibilitas',
                'description' => 'Akses kursus kapan saja, di mana saja, sesuai dengan jadwalmu.'
            ],
            [
                'icon' => 'bxs-badge-dollar',
                'title' => 'Free Pembaruan Materi',
                'description' => 'Dapatkan pembaruan materi kursus secara gratis, dapatkan informasi terkini dan relevan.'
            ],
            [
                'icon' => 'bxs-graduation',
                'title' => 'Sertifikat',
                'description' => 'Dapatkan sertifikat setelah menyelesaikan kursus untuk meningkatkan nilai profesionalmu.'
            ],
        ];
    }

    public function render()
    {
        return view('front::livewire.features', [
            'features' => self::allFeatures()
        ]);
    }
}
