<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ModelSaverFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'model-saver';
    }
}

