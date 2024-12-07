<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menyisipkan data ke tabel users
        DB::table('users')->insert([
            [
                'name' => 'biungbiung',
                'email' => 'biungbiung@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Password yang sudah di-hash
                // 'remember_token' => str_random(60),
                'role' => 'pemesan', // Sesuaikan dengan role yang Anda inginkan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@adminkita.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminkita'), // Password yang sudah di-hash
                // 'remember_token' => str_random(60),
                'role' => 'admin', // Role untuk admin
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
