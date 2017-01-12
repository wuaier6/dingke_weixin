<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LocationRepository
 * @package namespace App\Repositories;
 */
interface LocationRepository extends RepositoryInterface
{
    /**
     * 省地区取得
     * @return array
     */
    public function getProvince();

    /**
     * 市地区取得
     * @param $provinceId 父级id
     * @return array
     */
    public function getCity($provinceId);

     /**
      * 地区取得
      * @param $cityId 父级id
      * @return array
      */
    public function getDistrict($cityId);
}
