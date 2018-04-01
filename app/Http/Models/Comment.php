<?php

namespace App\Http\Models;

use App\User;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
