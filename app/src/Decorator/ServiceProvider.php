<?php

namespace App\Decorator;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{
    /**
     *  Provides
     */
    protected $provides = [
        Rdata::class,
    ];

    /**
     *  Register our services
     */
    public function register()
    {
        $container = $this->getContainer();

        $container->share(Rdata::class, function () {
            return new Rdata();
        });
    }
}
