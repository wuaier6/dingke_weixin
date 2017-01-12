<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherWechatUserRepository;
use App\Models\TeacherWechatUser;

/**
 * Class TeacherWechatUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeacherWechatUserRepositoryEloquent extends BaseRepository implements TeacherWechatUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeacherWechatUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
