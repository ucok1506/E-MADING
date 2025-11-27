<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'nama' => 'Guru Pembina',
            'username' => 'guru',
            'password' => Hash::make('guru123'),
            'role' => 'guru'
        ]);

        User::create([
            'nama' => 'Siswa Demo',
            'username' => 'siswa',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);
    }
}