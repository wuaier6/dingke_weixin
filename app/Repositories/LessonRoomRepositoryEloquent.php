<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LessonRoomRepository;
use App\Models\LessonRoom;

/**
 * Class LessonRoomRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LessonRoomRepositoryEloquent extends BaseRepository implements LessonRoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessonRoom::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
