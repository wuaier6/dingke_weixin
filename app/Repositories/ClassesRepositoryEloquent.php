<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassesRepository;
use App\Models\Classes;
use App\Validators\ClassesValidator;

/**
 * Class ClassesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ClassesRepositoryEloquent extends BaseRepository implements ClassesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
