<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User ADMIN (Untuk masuk Dashboard)
        User::factory()->create([
            'name' => 'Admin Diskominfotik',
            'email' => 'egar@gmail.com',
            'role' => 'admin',              // <--- Penting: Set sebagai admin
            'password' => bcrypt('rahasia123'),
        ]);

        // 2. User BIASA (Untuk masuk halaman Identitas)
        User::factory()->create([
            'name' => 'Staf Pegawai',
            'email' => 'user@gmail.com',    // <--- Email user kedua
            'role' => 'user',               // <--- Penting: Set sebagai user biasa
            'password' => bcrypt('user123'),
        ]);
    }
}