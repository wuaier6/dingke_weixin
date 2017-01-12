<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TeacherSubject extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_teacher_subject';
    public $timestamps = false;
    protected $fillable = ['name'];
}
