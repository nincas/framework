<?php

namespace Framework\Kernel;

use Symfony\Component\Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Framework\Kernel\Router;
use \Exception;

use Illuminate\Database\Capsule\Manager as DB;

use Framework\Models\Users;
/**
 * summary
 */
Class Config
{
    /**
     * @author onin
     */
    public function __construct()
    {
        $env = dirname(__DIR__) . '\.env';
        (new Dotenv)->load($env);
        date_default_timezone_set(getenv('TIMEZONE'));

        try {
            $db = new Manager;
            $db->addConnection([
                'driver'    => getenv('DB_DRIVER'),
                'host'      => getenv('DB_HOST'),
                'database'  => getenv('DB_NAME'),
                'username'  => getenv('DB_USER'),
                'password'  => getenv('DB_PASS'),
                'charset'   => getenv('DB_CHARSET'),
                'collation' => getenv('DB_COLLATION'),
                'prefix'    => getenv('DB_PREFIX')
            ]);

            $db->setEventDispatcher(new Dispatcher(new Container));
            $db->setAsGlobal();
            $db->bootEloquent();
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function run()
    {
        $route = new Router;
        require_once dirname(__DIR__).'/routes.php';
        $route->boot();
    }
}
