<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * 地区
 * Class Location
 * @package App\Models
 */
class Location extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'k_location';

    public $timestamps = false;

    protected $fillable = ['name','pid','lv','status'];

}
