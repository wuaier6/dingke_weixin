<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonTag extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_lesson_tag';

    protected $fillable = ['company_id','name','type','pid'];
}
