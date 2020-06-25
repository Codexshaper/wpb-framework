<?php

namespace WPB;

use WPB\App\User;
use CodexShaper\Database\Database;
use CodexShaper\Database\Facades\DB;
use WPB\Support\Facades\Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

class Application
{
    /**
     * @var app
     */
    protected $app = null;

    /**
     * @var config
     */
    protected $config;

    /**
     * @var db
     */
    protected $db;

    /**
     * @var options
     */
    protected $options;

    /**
     * @var root
     */
    protected $root;

    public function __construct($options = [], ContainerInterface $container = null)
    {
        $this->options = $options;
        
        $this->app = $container;

        if (is_null($this->app)) {
            $this->app = new Container();
            Facade::setFacadeApplication($this->app);
            $this->app->instance(ContainerInterface::class, $this->app);
        }

        $this->app['app'] = $this->app;

        $this->root = __DIR__ . '/../../../../';

        if (! empty($this->options) && isset($this->options['paths']['root'])) {
            $this->root = rtrim($this->options['paths']['root'], "/") . '/';
        }

        if (!isset($this->app['root'])) {
            $this->app['root'] = $this->root;
        }

        $this->config = new Config($this->options);

        $this->setupEnv();
        $this->registerConfig();
        $this->setupDatabase();
        $this->registerProviders();
        $this->registerRequest();
        $this->registerRouter();
        $this->loadRoutes($this->app['router']);
    }

    public function getInstance()
    {
        if (!$this->app) {
            return new self();
        }

        return $this->app;
    }

    protected function setupEnv()
    {
        $this->app['env'] = $this->config->get('app.env');
    }

    protected function registerConfig()
    {
        $this->app->bind('config', function () {
            return [
                'app'           => $this->config->get('app'),
                'view.paths'    => $this->config->get('view.paths'),
                'view.compiled' => $this->config->get('view.compiled'),
            ];
        }, true);
    }

    protected function setupDatabase()
    {
        global $wpdb;

        $this->db = new Database([
            'driver'            => 'mysql',
            'host'               => $wpdb->dbhost,
            'database'        => $wpdb->dbname,
            'username'        => $wpdb->dbuser,
            'password'        => $wpdb->dbpassword,
            'prefix'          => $wpdb->prefix,
            'charset'            => $wpdb->charset,
            'collation'     => $wpdb->collate,
        ]);

        $this->db->run();

        $this->app->singleton('db', function () {
            return $this->db;
        });
    }

    protected function registerProviders()
    {
        $providers = $this->config->get('app.providers');

        if( $providers && count($providers) > 0) {
            foreach ($providers as $provider) {
                with(new $provider($this->app))->register();
            }
        }
    }

    protected function registerRequest()
    {
        $this->app->bind(Request::class, function ($app) {
            $request = Request::capture();

            if ($wp_user = wp_get_current_user()) {
                $user = User::find($wp_user->ID);
                $request->merge(['user' => $user]);
                $request->setUserResolver(function () use ($user) {
                    return $user;
                });
            }

            return $request;
        });
    }

    protected function registerRouter()
    {
        $this->app['router'] = new \Illuminate\Routing\Router($this->app['events']);
        $this->app->instance(\Illuminate\Routing\Router::class, $this->app['router']);  
        $this->app->alias('Route', \WPB\Support\Facades\Route::class);
    }

    public function loadRoutes($router, $dir = null)
    {
        if (!$dir) {
            $dir =  __DIR__ . '/../routes/';
        }

        require $dir.'web.php';

        $router->group(['prefix' => 'api'], function () use ($dir, $router) {
            require $dir.'api.php';
        });
    }
}
