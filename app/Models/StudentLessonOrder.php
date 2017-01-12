<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class StudentLessonOrder extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_sudent_orderlesson';

    protected $fillable = ['company_id','student_id','lesson_id','status'];

}
