<?php

namespace App;

use App\Http\Models\Discussion;
use App\Http\Services\SendCloud;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','avatar' , 'confirmation_token' , 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        SendCloud::sendPasswordResetNotification($token , $this);
    }

    public function discussions()
    {
       return $this->hasMany(Discussion::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
