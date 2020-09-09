<?php

namespace App\Repositories;

use App\Models\JobGroup;

class JobGroupRepository extends EloquentRepository
{
    public function getModel()
    {
        return JobGroup::class;
    }

    public function findJobGroup($jobID) {
        $w = $this->_model
            -> select (
                JobGroup::_GROUPID
            )
            -> where (JobGroup::_JOBID, $jobID)
            -> get();

        $array = array();
        foreach($w as $a) {
            array_push($array, $a->groupid);
        }
        return array_unique($array);
    }
}
