<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Class extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_class';
    protected $fillable = ['company_id', 'teacher_id', 'name'];
}