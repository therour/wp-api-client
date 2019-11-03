<?php

namespace Therour\WpApiClient\Executor;

use GuzzleHttp\Client;
use Therour\WpApiClient\Param;
use GuzzleHttp\Exception\ClientException;

class GuzzleExecutor implements WpApiExecutor
{
    protected $baseUrl;
    protected $namespace;
    protected $version;

    public function __construct($baseUrl, $namespace, $version)
    {
        $this->baseUrl = $baseUrl;
        $this->namespace = $namespace;
        $this->version = $version;
    }

    /**
     * execute and return collection of response.
     *
     * @return \Illuminate\Support\Collection
     */
    public function execute(Param $param)
    {
        $request = $this->createClient()->get($this->buildUrl($param));
        return (string) $request->getBody();
    }

    protected function buildBaseUrl()
    {
        return $this->baseUrl.'/'.$this->namespace.'/'.$this->version;
    }

    protected function buildUrl(Param $param)
    {
        $resourceUrl = $this->buildBaseUrl().'/'.$param->getResourceName();
        return $resourceUrl.
            ($param->getId() ? '/'.$param->getId() : '?'.http_build_query($param->getAll()));
    }

    /**
     * Create a http client.
     *
     * @return \GuzzleHttp\Client
     */
    public function createClient()
    {
        return new Client();
    }
}
