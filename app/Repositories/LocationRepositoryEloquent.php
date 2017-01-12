<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LocationRepository;
use App\Models\Location;
use Cache;
use Carbon;
/**
 * Class LocationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LocationRepositoryEloquent extends BaseRepository implements LocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Location::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    protected $location_cache_key_perfix="location1";

    const CACHE_FLG=false;
    /**
     * 省
     */
    const LEVEL_PROVINCE = 0;
    /**
     * 市
     */
    const LEVEL_CITY = 1;

    /**
     * 区县
     */
    const LEVEL_DISTRICT = 2;

    /**
     * 省地区取得
     * @return array
     */
    public function getProvince()
    {
        return  $this->model->select('id', 'name as text')->where('pid',0)->orderBy('lv')->orderBy('id')->get();
        $location_data = $this->get_location();
        if (isset($location_data['province'])) {
            return array_values($location_data['province']->sub);
        }
    }

    /**
     * 市地区取得
     * @param $provinceId 父级id
     * @return array
     */
    public function getCity($provinceId)
    {
        return  $this->model->select('id', 'name as text')->where('pid',$provinceId)->orderBy('lv')->orderBy('id')->get();
        $location_data = $this->get_location();
        if (isset($location_data[$provinceId]->sub)) {
            return array_values($location_data[$provinceId]->sub);
        }
        return false;
    }

    /**
     * 地区取得
     * @param $cityId 父级id
     * @return array
     */
    public function getDistrict($cityId)
    {
        return  $this->model->select('id', 'name as text')->where('pid',$cityId)->orderBy('lv')->orderBy('id')->get();
        $location_data = $this->get_location();
        if (isset($location_data[$cityId]->sub)) {
            return array_values($location_data[$cityId]->sub);
        }
        return false;
    }

    /**
     * 数据取得
     * @return array
     */
    protected function get_location()
    {
        if (self::CACHE_FLG) {

            $location_cache_key = $this->location_cache_key_perfix . 'local_all';
            $location_list = Cache::get($location_cache_key);
            if (!$location_list) {
                $location_list = $this->get_location_data();
                Cache::forever($location_cache_key,$location_list);
            } else {
                $location_list =$location_list;
            }
            return $location_list;
        }
        return $this->get_location_data();
    }

    /**
     * 取得DB地区数据
     * @return mixed
     * @throws Z_DB_Exception
     */
    protected function get_location_data_db()
    {
        return  $this->model->orderBy('lv','desc')->orderBy('id','desc')->get();
    }

    /**
     *组装地区数据
     * @return array
     */
    protected function get_location_data()
    {
        $db_data = $this->get_location_data_db();
        foreach ($db_data as $db_data_key => $db_data_value) {
            $location_data[$db_data_value->id] = $db_data_value;
        }
        $i=0;
        foreach ($location_data as $location_data_key => $location_data_value) {
            if ($location_data_value->lv != self::LEVEL_PROVINCE) {
                if (isset($location_data[$location_data_value->pid])) {
                    if (!property_exists($location_data[$location_data_value->pid], "sub")) {
                        $location_data[$location_data_value->pid]->sub = array();
                    }
                    $location_data[$location_data_value->pid]->sub[$location_data_value->id] = clone $location_data_value;
                }
                if ($location_data_value->lv == self::LEVEL_DISTRICT) {
                    unset($location_data[$location_data_value->id]);
                }
            } else {
                if($i==0){
                    $location_data['province']=new stdClass();
                    $i++;
                }
                if (!property_exists($location_data['province'], "sub")) {
                    $location_data['province']->sub = array();
                }
                $location_data['province']->sub[$location_data_value->id] = clone $location_data_value;
            }
        }
        return $location_data;
    }

    /**
     * 清空地区缓存
     * @return mixed
     */
    protected function clean_location(){
        $location_cache_key = $this->location_cache_key_perfix . 'local_all';
        return Cache::forget($location_cache_key);
    }
}
