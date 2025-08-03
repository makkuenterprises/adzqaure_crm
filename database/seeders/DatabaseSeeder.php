<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => "Administrator",
            'email' => "admin@example.com",
            'phone' => "1234567890",
            'role' => "Master Admin",
            'password' => Hash::make('12345678')
        ]);

            $this->call([
            ServiceCategorySeeder::class,
        ]);
            $this->call([
            RoleSeeder::class,
            PermissionSeeder::class, // Add this line
        ]);
    }
}
