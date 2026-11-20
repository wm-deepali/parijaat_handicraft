<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [

        'live_mode',

        // Cashfree (active)
        'cf_test_app_id',
        'cf_test_secret',
        'cf_live_app_id',
        'cf_live_secret',

        // Razorpay (disabled for now: uncomment when Razorpay comes back)
        // 'test_key_id',
        // 'test_key_secret',
        // 'live_key_id',
        // 'live_key_secret',
        // 'test_webhook_secret',
        // 'live_webhook_secret',
    ];

    protected $casts = [
        'live_mode' => 'boolean',
    ];
}