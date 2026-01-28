<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // SUPER ADMIN
        User::create([
            'username' => 'superadmin',
            'full_name' => 'Super Administrator',
            'roles' => 'super_admin',
            'password' => Hash::make('super123'),
        ]);

        // ADMIN
        User::create([
            'username' => 'admin',
            'full_name' => 'Administrator',
            'roles' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        // SISWA
        User::create([
            'username' => 'siswa',
            'full_name' => 'Siswa Demo',
            'roles' => 'siswa',
            'password' => Hash::make('siswa123'),
        ]);
    }
}
