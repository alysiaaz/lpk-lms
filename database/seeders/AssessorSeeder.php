<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AssessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate agar tidak error duplikat jika dijalankan berulang kali
        User::updateOrCreate(
            ['email' => 'assessor@gmail.com'], // Cari berdasarkan email ini
            [
                'name'              => 'Instruktur Assessor',
                'email'             => 'assessor@gmail.com',
                'password'          => Hash::make('password123'), // Password akun
                'role'              => 'assessor',                // Role khusus assessor
                'email_verified_at' => now(),
            ]
        );
    }
}