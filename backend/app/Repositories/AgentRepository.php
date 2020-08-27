<?php

namespace App\Repositories;

use App\Models\Agent;

class AgentRepository extends EloquentRepository
{
    public function getModel()
    {
        return Agent::class;
    }

    public function findAgent($userId) {
        return $this->_model
            ->select(
                Agent::_USERNAME,
                Agent::_PASSWORD,
                Agent::_EMAIL,
                Agent::_PHONE,
                Agent::_STATUS
            )
            ->where(Agent::_USERID, $userId)
            ->first();
    }

}
