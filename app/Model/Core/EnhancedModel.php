<?php

namespace App\Model\Core;

use Psr\Container\ContainerInterface;
use Illuminate\Database\Eloquent\Model;

abstract class EnhancedModel extends Model
{
    protected $tablename = ''; 

    protected $capsule;

    protected $util;

    public function getTable()
    {
        return $this->tablename;
    }

    public function getData()
    {
        return $this->allowedColumns;
    }

    public function createTable(ContainerInterface $container)
    {
        $this->capsule = $container->get('eloquent');

        if (!$this->capsule::schema()->hasTable($this->tablename))
        {
            $this->capsule::schema()->create($this->tablename, function ($dbtable) {
                    $dbtable->increments('id');
                    $dbtable->string('name')->unique();
                    $dbtable->string('email')->unique();
                    $dbtable->timestamps();
            });
        }
    }

    public function setUtil(ContainerInterface $container)
    {
        if($this->util === null)
        {
            $this->util = $container->get('util');
        }
    }

    public function getUtil()
    {
        return $this->util;
    }
}
