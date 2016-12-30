<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 2016/2/26 0026
 * Time: 13:16
 */

namespace App\Common;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Cache;
use Log;
class AccessTokenHelper
{

    //缓存存活时间 90分钟
    const CACHE_ACTIVE_TIME=90;

    public static function get_access_token($key='sync_access_token_key')
    {
        $access_token = Cache::get($key.config("zzmed.push_setting.client_id"));
        //调用医院接口推送数据
        if (!$access_token) {
            $client = new Client(['timeout' => 3.0]);
            $access_data['grant_type'] = config("zzmed.push_setting.grant_type");
            $access_data['client_secret'] = config("zzmed.push_setting.client_secret");
            $access_data['client_id'] = config("zzmed.push_setting.client_id");
            try {
                $result = $client->request("post",config("zzmed.push_setting.access_token_url"), ['form_params' => $access_data]);
                $data = json_decode($result->getBody()->getContents());
                if (isset($data->code) && $data->code == 1) {
                    $access_token = $data->data->access_token;
                    Cache::put($key.config("zzmed.push_setting.client_id"), $access_token, self::CACHE_ACTIVE_TIME);
                    return $access_token;
                } else {
                    return false;
                }
            } catch (RequestException $e) {
                Log::error('faild:access_token ,message:'.$e->getmessage());
                return false;
            }
        }
        return $access_token;
    }


}