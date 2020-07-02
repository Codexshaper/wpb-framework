<?php
/**
 * The database file.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src/Database
 */

namespace WPB\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * The Database class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src/Database
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class DB extends Capsule {

	/**
	 * The database instance.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      \WPB\Database\DB    $instance    The database instance.
	 */
	protected static $instance = false;

	/**
	 * Return database instance.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return null|\WPB\Database\DB
	 */
	public static function instance() {
		if ( ! static::$instance ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	/**
	 * The database constructor.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		global $wpdb;

		$this->addConnection(
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

		// Make this Capsule instance available globally.
		$this->setAsGlobal();
		// Setup the Eloquent ORM.
		$this->bootEloquent();
	}
}
