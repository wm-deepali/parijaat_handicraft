<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'tagline',
        'header_logo',
        'footer_logo',
        'favicon',
        'admin_login_logo',
        'admin_dashboard_logo',
        'admin_email',
        'support_email',
        'phone',
        'whatsapp',
        'business_address',
        'business_hours',
        'footer_description',
        'footer_copyright',
        'google_map_url',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'pinterest',
        'currency',
        'currency_symbol',
        'timezone',
        'maintenance_mode',
        'admin_session_timeout',
        'product_reviews',
        'wishlist',
        'stock_alerts',
        'cod_enabled'
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'product_reviews' => 'boolean',
        'wishlist' => 'boolean',
        'stock_alerts' => 'boolean',
        'cod_enabled' => 'boolean',
    ];

    /** The settings row, loaded once per request. */
    public static function current(): ?self
    {
        static $row = false;

        if ($row === false) {
            $row = static::first();
        }

        return $row;
    }

    /** Public support contact details; every empty field comes back as null. */
    public static function contact(): array
    {
        $s = static::current() ?? new static;

        return [
            'phone' => trim((string) $s->phone) ?: null,
            'phone_link' => $s->phone_link,
            'whatsapp' => $s->whatsapp_digits,
            'email' => $s->contact_email,
            'hours' => trim((string) $s->business_hours) ?: null,
        ];
    }

    /* ------------------------------------------------------------ brand */

    public function getBrandAttribute(): string
    {
        return trim((string) $this->site_name) ?: config('app.name');
    }

    public function getHeaderLogoUrlAttribute(): ?string
    {
        return $this->fileUrl($this->header_logo);
    }

    public function getFooterLogoUrlAttribute(): ?string
    {
        return $this->fileUrl($this->footer_logo);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->fileUrl($this->favicon);
    }

    /* ------------------------------------------------------------ contact */

    public function getPhoneLinkAttribute(): ?string
    {
        return preg_replace('/[^\d+]/', '', (string) $this->phone) ?: null;
    }

    public function getWhatsappDigitsAttribute(): ?string
    {
        return preg_replace('/\D+/', '', (string) $this->whatsapp) ?: null;
    }

    public function getWhatsappUrlAttribute(): ?string
    {
        return $this->whatsapp_digits ? 'https://wa.me/' . $this->whatsapp_digits : null;
    }

    /** Public email only. The admin login email is never shown on the storefront. */
    public function getContactEmailAttribute(): ?string
    {
        return trim((string) $this->support_email) ?: null;
    }

    /** Filled social links only: key => [label, icon, url] */
    public function getSocialsAttribute(): array
    {
        $defs = [
            'facebook' => ['Facebook', 'fa-brands fa-facebook-f'],
            'instagram' => ['Instagram', 'fa-brands fa-instagram'],
            'youtube' => ['YouTube', 'fa-brands fa-youtube'],
            'pinterest' => ['Pinterest', 'fa-brands fa-pinterest-p'],
            'twitter' => ['X (Twitter)', 'fa-brands fa-x-twitter'],
            'linkedin' => ['LinkedIn', 'fa-brands fa-linkedin-in'],
        ];

        $out = [];

        foreach ($defs as $key => [$label, $icon]) {
            $url = trim((string) $this->{$key});

            if ($url !== '') {
                $out[$key] = ['label' => $label, 'icon' => $icon, 'url' => $url];
            }
        }

        return $out;
    }

    private function fileUrl(?string $path): ?string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return null;
        }

        return preg_match('#^https?://#i', $path) ? $path : asset('storage/' . ltrim($path, '/'));
    }
}