<?php

namespace Dtth\Unoconv\Commands;

use Dtth\Unoconv\Contracts\Client;

abstract class Command
{
    /**
     * The format to convert the file.
     *
     * @var string
     */
    protected $format;

    /**
     * File path.
     *
     * @var string
     */
    protected $file;

    /**
     * Output directory.
     *
     * @var string
     */
    protected $output;

    /**
     * The client instance.
     *
     * @var \Dtth\Unoconv\Contracts\Client
     */
    protected $client;

    /**
     * Command constructor.
     *
     * @param \Dtth\Unoconv\Contracts\Client $client
     */
    public function __construct(Client $client, string $file, string $output, string $format)
    {
        $this->file = $file;
        $this->output = $output;
        $this->format = $format;
        $this->client = $client;
    }

    /**
     * The file property accessor.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * The format field accessor.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * The output property accessor.
     *
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Execute command.
     *
     * @return boolean
     */
    public function execute()
    {
        return $this->client->executeCommand($this);
    }
}