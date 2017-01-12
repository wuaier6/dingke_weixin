<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeacherRepository
 * @package namespace App\Repositories;
 */
interface TeacherRepository extends RepositoryInterface
{

    public function get_teacher_list($company_id);

}
