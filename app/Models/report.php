<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
   protected $fillable = ['message_id', 'reason','user_id'];

}
