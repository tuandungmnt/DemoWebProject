<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository extends EloquentRepository
{
    public function getModel()
    {
        return Job::class;
    }

    public function findJob($jobId) {
        return $this->_model
            ->select(
                Job::_JOBNAME,
                Job::_DESCRIPTION
            )
            ->where(Job::_JOBID, $jobId)
            ->first();
    }
}
