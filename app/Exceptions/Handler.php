<?php
/**
 * The file handle the errors.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\App\Exceptions;

use Throwable;
use WPB\Exceptions\Handler as ExceptionHandler;

/**
 * The exception handler.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dont_report = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dont_flash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception The throwable exception.
     *
     * @throws \Exception Throw the exception.
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request   The app http request.
     * @param \Throwable               $exception The throwable exception.
     *
     * @throws \Throwable Throw the nexception.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
