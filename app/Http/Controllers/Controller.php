<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param array|NULL $array
     *
     * @return mixed
     */
    protected function WechatJs(array $array = NULL)
    {
        if ($array === NULL) {
            $array = array('hideOptionMenu');
        }
        $wechatJs = \Wechat::js();
        $wechatJs->setUrl(config('zzmed.site.baseurl') . '/' . \Request::path());

        $wechatJs = $wechatJs->config($array, false, false);
        return $wechatJs;

    }

    /**
     * 微信患者用户授权页面统一跳转页
     * 会根据session中jump url的值进行跳转
     * $session->get(config('zzmed.session.wechat_oauth_jump_url'))
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function UserOauthCallback(Request $request, $wechatUser)
    {
        $session = \Request::session();
        $session->set(config('zzmed.session.wechat_user'), $wechatUser->toArray());
        //$userModel = new User();
       // $user = $userModel->get_by_openId($wechatUser->id);
       // if ($user !== false) {
            $session->set(config('zzmed.session.user_id'), 1);
      //  }
        return $session->has(config('zzmed.session.wechat_oauth_jump_url')) ? $session->get(config('zzmed.session.wechat_oauth_jump_url')) : config('baseurl') . '/User/Login';
    }


    /**
     * 判断用户是否登录
     * @param bool $isAjax
     *
     * @return bool
     * @throws ValidateException
     */
    protected function UserLoginCheck(bool $isAjax = true)
    {
        $session = \Request::session();
        $userId = $session->get(config('zzmed.session.user_id'));
        if ($userId == NULL) {
            if ($isAjax) {
                throw new ValidateException(-9000052);
            }
            return false;
        }
        return $userId;
    }


    protected function redirect($to = NULL, $status = 302, $headers = [], $secure = NULL)
    {
        if (is_null($to)) {
            return app('redirect');
        }
        if (is_null($secure)) {
            if (config('zzmed.site.protocol') == 'https') {
                $secure = true;
            }
        }
        return app('redirect')->to($to, $status, $headers, $secure);
    }


}
