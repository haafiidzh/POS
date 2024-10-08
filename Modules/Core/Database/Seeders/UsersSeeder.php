<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert users
        foreach ($this->users() as $userData) {
            // Cek apakah pengguna sudah ada berdasarkan email
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }

    /**
     * Generate user data
     *
     * @return array
     */
    protected function users()
    {
        return [
            [
                'id' => User::generateId(),
                'name' => 'Developer',
                'avatar' => null,
                'email' => 'developer@app.com',
                'is_seen' => 0,
                'status' => 'active',
                'email_verified_at' => now()->toDateTimeString(),
                'password' => bcrypt('password'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'id' => User::generateId(),
                'name' => 'Mitra',
                'avatar' => null,
                'email' => 'mitra@app.com',
                'is_seen' => 0,
                'status' => 'active',
                'email_verified_at' => now()->toDateTimeString(),
                'password' => bcrypt('password'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            [
                'id' => User::generateId(),
                'name' => 'Admin',
                'avatar' => null,
                'email' => 'admin@app.com',
                'is_seen' => 0,
                'status' => 'active',
                'email_verified_at' => now()->toDateTimeString(),
                'password' => bcrypt('password'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ],
            // [
            //     'id' => User::generateId(),
            //     'name' => 'Super Admin',
            //     'avatar' => null,
            //     'email' => 'super_admin@app.com',
            //     'is_seen' => 0,
            //     'status' => 'active',
            //     'email_verified_at' => now()->toDateTimeString(),
            //     'password' => bcrypt('password'),
            //     'created_at' => now()->toDateTimeString(),
            //     'updated_at' => now()->toDateTimeString(),
            // ],
            // [
            //     'id' => User::generateId(),
            //     'name' => 'Course Admin',
            //     'avatar' => null,
            //     'email' => 'course_admin@app.com',
            //     'is_seen' => 0,
            //     'status' => 'active',
            //     'email_verified_at' => now()->toDateTimeString(),
            //     'password' => bcrypt('password'),
            //     'created_at' => now()->toDateTimeString(),
            //     'updated_at' => now()->toDateTimeString(),
            // ],
        ];
    }
}
