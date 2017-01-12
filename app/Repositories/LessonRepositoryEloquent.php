<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LessonRepository;
use App\Models\Lesson;
use DB;

/**
 * Class LessonRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LessonRepositoryEloquent extends BaseRepository implements LessonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lesson::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function lesson_list()
    {
        $sql = <<<SQLCODE
            SELECT
                l.*, t. NAME AS teacher_name,lr.name as room_name
            FROM
                k_lesson l
            LEFT JOIN k_teacher t ON l.teacher_id = t.id
            left join k_lesson_room lr on l.room_id=lr.id
            order by l.start_time desc
SQLCODE;
        return DB::select($sql);
    }

    /**
     * 当前时间段 老师或者教室是否有空
     * @param $company_id
     * @param $start_time
     * @param $end_time
     * @param $room_id
     * @param $teacher_id
     * @return mixed
     */
    public function lesson_isexist($start_time, $end_time, $room_id, $teacher_id,$lesson_id=false)
    {
        $data= DB::table('k_lesson')
            ->where('start_time', ">=", $start_time)
            ->where('end_time', "<=", $end_time)
            ->Where(function ($query)use($room_id,$teacher_id) {
                $query->where('room_id', $room_id)
                    ->orwhere('teacher_id', $teacher_id);
            })
            ->Where(function ($query)use($lesson_id) {
                if($lesson_id){
                    $query->where('id',"<>" ,$lesson_id);
                }
            })
            ->count();

        if ($data) {
            return true;
        }
        return false;
    }
}
