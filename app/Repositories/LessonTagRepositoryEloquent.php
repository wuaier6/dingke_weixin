<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LessonTagRepository;
use App\Models\LessonTag;

/**
 * Class LessonTagRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LessonTagRepositoryEloquent extends BaseRepository implements LessonTagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessonTag::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
