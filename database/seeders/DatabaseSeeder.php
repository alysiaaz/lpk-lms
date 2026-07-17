<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Kursus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin123',
            'email' => 'admin123@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alysia',
            'email' => 'alysiadjarre@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'peserta',
        ]);

        $kat1 = Kategori::create(['nama' => 'Programming', 'slug' => 'programming']);
        $kat2 = Kategori::create(['nama' => 'Desain Grafis', 'slug' => 'desain-grafis']);
        $kat3 = Kategori::create(['nama' => 'Digital Marketing', 'slug' => 'digital-marketing']);

        Kursus::create([
                'kategori_id' => $kat1->id,
                'judul' => 'Fullstack Laravel & Vue JS for Enterprise',
                'slug' => 'fullstack-laravel-vue-js-for-enterprise',
                'deskripsi' => 'Pelajari cara membangun aplikasi website skala besar dengan arsitektur modern, REST API, dan database MySQL bersama instruktur praktisi industri.',
                'thumbnail' => null,
            ]);
        
        Kursus::create([
                'kategori_id' => $kat2->id,
                'judul' => 'UI/UX Design Mastery: Figma to Prototyping',
                'slug' => 'ui-ux-design-mastery-figma-to-prototyping',
                'deskripsi' => 'Kuasai proses desain produk digital mulai dari riset pengguna, wireframing, hingga pembuatan sistem desain profesional yang siap di-develop.',
                'thumbnail' => null,
            ]);

        Kursus::create([
            'kategori_id' => $kat3->id,
            'judul' => 'Performance Marketing & Meta Ads Specialist',
            'slug' => 'performance-marketing-meta-ads-specialist',
            'deskripsi' => 'Belajar merancang kampanye iklan digital yang menguntungkan berbasis analisis data dan targeting yang akurat untuk dunia kerja modern.',
            'thumbnail' => null,
            ]);
    }    
}
