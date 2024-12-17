<?php

namespace App\Model;

use App\Model\Core\EnhancedModel;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Eloquent\Model;

class User extends EnhancedModel
{
    protected $tablename = 'users';

    public function __construct()
    {
    }
}
