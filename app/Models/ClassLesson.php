<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ClassLesson extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_class_lesson';
    protected $fillable = ['company_id','class_id','lesson_tag_id'];

}
