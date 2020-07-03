<?php
/**
 * The file handle route facade.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src/Support/Facades
 */

namespace WPB\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The config class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src/Support/Facades
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Route extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return \WPB\Router::class;
	}
}
