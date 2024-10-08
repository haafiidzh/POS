<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\User;
use Spatie\Permission\Models\Role;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua user dari seeder sebelumnya
        $users = User::all();

        // Assign role ke user
        foreach ($users as $user) {
            // Pastikan nama role ada dan cocok dengan user
            $role = Role::where('name', $user->name)->first();
            
            if ($role) {
                // Gunakan syncRoles agar role diganti dan tidak ada duplikasi
                $user->syncRoles([$role->name]);
            } else {
                // Jika role belum ada, buat role sesuai dengan nama user
                $newRole = Role::create(['name' => $user->name, 'guard_name' => 'web']);
                $user->syncRoles([$newRole->name]);
            }
        }
    }
}
