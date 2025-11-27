<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Sekolah
        User::create([
            'name' => 'Admin Sekolah',
            'username' => 'admin',
            'email' => 'admin@smk.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Guru/Pembina Mading
        User::create([
            'name' => 'Guru Pembina',
            'username' => 'guru1',
            'email' => 'guru@smk.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru'
        ]);

        // Siswa
        User::create([
            'name' => 'Siswa SMK',
            'username' => 'siswa1',
            'email' => 'siswa@smk.sch.id',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);
    }
}