<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::insert([
            [
                'nama' => 'Ananda Bayu',
                'email' => 'bayu@email.com',
                'npp' => 12345,
                'npp_supervisor' => '11111',
                'password' => bcrypt('password')
            ], [
                'nama' => 'Supervisor',
                'email' => 'spv@email.com',
                'npp' => 11111,
                'npp_supervisor' => null,
                'password' => bcrypt('password')
            ]
        ]);
    }
}
