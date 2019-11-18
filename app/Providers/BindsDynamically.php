<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

trait BindsDynamically
{
    protected $connection = null;
    protected $table = null;

    public function bind(string $connection=env('DB_CONNECTION'), string $table)
    {

       $this->setConnection($connection);
       $this->setTable($table);
    }

    public function newInstance($attributes = [], $exists = false)
    {
       // Overridden in order to allow for late table binding.

       $model = parent::newInstance($attributes, $exists);
       $model->setTable($this->table);

       return $model;
    }

}