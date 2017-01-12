<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WechatLbs extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;
    protected $table = 'k_wechat_lbs';
    protected $fillable = ['openid','Latitude','Longitude','Precision','Geohash','create_time'];
}
