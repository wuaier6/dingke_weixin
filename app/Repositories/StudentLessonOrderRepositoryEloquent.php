<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentLessonOrderRepository;
use App\Models\StudentLessonOrder;

/**
 * Class StudentLessonOrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StudentLessonOrderRepositoryEloquent extends BaseRepository implements StudentLessonOrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentLessonOrder::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 学生定课信息
     * @param $student
     */
    public function student_order_lesson($student){

    }
}
