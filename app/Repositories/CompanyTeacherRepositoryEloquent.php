<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherRepository;
use App\Models\CompanyTeacher;

/**
 * Class CompanyTeacherRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CompanyTeacherRepositoryEloquent extends BaseRepository implements CompanyTeacherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompanyTeacher::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
