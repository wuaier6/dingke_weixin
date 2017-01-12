<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TeacherWechatUser extends BaseModel implements Transformable
{
    use TransformableTrait;


    protected $fillable = ['teacher_id','openid'];
    protected $table = 'k_teacher_wechat_user';
}
