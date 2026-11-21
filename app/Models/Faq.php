<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
        'sort_order',
        'show_home',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    /** HTML answers are output as-is (admin only); plain text keeps its line breaks */
    public function getAnswerHtmlAttribute(): string
    {
        $a = (string) $this->answer;

        return $a === strip_tags($a) ? nl2br(e($a)) : $a;
    }
}