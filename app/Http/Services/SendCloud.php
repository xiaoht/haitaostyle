<?php

namespace App\Http\Services;

use Mail;
use Naux\Mail\SendCloudTemplate;

class SendCloud
{
    public static function sendTo($user, $data , $template)
    {
        $templates = new SendCloudTemplate($template , $data);

        $res = Mail::raw($templates, function ($message) use ($user) {
            $message->from('xiaohaitao_1995@163.com', '海涛个人style');

            $message->to($user->email);
        });
    }
}
