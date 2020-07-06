<?php

// let"s show all errors
if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/London');
}

ini_set('display_errors', 'on');

// load composer
require './vendor/autoload.php';

// setup namespaces
use App\Router\DnsManagement;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;

// let's create our weird fancy container instance
// this will create a new function called `container`
$container = App\Container\Helper::create([
    App\Decorator\ServiceProvider::class,
    App\Driver\ServiceProvider::class,
]);

// start messing about with slim
$app = AppFactory::createFromContainer($container);

// what error logging should we have?
$app->add(new WhoopsMiddleware());

// deal with templates
$container->share('view', function () {
    $twig = Twig::create('app/templates', [
        'debug' => true,
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    return $twig;
});

$app->add(TwigMiddleware::createFromContainer($app));

// create our routes
$app->group('/', DnsManagement::class);

// run
$app->run();
