<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
        'name' => 'Admin Utama',
        'email' => 'admin@pom.go.id',
        'password' => Hash::make('passwordadmin'),
        'role' => 'admin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }
}
