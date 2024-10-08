<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles() as $role) {
            // Gunakan firstOrCreate untuk menghindari duplikasi
            Role::firstOrCreate(
                ['name' => $role['name'], 'guard_name' => $role['guard_name']],
                ['created_at' => $role['created_at'], 'updated_at' => $role['updated_at']]
            );
        }
    }

    /**
     * Generate role data
     *
     * @return array
     */
    protected function roles()
    {
        return [
            [
                'name' => 'Developer',
                'guard_name' => 'web',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'name' => 'Course Admin',
                'guard_name' => 'web',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
        ];
    }
}
