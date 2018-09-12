<?php

namespace Dtth\Unoconv\Facades;

use Illuminate\Support\Facades\Facade;

class Unoconv extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'unoconv';
    }
}