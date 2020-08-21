<?php

namespace App\Repositories;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function find($id)
    {
        return $result = $this->_model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    public function insertGetId(array $attributes)
    {
        return $this->_model->insertGetId($attributes);
    }

    public function save(array $attributes)
    {
        return $this->_model->save($attributes);
    }

    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    public function countAll()
    {
        return $this->_model->count();
    }
}
