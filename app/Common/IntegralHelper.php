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
class IntegralHelper
{

    public static function Push_Integral($user_id,$Integral_type,$company_id)
    {
        $data['user_id']=$user_id;
        $data['integral_type']=$integral_type;
        $data['company_type']=$company_type;
        $client = new Client(['timeout' => 3.0]);
        try {
            $result = $client->request("post",config("zzmed.Integral.INTEGRAL_URL"), ['form_params' => $data]);
            $data = json_decode($result->getBody()->getContents());
            if (isset($data->code) && $data->code == 1) {
                return true;
            } else {
                return false;
            }
        } catch (RequestException $e) {
            Log::info('faild:Push_Integral ,message:'.$e->getmessage());
            return false;
        }
    }

}