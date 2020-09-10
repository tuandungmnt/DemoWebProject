<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository extends EloquentRepository
{
    public function getModel()
    {
        return Job::class;
    }

    public function findJobById($jobId) {
        return $this->_model
            ->select(
                Job::_JOBID,
                Job::_JOBNAME,
                Job::_DESCRIPTION
            )
            ->where(Job::_JOBID, $jobId)
            ->first();
    }

    public function findJobByJobName($jobName) {
        return $this->_model
            ->select(
                Job::_JOBID,
                Job::_JOBNAME,
                Job::_DESCRIPTION
            )
            ->where(Job::_JOBNAME, $jobName)
            ->first();
    }
}
