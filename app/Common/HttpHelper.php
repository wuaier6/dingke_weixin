<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 2016/2/26 0026
 * Time: 13:16
 */

namespace App\Common;

use Request;

class HttpHelper
{
    public static function getIP()
    {
        return Request::ip();
    }

    public static function getFullUrl()
    {
        return Request::fullUrl();
    }

}