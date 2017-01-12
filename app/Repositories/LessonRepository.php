<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LessonRepository
 * @package namespace App\Repositories;
 */
interface LessonRepository extends RepositoryInterface
{
    public function lesson_list();

    /**
     * 当前时间段 老师或者教室是否有空
     * @param $company_id
     * @param $start_time
     * @param $end_time
     * @param $room_id
     * @param $teacher_id
     * @return mixed
     */
    public function lesson_isexist( $start_time, $end_time, $room_id, $teacher_id,$lesson_id=false);
}
