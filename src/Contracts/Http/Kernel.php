<?php
/**
 * The file handle the request.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\Contracts\Http;

/**
 * The request handler contract.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
interface Kernel
{
    /**
     * Bootstrap the application for HTTP requests.
     *
     * @return void
     */
    public function bootstrap();

    /**
     * Handle an incoming HTTP request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The app http request.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request);

    /**
     * Perform any final actions for the request lifecycle.
     *
     * @param \Symfony\Component\HttpFoundation\Request  $request  The app http request.
     * @param \Symfony\Component\HttpFoundation\Response $response The app http response.
     *
     * @return void
     */
    public function terminate($request, $response);

    /**
     * Get the Laravel application instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function get_application();
}
