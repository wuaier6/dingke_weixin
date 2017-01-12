<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherSubjectRepository;
use App\Models\TeacherSubject;

/**
 * Class TeacherSubjectRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeacherSubjectRepositoryEloquent extends BaseRepository implements TeacherSubjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeacherSubject::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
