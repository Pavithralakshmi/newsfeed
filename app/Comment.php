<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    protected $fillable = [
        'comment', 'item_id', 'user_id', 'user_type'
    ];
}
