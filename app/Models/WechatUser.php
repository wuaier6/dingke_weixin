<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class WechatUser extends BaseModel  implements Transformable
{
    use TransformableTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'k_wechat_user';

}
