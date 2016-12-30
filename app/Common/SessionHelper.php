<?php
/**
 * Created by PhpStorm.
 * User: Scott
 * Date: 2016/2/26 0026
 * Time: 11:43
 */

namespace App\Common;

use Request;

class SessionHelper
{

    public static function getUserId()
    {

        $session = Request::session();
        if ($session->isStarted()) {
            if (Request::session()->has(config('zzmed.session.user_id'))) {
                return Request::session()->get(config('zzmed.session.user_id'));
            } else {
                return 0;
            }
        }
        return 0;
    }

    public static function getUserName()
    {
        $session = Request::session();
        if ($session->isStarted()) {
            if (Request::session()->has(config('zzmed.session.user_name'))) {
                return Request::session()->get(config('zzmed.session.user_name'));
            }
            return "";
        }
        return "";
    }
}