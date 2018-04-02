<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Image;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function avatar()
    {
        return view('user.avatar');
    }

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('avatar');

        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $destinationPath = 'uploads/';
        $filename = Auth::user()->id . '_' . time().$file->getClientOriginalName();
        $file->move($destinationPath,$filename);
        Image::make($destinationPath.$filename)->fit(200)->save();
        $user = User::find(Auth::user()->id);
        $user->avatar = '/'.$destinationPath.$filename;
        $user->save();

        return \Response::json([
            'success' => true,
            'avatar' => asset($destinationPath.$filename),
        ]);
    }
}
