<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ClassStudent extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_class_student';
    protected $fillable = ['company_id','class_id','student_id'];

}
