<?php

namespace Therour\WpApiClient\Executor;

use GuzzleHttp\Client;
use Therour\WpApiClient\Contracts\WpApiExecutor;
use Therour\WpApiClient\Contracts\ExecutableParam;

class GuzzleExecutor implements WpApiExecutor
{
    /**
     * Http client.
     *
     * @var \GuzzleHttp\Client
     */

    protected $client;

    /**
     * base wp rest api uri
     *
     * @var string
     */
    protected $baseUri;

    /**
     * namespace of wp rest api.
     *
     * @var string
     */
    protected $namespace;

    /**
     * version of wp rest api.
    *
    * @var string
    */
    protected $version;

    /**
     * Create an executor class.
     *
     * @param \GuzzleHttp\Client $client
     * @param array $config
     */
    public function __construct(Client $client, $config = [])
    {
        $this->client = $client;
        $this->baseUrl = $config['base_url'];
        $this->namespace = $config['namespace'];
        $this->version = $config['version'];
    }

    /**
     * execute and return collection of response.
     *
     * @return \Illuminate\Support\Collection
     */
    public function execute(ExecutableParam $param)
    {
        $request = $this->client->get($url = $this->buildUrl($param));
        return (string) $request->getBody();
    }

    /**
     * Build base api url.
     *
     * @return string
     */
    protected function buildBaseUrl()
    {
        return $this->baseUrl.'/'.$this->namespace.'/'.$this->version;
    }

    /**
     * Build api resource rest url.
     *
     * @param \Therour\WpApiClient\Contracts\ExecutableParam $param
     * @return string
     */
    protected function buildUrl(ExecutableParam $param)
    {
        $resourceUrl = $this->buildBaseUrl().'/'.$param->getResourceName();
        return $resourceUrl.
            ($param->getId() ? '/'.$param->getId() : '?'.http_build_query($param->getParameters()));
    }
}
