<?php
/**
 * The file handle the request event.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src/Http/Events
 */

namespace WPB\Http\Events;

/**
 * The request handler.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src/Http/Events
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class RequestHandled {

	/**
	 * The request instance.
	 *
	 * @var \Illuminate\Http\Request
	 */
	public $request;

	/**
	 * The response instance.
	 *
	 * @var \Illuminate\Http\Response
	 */
	public $response;

	/**
	 * Create a new event instance.
	 *
	 * @param \Illuminate\Http\Request  $request The app http request.
	 * @param \Illuminate\Http\Response $response The app http response.
	 *
	 * @return void
	 */
	public function __construct( $request, $response ) {
		$this->request  = $request;
		$this->response = $response;
	}
}
