<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyStudent extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_company_student';

    protected $fillable = ['company_id','student_id','status'];
}

