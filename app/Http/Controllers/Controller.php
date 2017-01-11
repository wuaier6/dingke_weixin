<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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

}
