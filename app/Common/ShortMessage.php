<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 2016/2/29 0029
 * Time: 12:19
 */

namespace App\Common;


use App\Exceptions\ShortMessageException as smException;
use Carbon\Carbon;
use Cache;
class ShortMessage
{
    const SMS_N = "N";
    const SMS_H = "h";
    const SMS_CX = "C*";
    const SMS_C = "C";

    private function __construct()
    {
    }

    /**
     * Send 发送短信
     *
     * @param  string $mobile 手机号码
     * @param  string $content 信息
     *
     * @return bool
     */
    public static function Send($mobile, $content)
    {
        set_time_limit(0);
        $port = config('zzmed.sms.port');
        $ip = config('zzmed.sms.ip');

        if ($mobile == 0)
            return false;

        $content = mb_convert_encoding($content, "GBK", "UTF-8");
        //平台帐号密码
        $accountId = config('zzmed.sms.account');
        $password = config('zzmed.sms.password');
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket < 0) {
            return false;
        }
        $result = socket_connect($socket, $ip, $port);
        if ($result < 0) {
            return false;
        }
        $Timestamp = date("mdHis");
        //消息头
        $Command_Id = pack(self::SMS_N, 1);
        $Sequence_Id = pack(self::SMS_N, 1);
        //消息体
        $account = $accountId . pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0);    //加二进制的0补全到21位
        $accountMD5 = $accountId . pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0);    //加9个二进制的0
        $AuthenticatorSource = md5($accountMD5 . $password . $Timestamp, true);
        $Version = pack("H", '1.0');
        $Timestamp = pack(self::SMS_N, $Timestamp);
        $Message = $Command_Id . $Sequence_Id . $account . $AuthenticatorSource . $Version . $Timestamp;
        $Total_Length = pack(self::SMS_N, strlen($Message) + 4);
        $out = '';
        $in = $Total_Length . $Message;
        if (!socket_write($socket, $in, strlen($Message) + 4)) {
            return false;
        }
        //消息头
        $Command_Id = pack(self::SMS_N, 4);
        $Sequence_Id = pack(self::SMS_N, 0);
        //消息体,保留字段全为0
        $Msg_Id = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $Pk_total = pack(self::SMS_H, 1);
        $Pk_number = pack(self::SMS_H, 1);
        $Registered_Delivery = pack(self::SMS_H, 1); //返回状态
        $Msg_Fmt = pack(self::SMS_C, 15); //含GB汉字格式
        $ValId_Time = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $At_Time = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0); //即时发送
        $DestUsr_tl = pack(self::SMS_N, 1);
        $moblieAscii = '';
        for ($i = 0; $i < strlen($mobile); $i++) {
            $moblieAscii .= pack(self::SMS_C, ord(substr($mobile, $i, 1)));
        }
        $Dest_terminal_Id = $moblieAscii . pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0); //手机号补全到32字节
        $Msg_Length = pack(self::SMS_C, strlen($content));
        $contentAscii = '';
        for ($i = 0; $i < strlen($content); $i++) {
            $contentAscii .= pack(self::SMS_C, ord(substr($content, $i, 1)));
        }
        $Msg_Content = $contentAscii;
        $Msg_src = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0); //保留字段，默认抓包内容
        $Src_Id = $account; //帐号取上面的21位
        $Service_Id = pack(self::SMS_CX, 48, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        //==========以下保留字段===============
        $LinkID = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $Msg_level = pack(self::SMS_C, 1);
        $Fee_UserType = pack(self::SMS_C, 2);
        $Fee_terminal_Id = pack(self::SMS_CX, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $Fee_terminal_type = pack(self::SMS_C, 0);
        $TP_pId = pack(self::SMS_C, 0);
        $TP_udhi = pack(self::SMS_C, 0);
        $FeeType = pack("CC", 48, 49);
        $FeeCode = pack(self::SMS_CX, 48, 0, 0, 0, 0, 0);
        $Dest_terminal_type = pack(self::SMS_C, 0);
        $Message = $Command_Id . $Sequence_Id . $Msg_Id . $Pk_total . $Pk_number . $Registered_Delivery . $Msg_Fmt . $ValId_Time . $At_Time . $DestUsr_tl . $Dest_terminal_Id . $Msg_Length . $Msg_Content . $Msg_src . $Src_Id . $Service_Id . $LinkID . $Msg_level . $Fee_UserType . $Fee_terminal_Id . $Fee_terminal_type . $TP_pId . $TP_udhi . $FeeType . $FeeCode . $Dest_terminal_type;
        $Total_Length = pack(self::SMS_N, strlen($Message) + 4);
        $in = $Total_Length . $Message;
        if (!socket_write($socket, $in, strlen($Message) + 4)) {
            socket_close($socket);
            return false;
        }
        //下面可以接受发送返回的状态
        socket_close($socket);
        return true;
    }

    /**
     * 发送短消息验证码
     *
     * @param string $cell 手机
     * @param string $verifyCode 验证码
     *
     * @return bool
     * @throws ShortMessageException
     */
    public static function SendVerifyCode($cell, $verifyCode="")
    {
        if (empty($cell) || trim($cell) == "") {
            throw new smException(-1000005);
        }
        if (empty($verifyCode) || trim($verifyCode) == "") {
            $verifyCode=ValidateHelper::randNumber();
        }
        $cacheData = Cache::get(config('zzmed.sms.cell_verify_code'). $cell);
        if ($cacheData != NULL) {
            if ($cacheData['timeOut'] > Carbon::now()) {
                throw new smException(-9000013);
            }
        }

        $msgContent = "尊敬的用户，您的微信绑定验证码为{$verifyCode}，10分钟内有效，请尽快操作。";

        if (self::Send($cell, $msgContent)) {
            $expiresAt = Carbon::now()->addMinutes(10);
            $timeOutExpiresAt = Carbon::now()->addSeconds(config('zzmed.sms.cell_verify_code_time_out'));
            Cache::put(config('zzmed.sms.cell_verify_code') . $cell, ['verifyCode'=>$verifyCode,'timeOut'=>$timeOutExpiresAt], $expiresAt);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 发送短消息验证码
     *
     * @param string $cell 手机
     * @param string $verifyCode 验证码
     *
     * @return bool
     * @throws ShortMessageException
     */
    public static function SendVerifyCodeWithoutCache($cell, $verifyCode)
    {
        if (empty($cell) || trim($cell) == "") {
            throw new smException(-1000005);
        }
        if (empty($verifyCode) || trim($verifyCode) == "") {
            throw new smException(-1000015);
        }

        $msgContent = "尊敬的用户，您的MMC通行证手机验证码为{$verifyCode}，10分钟内有效，请尽快操作。";
        if (self::Send($cell, $msgContent)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $cell
     *
     * @return bool
     */
    public static function GetVerifyCode($cell){
        $verifyCode=Cache::get(config('zzmed.sms.cell_verify_code') . $cell);
        if($verifyCode==null){
            return false;
        }else{
            return $verifyCode['verifyCode'];
        }
    }

    /**
     * @param $cell
     */
    public static function DeleteVerifyCode($cell){
        Cache::forget(config('zzmed.sms.cell_verify_code') . $cell);
    }

}