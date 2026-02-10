<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitKmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles first
        Role::updateOrCreate(
            ['name' => 'Superadmin'],
            ['description' => 'Full access']
        );
        
        Role::updateOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Admin access']
        );
        
        Role::updateOrCreate(
            ['name' => 'Public'],
            ['description' => 'Public access']
        );

        // Then create apps
        App::updateOrCreate(
            ['slug' => 'app1'],
            ['name' => 'App1', 'description' => 'Pengelolaan konten App1']
        );
        App::updateOrCreate(
            ['slug' => 'app2'],
            ['name' => 'App2', 'description' => 'Pengelolaan konten App2']
        );

        App::updateOrCreate(
            ['slug' => 'app3'],
            ['name' => 'App3', 'description' => 'Pengelolaan konten App3']
        );

        User::updateOrCreate(
            ['email' => 'super@readymix.com'],
            [
                'nama' => ' Super Admin',
                'ttl' => '2001-05-15',
                'gender' => 'Laki-laki',
                'alamat' => 'Semarang',
                'no_hp' => '081234567890',
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'role_id' => 1,
            ]
        );
        
        User::updateOrCreate(
            ['email' => 'admin@readymix.com'],
            [
                'nama' => 'Admin',
                'ttl' => '2002-06-20',
                'gender' => 'Perempuan',
                'alamat' => 'Jakarta',
                'no_hp' => '089876543210',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'role_id' => 2,
            ]
        );

        User::updateOrCreate(
            ['email' => 'niam@readymix.com'],
            [
                'nama' => 'Niam',
                'ttl' => '2006-04-25',
                'gender' => 'Laki-laki',
                'alamat' => 'Kendal',
                'no_hp' => '087654321098',
                'username' => 'niam',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'role_id' => 2,
            ]
        );

        // Create public user for testing
        User::updateOrCreate(
            ['email' => 'public@readymix.com'],
            [
                'nama' => 'Public User',
                'ttl' => '2005-03-10',
                'gender' => 'Perempuan',
                'alamat' => 'Bandung',
                'no_hp' => '085555666777',
                'username' => 'publicuser',
                'password' => Hash::make('password'),
                'role' => 'public',
                'role_id' => 3,
            ]
        );
    }
}

