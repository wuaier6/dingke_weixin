<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Lesson extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_lesson';
    protected $fillable = ['company_id','name','type','room_id','start_time','end_time','teacher_id','limit','tags'];

}


