<?php

namespace App\Traits;

trait TableNameDynamic
{
    protected $connection = null;
    protected $table = null;

    public function bind(string $table)
    {
        $this->setConnection(env('DB_CONNECTION', 'pgsql'));
        $this->setTable($table);
    }

    public function newInstance($attributes = [], $exists = false): self
    {
        // Overridden in order to allow for late table binding.

        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);

        return $model;
    }

}
