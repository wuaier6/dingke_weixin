<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyTag extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_company_tag';
    public $timestamps = false;
    protected $fillable = ['name'];

}
