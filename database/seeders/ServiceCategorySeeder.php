<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Website & App Development',
            'Digital Marketing',
            'Branding & Creative Services',
            'IT Infrastructure & Support',
            'Cybersecurity Services',
            'Software Solutions',
            'Legal Consultation Services',
        ];

        foreach ($categories as $category) {
            DB::table('service_categories')->insert([
                'name' => $category,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
