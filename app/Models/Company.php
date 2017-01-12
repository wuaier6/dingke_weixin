<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_company';

    protected $fillable = ['company_id','user_id','name','cell','tags','province_id','city_id','district_id','address','business_licence','business_entity','company_type','id_card','status','open'];
}
