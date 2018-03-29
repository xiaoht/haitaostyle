<?php

namespace App\Http\Models;

use App\Http\Models\Model;
use App\User;

class Discussion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
