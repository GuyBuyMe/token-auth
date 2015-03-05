<?php

namespace Igorgoroshit\TokenAuth\Facades;

use Illuminate\Support\Facades\Facade;


class TokenAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'igorgoroshit.token.auth';
    }
}
