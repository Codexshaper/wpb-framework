<?php
/**
 * The file handle the errors.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/app/Exceptions
 */

namespace WPB\App\Exceptions;

use WPB\Exceptions\Handler as ExceptionHandler;
use Throwable;

/**
 * The exception handler.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/app/Exceptions
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dont_report = array();

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dont_flash = array(
		'password',
		'password_confirmation',
	);

	/**
	 * Report or log an exception.
	 *
	 * @param  \Throwable $exception The throwable exception.
	 * @return void
	 *
	 * @throws \Exception Throw the exception.
	 */
	public function report( Throwable $exception ) {
		parent::report( $exception );
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request The app http request.
	 * @param  \Throwable               $exception The throwable exception.
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Throwable Throw the nexception.
	 */
	public function render( $request, Throwable $exception ) {
		return parent::render( $request, $exception );
	}
}
