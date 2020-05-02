<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = App\Setting::create([
        	'site_name' => 'Sidetheme',
        	'site_url' => 'http://www.sidetheme.com',
        	'meta_title' => 'Download Free WordPress Themes, Bootstrap Themes and Website Template',
	        'meta_description' => 'Sidetheme is a Source for High Quality GPL Licensed Free WordPress Themes, WordPress Plugins, PHP Script, Bootstrap Themes and HTML Template. All the contains are safe and tested by us.',
	        'copyright' => 'Copyright © 2020 Sidetheme. All rights reserved.',
	        'email' => 'support@sidetheme.com',
            'logo' => 'assets/img/logo.png',
            'favicon' => 'assets/img/favicon.png',
            'cover' => 'assets/img/cover.png',
            'logo_width' => '160px',
            'logo_height' => '48px',
            'main_color' => '#212e36',
            'body_color' => '#f5f5f5',
            'header_color' => '#212e36',
            'footer_color' => '#212e36',
	        'mail_driver' => 'smtp',
	        'mail_host' => 'smtp.mailtrap.io',
	        'mail_username' => 'b478086d279d4a',
	        'mail_password' => 'e8f64b007cc986',
	        'mail_port' => '2525',
	        'mail_from' => 'no-reply@sidetheme.com',
	        'mail_encryption' => 'tls',
            'timezone' => 'Asia/Kathmandu',
            'max_upload_size' => '10024',
	        'maintenance' => 0,
	        'ssl' => 0,
	        'app_debug' => 1,
        ]);
    }
}
