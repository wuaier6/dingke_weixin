<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wechat;
use Log;

class TeacherController extends Controller
{

    public function index(){

    }


    public function Bind(){

        $wechatJs = self::WechatJs();
        return view('teacher.bind', ["wechat_js" => $wechatJs]);
    }

}
