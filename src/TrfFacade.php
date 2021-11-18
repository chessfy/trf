<?php

namespace Chessfy\Trf;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chessfy\Trf\Trf
 */
class TrfFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'trf';
    }
}
