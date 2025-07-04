<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavItem extends Model
{
    protected $table = 'nav_items';

  protected $fillable = ['title', 'url', 'order', 'active', 'parent_id', 'icon'];


    public function children()
    {
        return $this->hasMany(NavItem::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(NavItem::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
