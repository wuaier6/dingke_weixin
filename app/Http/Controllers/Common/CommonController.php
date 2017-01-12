<?php

namespace App\Http\Controllers\Common;

use App\Common\ShortMessage;
use App\Common\ValidateHelper;
use App\Exceptions\JumpPageException;
use App\Exceptions\ShortMessageException;
use App\Exceptions\ValidateException;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Wechat;
use Cache;

class CommonController extends Controller
{
    /**
     * 微信自动跳转
     * @param Request $request
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function OauthCallback(Request $request)
    {
        $session = \Request::session();
        $oauth = Wechat::oauth();
        $wechatUser = $oauth->user();
        print_r($wechatUser);

//        $WechatUserMdoel = new WechatUser();
//        $role_type = $WechatUserMdoel->get_role_type($wechatUser->id);
//        if ($role_type == 2) {
//            //医生账号
//            $session->forget(config('zzmed.session.wechat_user'));
//            $targetUrl =$this->DocOauthCallback($request, $wechatUser);
//        }else if($role_type == 3){
//            //代表账号
//            $session->forget(config('zzmed.session.wechat_user'));
//            $targetUrl =$this->RepOauthCallback($request, $wechatUser);
//        } else {
//            $role_type = $session->get(config('zzmed.role_type'));
//            if($role_type==2){
//                //医生账号
//                $targetUrl =$this->DocOauthCallback($request, $wechatUser);
//                $session->forget(config('zzmed.role_type'));
//            }else if($role_type==3){
//                //代表账号
//                $targetUrl =$this->RepOauthCallback($request, $wechatUser);
//                $session->forget(config('zzmed.role_type'));
//            }else{
//                $targetUrl = $this->UserOauthCallback($request, $wechatUser);
//            }
//        }
        $targetUrl = $this->UserOauthCallback($request, $wechatUser);
        return $this->redirect($targetUrl);
    }


    /**
     * 获得验证码
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws JumpPageException
     * @throws ShortMessageException
     * @throws ValidateException
     */
    public function UserVerifyCode(Request $request)
    {
        $cell = $request->get('cell');
        if ($cell === NULL) {
            throw new ValidateException(-1000005);
        }
        $session = $request->session();
        if (!$session->has(config('zzmed.session.wechat_user'))) {
            throw new JumpPageException(-9000099);
        }
        $wechatUser = $session->get(config('zzmed.session.wechat_user'));

        ValidateHelper::IsCell($cell);

        $user = new User();
        $openid = $wechatUser['id'];
        $userData = $user->is_cell_binded($cell, $openid);
//            * -1:没有此手机号码
//            * -2:已绑定其他微信账号
//            * -3:此帐户为租借账户
//            * -4:此账号非正常可使用状态
//            * -5:存在此账号，但未绑定
//            * >0:此手机已绑定此微信号
        $smsResult = ShortMessage::SendVerifyCode($cell);
        if ($smsResult) {
            if ($userData['code'] == -1 || $userData['code'] == -3 || $userData['code'] == -4) {
                //手机不存在,注册
                return $this->return_json_data(2);
            } else if ($userData['code'] > 0 || $userData['code'] == -2 || $userData['code'] == -5) {
                //绑定
                return $this->return_json_data(1);
            }
        } else {
            throw new ShortMessageException(-9000014);
        }
    }

}
