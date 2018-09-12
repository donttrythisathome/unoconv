<?php

namespace Dtth\Unoconv;

use Dtth\Unoconv\Commands\Command;
use \Dtth\Unoconv\Contracts\Client as ClientInterface;

class Client implements ClientInterface
{
    /**
     * The http client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Execute the given command.
     *
     * @param \Dtth\Unoconv\Commands\Command $command
     * @return boolean
     */
    public function executeCommand(Command $command)
    {
        $this->client->post($command->getFormat(),[
            'multipart'=>[
                [
                    'name'=>'file',
                    'contents'=>fopen($command->getFile(),'r')
                ]
            ],
            'sink'=>$command->getOutput()
        ]);

        return file_exists($command->getOutput());
    }
}