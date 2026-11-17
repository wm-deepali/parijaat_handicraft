<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Site me ek hi settings row hoti hai (Setting::first()), isliye id = 1 par updateOrCreate
        Setting::updateOrCreate(
            ['id' => 1],
            [
                // Branding
                'site_name'            => 'Parijaat Handicraft',
                'tagline'              => 'Handcrafted Treasures · Home Decor · Gifts',
                'header_logo'          => null,
                'footer_logo'          => null,
                'favicon'              => null,
                'admin_login_logo'     => null,
                'admin_dashboard_logo' => null,

                // Contact
                'admin_email'          => 'info@parijathandicraft.com',
                'support_email'        => 'info@parijathandicraft.com',
                'phone'                => '+91 9953567333',
                'whatsapp'             => '919953567333',
                'business_address'     => "SHOP NO-27GF, GDA SHOPPING COMPLEX NYAY KHAND-1,\nINDIRAPURAM, GHAZIABAD-201014,\nUTTAR PRADESH",
                'google_map_url'       => null,

                // Footer
                'footer_description'   => 'Thoughtfully crafted handicrafts, curated for every home and occasion.',
                'footer_copyright'     => '© ' . date('Y') . ' Parijaat Handicraft. All Rights Reserved.',

                // Social (khali = layout me hide ho jayega)
                'facebook'             => null,
                'instagram'            => null,
                'twitter'              => null,
                'linkedin'             => null,
                'youtube'              => null,
                'pinterest'            => null,

                // Store
                'currency'             => 'INR',
                'currency_symbol'      => '₹',
                'timezone'             => 'Asia/Kolkata',

                // System
                'maintenance_mode'      => false,
                'admin_session_timeout' => 30,

                // Features
                'product_reviews'      => true,
                'wishlist'             => true,
                'stock_alerts'         => true,
                'cod_enabled'          => true,
            ]
        );
    }
}