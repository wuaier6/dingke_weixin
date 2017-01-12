<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherRepository;
use App\Models\Teacher;
use DB;
/**
 * Class TeacherRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeacherRepositoryEloquent extends BaseRepository implements TeacherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teacher::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function get_teacher_list($company_id){
        $sql = <<<SQLCODE
			SELECT
                t.*
			FROM
				k_teacher t
				inner join k_company_teacher ct on t.id=ct.teacher_id
			WHERE
				ct.company_id =?
				and t.status=1
SQLCODE;
        $array[] = $company_id;
        return  DB::select($sql, $array);
    }
}
