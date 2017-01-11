<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wechat;
use Log;
use Geohash\Geohash;

class WechatController extends Controller
{

    public function Verify(Request $request)
    {
        Log::info('check verify');
        $wechat = app('wechat');
        return $wechat->server->serve();
    }


    public function Connection(Request $request)
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    Log::debug('event message:' . json_encode($message));
                    return self::EventProcess($message);
                    break;
                case 'text':
                    $wechat = app('wechat');
                    $userService = $wechat->user;
                    $user = $userService->get($message->FromUserName);
                    Log::debug('text message:' . json_encode($user));
                    return 'text message:' . json_encode($user);
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }


        });
        Log::info('return response.');

        return $wechat->server->serve();
    }


    public function EventProcess($message)
    {

        $openid = $message->FromUserName;

        switch ($message->Event) {
            //订阅
            case 'subscribe':
                //带参扫码，未关注
                if ($message->EventKey != NULL) {
                    return self::QRCode($message,true);
                } //直接扫码关注
                else {
                    return NULL;
                }
                break;
            //取消订阅
            case 'unsubscribe':
                break;
            //已订阅用户扫码
            case 'SCAN':
                return self::QRCode($message);
                break;
            //上报地理位置事件
            case 'LOCATION':
                return self::Location($message);
                break;
            //点击菜单拉取消息时的事件推送
            case 'CLICK':
                break;
            //点击菜单跳转链接时的事件推送
            case 'VIEW':
                break;
            default:
                # code...
                break;
        }
        return NULL;
    }

    private function QRCode($message, $is_subscribe = false)
    {
        if ($is_subscribe) {
            $code = str_replace('qrscene_', '', $message->EventKey);
        } else {
            $code = $message->EventKey;
        }

        Log::info('qrcode'.$code);
        $openid = $message->FromUserName;
        $this->SendTeacherMessageNotice($openid);
      //$code_type = mb_substr($code, 0, 3);
        return NULL;

    }

    /**
     * 教师提醒绑定通知
     * @return News
     */
    private function SendTeacherMessageNotice($openid)
    {
        $templateId = 'Dd15A8_6loGQ-xirtl3iykXCLML8VVOck-9JgyIxiuk';
        $url="https://www.baidu.com";
        $color = '#FF0000';
        $data = array(
            "first" => "您好，正在绑定xx账号。",
            "keyword1" => "a@test.com",
            "keyword2" => "短信验证码已下发至绑定用户的手机，请注意查收。",
            "remark" => "请10分钟内回复#+短信验证，如#8888。",
        );
        $notice = Wechat::notice();
        $messageId = $notice->uses($templateId)->withColor($color)->withUrl($url)->andData($data)->andReceiver($openid)->send();
        return true;
    }

    private function Location($message){
        $openid = $message->FromUserName;
        $Latitude = $message->Latitude;
        $Longitude = $message->Longitude;
        $Precision = $message->Precision;
        $Geohash= Geohash::encode($Latitude, $Longitude);
        log::info("location".$Geohash);
        return true;
    }

}
