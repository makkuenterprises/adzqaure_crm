<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the three specific roles required
        $roles = [
            'Admin',
            'HR Manager',
            'Lead Coordinator',
        ];

        // Loop through the roles and insert them if they don't already exist
        foreach ($roles as $roleName) {
            $roleSlug = Str::slug($roleName);

            // Check if a role with the same slug already exists to prevent duplicates
            $roleExists = DB::table('roles')->where('slug', $roleSlug)->exists();

            if (!$roleExists) {
                DB::table('roles')->insert([
                    'name'       => $roleName,
                    'slug'       => $roleSlug,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
