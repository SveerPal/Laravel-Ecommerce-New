<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $settings = [
        [
            'key'                       =>  'site_name',
            'value'                     =>  'My CMS',
        ],
        [
            'key'                       =>  'site_title',
            'value'                     =>  'My Coding Solution',
        ],
        [
            'key'                       =>  'default_email_address',
            'value'                     =>  'admin@admin.com',
        ],
        [
            'key'                       =>  'default_phone',
            'value'                     =>  '7636438783723',
        ],
        [
            'key'                       =>  'default_address',
            'value'                     =>  'B-12 New Ashok Nagar',
        ],
        [
            'key'                       =>  'email',
            'value'                     =>  'admin2@admin.com',
        ],
        [
            'key'                       =>  'phone',
            'value'                     =>  '22222222222',
        ],
        [
            'key'                       =>  'address',
            'value'                     =>  'B-1222 New Ashok Nagar',
        ],
        [
            'key'                       =>  'map',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'currency_code',
            'value'                     =>  'INR',
        ],
        [
            'key'                       =>  'currency_symbol',
            'value'                     =>  '₹',
        ],
        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  'Copyright © 2021 mycodingsolution.com',
        ],
        [
            'key'                       =>  'seo_meta_title',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_description',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  'https://mycodingsolution.com/',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  'https://mycodingsolution.com/',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  'https://mycodingsolution.com/',
        ],
        [
            'key'                       =>  'social_linkedin',
            'value'                     =>  'https://mycodingsolution.com/',
        ],
        [
            'key'                       =>  'google_analytics',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'facebook_pixels',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_key',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_secret_key',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_client_id',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_secret_id',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'smtp_method',
            'value'                     =>  '1',
        ],
        [
            'key'                       =>  'smtp_host',
            'value'                     =>  'host.mycodingsolution.com',
        ],
        [
            'key'                       =>  'smtp_user',
            'value'                     =>  'smtp@mycodingsolution.com',
        ],
        [
            'key'                       =>  'smtp_password',
            'value'                     =>  'admin@1234',
        ],
        [
            'key'                       =>  'smtp_port',
            'value'                     =>  '465',
        ],
        [
            'key'                       =>  'smtp_type',
            'value'                     =>  'SSL',
        ],
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting)
        {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings). ' records');
    }
}
