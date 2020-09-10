<?php

namespace App\Repositories;

use App\Models\Agent;

class AgentRepository extends EloquentRepository
{
    public function getModel()
    {
        return Agent::class;
    }

    public function findAgentById($userId) {
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

    public function findAgentByUsernameAndPassword($username, $password) {
        return $this->_model
            ->select(
                Agent::_USERID,
                Agent::_USERNAME,
                Agent::_PASSWORD,
                Agent::_EMAIL,
                Agent::_PHONE,
                Agent::_STATUS
            )
            ->where(Agent::_USERNAME, $username)
            ->where(Agent::_PASSWORD, $password)
            ->first();
    }

    public function findAgentByUsername($username) {
        return $this->_model
            ->select(
                Agent::_USERID,
                Agent::_USERNAME,
                Agent::_PASSWORD,
                Agent::_EMAIL,
                Agent::_PHONE,
                Agent::_STATUS
            )
            ->where(Agent::_USERNAME, $username)
            ->first();
    }

    public function findAgentByPhone($phone) {
        return $this->_model
            ->select(
                Agent::_USERID,
                Agent::_USERNAME,
                Agent::_PASSWORD,
                Agent::_EMAIL,
                Agent::_PHONE,
                Agent::_STATUS
            )
            ->where(Agent::_PHONE, $phone)
            ->first();
    }

    public function findAgentByEmail($email) {
        return $this->_model
            ->select(
                Agent::_USERID,
                Agent::_USERNAME,
                Agent::_PASSWORD,
                Agent::_EMAIL,
                Agent::_PHONE,
                Agent::_STATUS
            )
            ->where(Agent::_EMAIL, $email)
            ->first();
    }
}
