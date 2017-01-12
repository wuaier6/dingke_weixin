<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TeacherTag extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'k_teacher_tag';
    public $timestamps = false;
    protected $fillable = ['name'];
}
