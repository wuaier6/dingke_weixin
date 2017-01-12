<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassLessonRepository;
use App\Models\ClassLesson;

/**
 * Class ClassLessonRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ClassLessonRepositoryEloquent extends BaseRepository implements ClassLessonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ClassLesson::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
