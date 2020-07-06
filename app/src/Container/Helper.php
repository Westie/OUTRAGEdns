<?php

namespace App\Container {
    use League\Container\Container;
    use Psr\Container\ContainerInterface;

    class Helper
    {
        /**
         *  Store our container.
         */
        public static $container;

        /**
         *  Create our container.
         */
        public static function create(array $serviceProviders = []): ContainerInterface
        {
            static::$container = new Container();

            foreach ($serviceProviders as $serviceProvider) {
                static::$container->addServiceProvider($serviceProvider);
            }

            return static::$container;
        }
    }
}

namespace {
    if (!function_exists('container')) {
        function container($name)
        {
            return App\Container\Helper::$container->get($name);
        }
    }
}
