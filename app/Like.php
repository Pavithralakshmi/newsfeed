<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     protected $fillable = [
        'user_id ', 'user_type', 'items_id','liked','created_at','updated_at'
    ];
}
