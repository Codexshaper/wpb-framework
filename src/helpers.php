<?php

use Codexshaper\WP\Application;
use Illuminate\Container\Container;

if (!function_exists('wpb_csrf_token')) {
    function wpb_csrf_token($action = 'wpb_nonce')
    {
        return wp_create_nonce($action);
    }
}

if (!function_exists('wpb_app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $abstract
     * @param array       $parameters
     *
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function wpb_app($abstract = null, array $parameters = [])
    {
        $app = new Application();
        if (is_null($abstract) && $container != null) {
            return $container;
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('wpb_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param array|string|null $key
     * @param mixed             $default
     *
     * @return mixed|\Illuminate\Config\Repository
     */
    function wpb_config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            return app('config')->set($key);
        }

        return app('config')->get($key, $default);
    }
}

if (!function_exists('wpb_view')) {
    function wpb_view($view, $data = [], $mergeData = [])
    {
        if (!class_exists(\CodexShaper\Blade\View::class)) {
            throw new \Exception('View not resolved. Please install View');
        }

        return (new \CodexShaper\Blade\View([__DIR__ . '/../resources/views'], __DIR__ . '/../storage/cache'))->make($view, $data = [], $mergeData = []);
    }
}
