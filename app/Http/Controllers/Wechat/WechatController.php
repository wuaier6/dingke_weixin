<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wechat;
use Log;
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
        $WechatUserMdoel = new WechatUser();
        $openid = $message->FromUserName;

        switch ($message->Event) {
            //订阅
            case 'subscribe':
                break;
            //取消订阅
            case 'unsubscribe':
                break;
            //已订阅用户扫码
            case 'SCAN':
                break;
            //上报地理位置事件
            case 'LOCATION':
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

}
