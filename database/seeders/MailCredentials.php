<?php

namespace Database\Seeders;

use App\Models\MailCredential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MailCredentials extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailCredential::insert([
            'name' => 'mail_host',
            'value' => null,
        ]);

        MailCredential::insert([
            'name' => 'mail_port',
            'value' => null,
        ]);

        MailCredential::insert([
            'name' => 'mail_username',
            'value' => null,
        ]);

        MailCredential::insert([
            'name' => 'mail_password',
            'value' => null,
        ]);

        MailCredential::insert([
            'name' => 'mail_encryption',
            'value' => null,
        ]);

        MailCredential::insert([
            'name' => 'mail_address',
            'value' => null,
        ]);
    }
}
