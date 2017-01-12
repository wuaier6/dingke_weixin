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


    public function Bind(Request $request){
      //  $oauth = $this->doc_wechat();
        $session = $request->session();
        $oauth = Wechat::oauth();
        if (!$session->has(config('zzmed.session.wechat_user'))) {
            $session->set(config('zzmed.doc_session.doc_wechat_oauth_jump_url'), config('zzmed.site.baseurl') . config('zzmed.doc_bind_page'));
            return $oauth->redirect();
        }

        $wechatJs = self::WechatJs();
        return view('teacher.bind', ["wechat_js" => $wechatJs]);
    }

}
