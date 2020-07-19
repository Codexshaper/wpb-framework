<?php
/**
 * The bootstrap file.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src
 */

namespace WPB;

use WPB\App\User;
use CodexShaper\Database\Database;
use CodexShaper\Database\Facades\DB;
use WPB\Support\Facades\Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * The Application class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Application {

	/**
	 * The app container.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      \Illuminate\Contracts\Container\Container    $app    The app container.
	 */
	protected $app = null;

	/**
	 * The config.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      \WPB\Support\Facades\Config    $config    The config.
	 */
	protected $config;

	/**
	 * The database manager.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      \CodexShaper\Database\Database    $db    The database manager.
	 */
	protected $db;

	/**
	 * The default options.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options    The default options.
	 */
	protected $options;

	/**
	 * This string unique root path.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $root    This string unique root path.
	 */
	protected $root;

	/**
	 * The application factory.
	 *
	 * @since    1.0.0
	 * @param array                                                           $options The site options.
	 * @param \Illuminate\Contracts\Container\Container as ContainerInterface $container The app container.
	 *
	 * @return void
	 */
	public function __construct( $options = array(), ContainerInterface $container = null ) {
		$this->options = $options;

		$this->app = $container;

		if ( is_null( $this->app ) ) {
			$this->app = new Container();
			Facade::setFacadeApplication( $this->app );
			$this->app->instance( ContainerInterface::class, $this->app );
		}

		$this->app['app'] = $this->app;

		$this->root = __DIR__ . '/../../../../';

		if ( ! empty( $this->options ) && isset( $this->options['paths']['root'] ) ) {
			$this->root = rtrim( $this->options['paths']['root'], '/' ) . '/';
		}

		if ( ! isset( $this->app['root'] ) ) {
			$this->app['root'] = $this->root;
		}

		$this->config = new Config( $this->options );

		$this->setup_env();
		$this->register_config();
		$this->setup_database();
		$this->register_providers();
		$this->register_request();
		$this->register_instances();
		$this->load_routes( $this->app['router'] );
	}

	/**
	 * Get the app container.
	 *
	 * @since    1.0.0
	 *
	 * @return \Illuminate\Container\Container
	 */
	public function get_instance() {
		if ( ! $this->app ) {
			new self();
		}

		return $this->app;
	}

	/**
	 * Setup the env.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function setup_env() {
		$this->app['env'] = $this->config->get( 'app.env' );
	}

	/**
	 * Register config.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function register_config() {
		$this->app->bind(
			'config',
			function () {
				return array(
					'app'           => $this->config->get( 'app' ),
					'view.paths'    => $this->config->get( 'view.paths' ),
					'view.compiled' => $this->config->get( 'view.compiled' ),
				);
			},
			true
		);
	}

	/**
	 * Setup the database.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function setup_database() {
		global $wpdb;

		$this->db = new Database(
			array(
				'driver'    => 'mysql',
				'host'      => $wpdb->dbhost,
				'database'  => $wpdb->dbname,
				'username'  => $wpdb->dbuser,
				'password'  => $wpdb->dbpassword,
				'prefix'    => $wpdb->prefix,
				'charset'   => $wpdb->charset,
				'collation' => $wpdb->collate,
			)
		);

		$this->db->run();

		$this->app->singleton(
			'db',
			function () {
				return $this->db;
			}
		);
	}

	/**
	 * Register providers.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function register_providers() {
		$providers = $this->config->get( 'app.providers' );

		if ( $providers && count( $providers ) > 0 ) {
			foreach ( $providers as $provider ) {
				with( new $provider( $this->app ) )->register();
			}
		}
	}

	/**
	 * Register request.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function register_request() {
		$this->app->bind(
			'request',
			function ( $app ) {
				$request = Request::capture();
				$wp_user = wp_get_current_user();
				if ( $wp_user ) {
					$user = User::find( $wp_user->ID );
					$request->merge( array( 'user' => $user ) );
					$request->setUserResolver(
						function () use ( $user ) {
							return $user;
						}
					);
				}

				return $request;
			}
		);
	}

	/**
	 * Register router.
	 *
	 * @since    1.0.0
	 *
	 * @return void
	 */
	protected function register_instances() {
		$this->app->instance( \Illuminate\Http\Request::class, $this->app['request'] );
		$this->app->instance( \Illuminate\Routing\Router::class, $this->app['router'] );
		$this->app->instance( \WPB\Router::class, $this->app['router'] );
		$this->app->instance( \Illuminate\Contracts\View\Factory::class, $this->app['view'] );
		$this->app->instance( \Illuminate\Contracts\Routing\UrlGenerator::class, $this->app['url'] );
		$this->app->alias( 'Route', \WPB\Support\Facades\Route::class );
	}

	/**
	 * Get the config value.
	 *
	 * @since    1.0.0
	 * @param \Illuminate\Routing\Router $router The app router.
	 * @param string                     $dir The custom routes directory.
	 *
	 * @return void
	 */
	public function load_routes( $router, $dir = null ) {
		if ( ! $dir ) {
			$dir = __DIR__ . '/../routes/';
		}

		require $dir . 'web.php';

		$router->group(
			array( 'prefix' => 'api' ),
			function () use ( $dir, $router ) {
				require $dir . 'api.php';
			}
		);
	}
}
