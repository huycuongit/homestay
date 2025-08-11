<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\System;

class UpdateSystemsTable extends Command
{
    protected $signature = 'systems:update';
    protected $description = 'Updates the Systems table with default keys';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $defaultValues = [
            'company_email' => 'admin@homestay.com',
            'company_hotline' => '0343672218',
            'password_default' => 'Homestay@123',

            'logo_app' => '/storage/systems/logo_app.png',
            'banner_app' => '/storage/systems/welcome_login.jpg',

            'google_recaptcha_site_key' => '6LfIGfIqAAAAAB-btcPwgp3r3-Qcrd8fs7rMY7XJ',
            'google_recaptcha_secret_key' => '6LfIGfIqAAAAAIWygkiW-Pqb6HcjMNhhNnrOlZvB',

            'link_clause' => 'https://sunnydays.vn/privacy-policy',
            'link_support' => 'https://support.sunnydays.vn',
            'link_introduce' => 'https://app.sunnydays.vn',

            'link_facebook' => 'https://facebook.com',
            'link_messenger' => 'https://facebook.com?messengerid=1',

            'link_zalo' => 'https://zalo.me?0949992539',


        ];

        foreach ($defaultValues as $key => $value) {
            System::updateOrCreate(
                ['key' => $key],
                ['content' => $value, 'active' => true, 'order' => 0]
            );
        }

        $this->info('Systems table updated successfully.');
    }
}
