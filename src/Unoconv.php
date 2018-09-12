<?php

namespace Dtth\Unoconv;

use Illuminate\Support\Arr;
use Dtth\Unoconv\Commands\Convert;
use Dtth\Unoconv\Exceptions\InvalidCommand;
use Dtth\Unoconv\Contracts\Unoconv as UnoconvInterface;
use Dtth\Unoconv\Contracts\Client as ClientInterface;

class Unoconv implements UnoconvInterface
{
    /**
     * The client instance.
     *
     * @var \Dtth\Unoconv\Client
     */
    protected $client;

    /**
     * The array of commands.
     *
     * @var array
     */
    protected $commands = [
        'convert'=>Convert::class
    ];

    /**
     * Unoconv constructor.
     * 
     * @param \Dtth\Unoconv\Contracts\Client $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Convert the given file.
     *
     * @param string $input
     * @param string $output
     * @param string $format
     * @return boolean
     * @throws \Dtth\Unoconv\Exceptions\InvalidCommand
     */
    public function convert(string $input, string $output, string $format)
    {
        return $this->resolveCommand(__FUNCTION__, $input, $output, $format)->execute();
    }

    /**
     * Resolve the command.
     *
     * @param string $abstract
     * @param mixed ...$arguments
     * @return \Dtth\Unoconv\Commands\Command
     * @throws \Dtth\Unoconv\Exceptions\InvalidCommand
     */
    protected function resolveCommand(string $abstract, ...$arguments)
    {
        if (!$command = $this->getConcreteCommand($abstract)) {
            throw new InvalidCommand('The command name is invalid.');
        }

        return new $command($this->client, ...$arguments);
    }

    /**
     * Get the command class by abstract name.
     *
     * @param string $abstract
     *
     * @return string
     */
    protected function getConcreteCommand(string $abstract)
    {
        return Arr::get($this->commands, $abstract);
    }
}