<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StudentLessonOrderRepository
 * @package namespace App\Repositories;
 */
interface StudentLessonOrderRepository extends RepositoryInterface
{
    public function student_order_lesson($student);
}
