<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassRepository;
use App\Models\Class;

/**
 * Class ClassRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ClassRepositoryEloquent extends BaseRepository implements ClassRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Class::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
