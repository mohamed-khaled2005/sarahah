<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterNavItem extends Model
{
    
    protected $fillable = [
        'title', 'url', 'icon', 'order', 'active', 'parent_id'
    ];

    // علاقة العناصر الفرعية (اختياري)
    public function children()
    {
        return $this->hasMany(FooterNavItem::class, 'parent_id');
    }

    // علاقة العنصر الأب (اختياري)
    public function parent()
    {
        return $this->belongsTo(FooterNavItem::class, 'parent_id');
    }

}
