<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonRoom extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_lesson_room';

    protected $fillable = ['company_id','name','limit'];

}
