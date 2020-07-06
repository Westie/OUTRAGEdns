<?php

namespace App\Driver;

use App\Driver\Driver\Api;
use App\PowerDns\Api\Authentication\APIKeyHeaderAuthentication;
use App\PowerDns\Api\Client;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{
    /**
     *  Provides
     */
    protected $provides = [
        Client::class,
        DriverInterface::class,
    ];

    /**
     *  Register our services
     */
    public function register()
    {
        $container = $this->getContainer();

        $container->share(Client::class, function () use ($container) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('http://powerdns:8081/api/v1');

            $plugins = [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
                (new APIKeyHeaderAuthentication('changeme'))->getPlugin(),
            ];

            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);

            return Client::create($httpClient);
        });

        $container->share(DriverInterface::class, function () use ($container) {
            return new Api($container);
        });
    }
}
