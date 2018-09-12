<?php

namespace Dtth\Unoconv\Contracts;

use Dtth\Unoconv\Commands\Command;

interface Client
{
    /**
     * Execute the give command.
     *
     * @param Command $command
     * @return boolean
     */
    public function executeCommand(Command $command);
}