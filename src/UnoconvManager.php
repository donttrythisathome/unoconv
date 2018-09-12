<?php

namespace Dtth\Unoconv;

use Illuminate\Foundation\Application;
use Dtth\Unoconv\Contracts\UnoconvManager as UnoconvManagerInterface;

class UnoconvManager implements UnoconvManagerInterface
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The Unoconv instance.
     *
     * @var \Dtth\Unoconv\Unoconv
     */
    protected $instance;

    /**
     * UnoconvManager constructor.
     * 
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get the Unoconv instance.
     *
     * @return \Dtth\Unoconv\Unoconv
     */
    public function getInstance()
    {
        return isset($this->instance)
            ? $this->instance
            : $this->instance = $this->resolve();
    }

    /**
     * Resolve the Unoconv instance.
     *
     * @return \Dtth\Unoconv\Unoconv
     */
    protected function resolve()
    {
        return new Unoconv($this->getClient());
    }


    /**
     * Get the client instance.
     *
     * @return \Dtth\Unoconv\Client
     */
    protected function getClient()
    {
        return new Client($this->getHttpClient());
    }

    /**
     * Get the Guzzle Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        return $this->app->makeWith('\GuzzleHttp\Client', [
            'config' => [
                'base_uri' => $this->config('host'),
            ]
        ]);
    }

    /**
     * Get the Unoconv config.
     *
     * @param string|null $offset
     *
     * @return string|array
     */
    protected function config(string $offset = null)
    {
        return $this->app['config']["unoconv.{$offset}"];
    }

    /**
     * Dynamically call the Unoconv instance.
     *
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->getInstance()->{$method}(...$parameters);
    }
}