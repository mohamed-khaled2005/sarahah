<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
    protected $fillable = ['name', 'code',"active"];
}
