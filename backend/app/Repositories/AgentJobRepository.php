<?php

namespace App\Repositories;

use App\Models\AgentJob;

class AgentJobRepository extends EloquentRepository
{
    public function getModel()
    {
        return AgentJob::class;
    }

}
