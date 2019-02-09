<?php
/**
 *	The beginning of the end for all OUTRAGEweb requests.
 */


# let's show all errors
if(!ini_get("date.timezone"))
	date_default_timezone_set("UTC");

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("xdebug.var_display_max_depth", 128);


# what if Xerox wants to be secure?
define("WWW_DIR", getenv("WWW_DIR") ?: $_SERVER["DOCUMENT_ROOT"]);
define("APP_DIR", getenv("APP_DIR") ?: WWW_DIR."/app");
define("TEMPLATE_DIR", getenv("TEMPLATE_DIR") ?: APP_DIR."/templates");


# let's now use composer because i'd potentially like to use my
# framework in other places
require WWW_DIR."/vendor/autoload.php";


# get some namespaces set up
use \OUTRAGEdns\Auth\CredentialsControllerProvider;
use \OUTRAGEdns\Auth\CredentialsProvider;
use \OUTRAGEdns\Auth\PowerAdminPasswordEncoder;
use \OUTRAGEdns\Configuration\ConfigurationFactory;
use \OUTRAGEdns\Database\AdapterFactory;
use \OUTRAGEdns\Database\SqlFactory;
use \OUTRAGEdns\Entity\ControllerProvider as EntityControllerProvider;
use \OUTRAGEdns\Request\Container as RequestContainer;
use \Silex\Application;
use \Silex\Provider\SecurityServiceProvider;
use \Silex\Provider\TwigServiceProvider;
use \Symfony\Component\Cache\Simple\FilesystemCache;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Session\Session;
use \Whoops\Handler\PrettyPageHandler;
use \WhoopsSilex\WhoopsServiceProvider;
use \Zend\Db\Adapter\Adapter;


# let's mess about with silex now
$app = new Application();
$app["debug"] = true;

if(!empty($app["debug"]))
{
	$whoops = new \Whoops\Run();
	$whoops->pushHandler(new PrettyPageHandler());
	$whoops->register();

	$app->register(new WhoopsServiceProvider());
}

# do something with caching??
$app["internal.cache"] = new FilesystemCache();

# boot strap the config
$app["internal.config"] = ConfigurationFactory::createConfiguration();

# set up our DB adapter
$app["internal.database.adapter"] = AdapterFactory::createAdapter($app);
$app["internal.database.sql"] = SqlFactory::createSql($app);

# start the session
$app["internal.session"] = new Session();
$app["internal.session"]->start();

# we need somewhere to store some context data that does not fit properly
# to say, something like sessions?
$app["internal.context"] = new RequestContainer();
$app["internal.godmode"] = false;

# deal with templates
$app->register(new TwigServiceProvider(), [
	"twig.path" => TEMPLATE_DIR
]);

$app["twig"]->addExtension(new Twig_Extensions_Extension_Text());

# deal with authentication (will the session be used here??)
$app->register(new SecurityServiceProvider(), [
	"security.firewalls" => [
		"login" => [
			"pattern" => "/login/",
			"anonymous" => true,
		],
		"default" => [
			"pattern" => ".*",
			"form" => [
				"login_path" => "/login/",
				"check_path" => "/login/check/",
			],
			"users" => new CredentialsProvider($app),
		],
	],
	"security.default_encoder" => new PowerAdminPasswordEncoder(),
]);

# deal with routing
$app->mount("/", new EntityControllerProvider());
$app->mount("/", new CredentialsControllerProvider());


# and now hopefully everything has been set up, we shall go ahead and
# run everything!
$app->before(function(Request $request, Application $app) {
	$request->setSession($app["internal.session"]);
});

$app->run();