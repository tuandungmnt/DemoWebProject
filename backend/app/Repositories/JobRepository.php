<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository extends EloquentRepository
{
    public function getModel()
    {
        return Job::class;
    }

}
