<?php

namespace Dtth\Unoconv\Contracts;

interface UnoconvManager
{
    /**
     * Get the Unoconv instance.
     *
     * @return \Dtth\Unoconv\Unoconv;
     */
    public function getInstance();
}