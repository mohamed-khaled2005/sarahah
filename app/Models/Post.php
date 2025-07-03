<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // لإضافة accessors للصور

class Post extends Model
{
    use HasFactory;
protected $fillable = ['title', 'slug', 'content','author', 'category','thumbnail', 'status'];

    // Accessor للحصول على رابط الصورة المصغرة (Thumbnail)
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : null;
    }
}