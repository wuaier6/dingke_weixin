<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherTagRepository;
use App\Models\TeacherTag;

/**
 * Class TeacherTagRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeacherTagRepositoryEloquent extends BaseRepository implements TeacherTagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeacherTag::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
