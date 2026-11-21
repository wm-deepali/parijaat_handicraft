<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BulkEnquiry extends Model
{
    use SoftDeletes;

    public const FREQUENCIES = ['One-time order', 'Monthly', 'Quarterly', 'Seasonal / Yearly'];
    public const STATUSES = ['new' => 'New', 'contacted' => 'Contacted', 'quoted' => 'Quoted', 'closed' => 'Closed'];

    protected $fillable = [
        'full_name',
        'company',
        'email',
        'phone',
        'phone_full',
        'country_code',
        'dial_code',
        'category',
        'quantity',
        'ship_country',
        'frequency',
        'message',
        'files',
        'status',
        'is_read',
        'admin_note',
        'ip_address',
    ];

    protected $casts = ['files' => 'array', 'is_read' => 'boolean'];

    public function getFileUrlsAttribute(): array
    {
        return collect($this->files ?? [])
            ->map(fn($f) => ['name' => $f['name'], 'url' => asset('storage/' . $f['path'])])
            ->all();
    }
}