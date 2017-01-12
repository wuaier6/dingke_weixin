<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Teacher extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_teacher';
    protected $fillable = ['name','headpic','province_id','city_id','district_id','address','id_card','cell','tags','subject','status'];
}
