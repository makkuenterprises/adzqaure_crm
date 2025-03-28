<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CompanyDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_details')->insert([
            'name' => 'company_logo',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_name',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_email',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_phone',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_phone_alternate',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_website',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_type',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_no',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_holder',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_ifsc',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_branch',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_account_vpa',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'billing_tax_percentage',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_address_street',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_address_city',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_address_pincode',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_address_state',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_address_country',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_social_media_facebook',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_social_media_twitter',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_social_media_instagram',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_social_media_linkedin',
            'value' => null,
        ]);
        DB::table('company_details')->insert([
            'name' => 'company_social_media_youtube',
            'value' => null,
        ]);
    }
}
