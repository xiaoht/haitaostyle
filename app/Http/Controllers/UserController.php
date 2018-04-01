<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function avatar()
    {
        return view('user.avatar');
    }

    public function uploadAvatar()
    {
        dd('avatar');
    }
}
