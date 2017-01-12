<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyTeacher extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_company_teacher';
    protected $fillable = ['company_id','teacher_id','status'];

}
