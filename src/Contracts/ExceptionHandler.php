<?php
/**
 * The file that defines the all exception methotds signatute
 * That must be implement in child class.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\Contracts;

use Throwable;

/**
 * The exception handler contracts.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
interface ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * @param \Throwable $e The throwable exception.
     *
     * @throws \Exception Throw the exception.
     *
     * @return void
     */
    public function report(Throwable $e);

    /**
     * Determine if the exception should be reported.
     *
     * @param \Throwable $e The throwable exception.
     *
     * @return bool
     */
    public function should_report(Throwable $e);

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request The app request.
     * @param \Throwable               $e       The throwable exception.
     *
     * @throws \Throwable Throw the error.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e);

    /**
     * Render an exception to the console.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output Symfony output.
     * @param \Throwable                                        $e      The throwable exception.
     *
     * @return void
     */
    public function render_for_console($output, Throwable $e);
}
