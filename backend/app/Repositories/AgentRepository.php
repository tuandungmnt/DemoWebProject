<?php

namespace App\Repositories;

use App\Models\Agent;

class AgentRepository extends EloquentRepository
{
    public function getModel()
    {
        return Agent::class;
    }


}
