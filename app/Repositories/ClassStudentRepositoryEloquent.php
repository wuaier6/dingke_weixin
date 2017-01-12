<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassStudentRepository;
use App\Models\ClassStudent;

/**
 * Class ClassStudentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ClassStudentRepositoryEloquent extends BaseRepository implements ClassStudentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ClassStudent::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
