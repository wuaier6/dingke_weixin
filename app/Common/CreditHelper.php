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
use Log;
class CreditHelper
{

    public static function Send($user_id,$type,$company_type=0)
    {
        $client = new Client(['timeout' => 3.0]);
        $data['user_id']=$user_id;
        $data['integral_type']=$type;
        $data['company_type']=$company_type;
        try {
            $result = $client->request("post",config("zzmed.CREDIT.CREDIT_URL"), ['form_params' => $data]);
            return true;
        } catch (RequestException $e) {
            Log::info('faild:credit ,message:'.$e->getmessage());
            return false;
        }
    }


}