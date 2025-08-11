<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultValues = [
            'logo' => '/panel/laravel_page/images/2024-02-20-11:02:39-sunny-days-the-piano-project_logo.png',
            
            'google_analytics_site_tag' => '<script async src="https://www.googletagmanager.com/gtag/js?id=G-425WX86RZD"></script>',
            'google_analytics_script' => "<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-425WX86RZD'); </script>",
            'google_recaptcha_site_key' => '6LcOI3grAAAAAAQgSWA4VG7kxe9VP2smb-_vcLq0',
            'google_recaptcha_secret_key' => '6LcOI3grAAAAAPrezuLQO5iYWdIsdC0IVFFEp1BT',

            'api_user_password' => '$2y$10$6DyHLep0XQcd4jZNEVSrbuG7Ul5Z0V1ZxCWzc8qFH6hLTJS2x28i.',
            'api_user_id' => 'api_key_private',
            'api_key_private' => 's0iUb5MYgwQhnCWuCHuVWGba8LFD0sRw3ITSFoot'
        ];

        foreach ($defaultValues as $key => $value) {
            System::updateOrCreate(
                ['key' => $key],
                ['content' => $value, 'active' => true, 'order' => 0]
            );
        }
    }
}
