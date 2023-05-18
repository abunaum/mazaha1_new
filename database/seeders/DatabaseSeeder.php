<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\categories;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Ahmad Yani',
            'username' => 'admin',
            'email' => 'ahmad.yani.ardath@gmail.com',
            'role' => 'admin',
            'is_active' => true,
            'password' => bcrypt('yaniardath!@#'),
        ]);

        User::create([
            'name' => 'Najwan Nada',
            'username' => 'nada',
            'email' => 'najwannada@mazainulhasan1.sch.id',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('nada123'),
        ]);

        User::create([
            'name' => 'Admin Madrasah',
            'username' => 'admin2',
            'email' => 'alexsaif@yahoo.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('admin2123'),
        ]);

        User::create([
            'name' => 'Muhammad Hendra',
            'username' => 'mhd',
            'email' => 'hendra_elhaza@ymail.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('mhd123'),
        ]);

        User::create([
            'name' => 'Rio Bahtiar',
            'username' => 'bahtiar',
            'email' => 'riobahtiar@live.com',
            'role' => 'media',
            'is_active' => true,
            'password' => bcrypt('bahtiar123'),
        ]);

        categories::create([
            'nama' => 'Berita',
        ]);
        categories::create([
            'nama' => 'Informasi',
        ]);
        categories::create([
            'nama' => 'Prestasi',
        ]);
    }
}
