<?php

namespace App\Repositories;

use App\Models\AgentJob;

class AgentJobRepository extends EloquentRepository
{
    public function getModel()
    {
        return AgentJob::class;
    }

    public function findAgentJob($userID) {
        $w = $this->_model
            -> select (
                AgentJob::_JOBID
            )
            -> where (AgentJob::_USERID, $userID)
            -> get();

        $array = array();
        foreach($w as $a) {
            array_push($array, $a->jobid);
        }
        return array_unique($array);
    }
}
