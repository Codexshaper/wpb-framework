<?php
/**
 * The all functions.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 */

use Codexshaper_Pwa\Application;
use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Routing\UrlGenerator;
// use Illuminate\Foundation\Bus\PendingDispatch;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;

if ( ! function_exists( 'wpb_csrf_token' ) ) {
	/**
	 * Generate wp nonce.
	 *
	 * @param string|null $action   This is the nonce action name.
	 *
	 * @return null|string
	 */
	function wpb_csrf_token( $action = 'wpb_nonce' ) {
		return wp_create_nonce( $action );
	}
}

if ( ! function_exists( 'wpb_config' ) ) {
	/**
	 * Get / set the specified configuration value.
	 *
	 * If an array is passed as the key, we will assume you want to set an array of values.
	 *
	 * @param array|string|null $key This is the key for config array.
	 * @param mixed             $default This is the default config value.
	 *
	 * @return mixed|\Illuminate\Config\Repository
	 */
	function wpb_config( $key = null, $default = null ) {
		if ( is_null( $key ) ) {
			return app( 'config' );
		}

		if ( is_array( $key ) ) {
			return app( 'config' )->set( $key );
		}

		return app( 'config' )->get( $key, $default );
	}
}

if ( ! function_exists( 'wpb_view' ) ) {
	/**
	 * Render blade view.
	 *
	 * @param string $view   This is the filename.
	 * @param array  $data   This is the view data.
	 * @param array  $merge_data   This is the merge data for view.
	 *
	 * @throws \Exception This will throw an exception if view class doesn't exists.
	 * @return null|string
	 */
	function wpb_view( $view, $data = array(), $merge_data = array() ) {
		if ( ! class_exists( \CodexShaper\Blade\View::class ) ) {
			throw new \Exception( 'View not resolved. Please install View' );
		}

		return ( new \CodexShaper\Blade\View( array( __DIR__ . '/../resources/views' ), __DIR__ . '/../storage/cache' ) )->make( $view, $data = array(), $merge_data = array() );
	}
}

if (! function_exists('wpb_abort')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  \Symfony\Component\HttpFoundation\Response|int     $code
     * @param  string  $message
     * @param  array   $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function wpb_abort($code, $message = '', array $headers = [])
    {
        if ($code instanceof Response) {
            throw new HttpResponseException($code);
        } elseif ($code instanceof Responsable) {
            throw new HttpResponseException($code->toResponse(request()));
        }

        wpb_app()->abort($code, $message, $headers);
    }
}

if (! function_exists('wpb_abort_if')) {
    /**
     * Throw an HttpException with the given data if the given condition is true.
     *
     * @param  bool    $boolean
     * @param  int     $code
     * @param  string  $message
     * @param  array   $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function wpb_abort_if($boolean, $code, $message = '', array $headers = [])
    {
        if ($boolean) {
            wpb_abort($code, $message, $headers);
        }
    }
}

if (! function_exists('wpb_abort_unless')) {
    /**
     * Throw an HttpException with the given data unless the given condition is true.
     *
     * @param  bool    $boolean
     * @param  int     $code
     * @param  string  $message
     * @param  array   $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function wpb_abort_unless($boolean, $code, $message = '', array $headers = [])
    {
        if (! $boolean) {
            wpb_abort($code, $message, $headers);
        }
    }
}

if (! function_exists('wpb_action')) {
    /**
     * Generate the URL to a controller action.
     *
     * @param  string  $name
     * @param  mixed   $parameters
     * @param  bool    $absolute
     * @return string
     */
    function wpb_action($name, $parameters = [], $absolute = true)
    {
        return wpb_app('url')->action($name, $parameters, $absolute);
    }
}

if (! function_exists('wpb_app')) {
    /**
     * Get the available container instance.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed|\Illuminate\Foundation\Application
     */
    function wpb_app($abstract = null, array $parameters = [])
    {
    	global $wpb_app;

        if (is_null($abstract)) {
            return $wpb_app;
        }

        return $wpb_app->make($abstract, $parameters);
    }
}

if (! function_exists('wpb_app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_app_path($path = '')
    {
        return wpb_app('path').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('wpb_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function wpb_asset($path, $secure = null)
    {
        return wpb_app('url')->asset($path, $secure);
    }
}

if (! function_exists('wpb_auth')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function wpb_auth($guard = null)
    {
        if (is_null($guard)) {
            return wpb_app(AuthFactory::class);
        }

        return wpb_app(AuthFactory::class)->guard($guard);
    }
}

if (! function_exists('wpb_back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param  int    $status
     * @param  array  $headers
     * @param  mixed  $fallback
     * @return \Illuminate\Http\RedirectResponse
     */
    function wpb_back($status = 302, $headers = [], $fallback = false)
    {
        return wpb_app('redirect')->back($status, $headers, $fallback);
    }
}

if (! function_exists('wpb_base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_base_path($path = '')
    {
        return wpb_app()->basePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('wpb_bcrypt')) {
    /**
     * Hash the given value against the bcrypt algorithm.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function wpb_bcrypt($value, $options = [])
    {
        return wpb_app('hash')->driver('bcrypt')->make($value, $options);
    }
}

if (! function_exists('wpb_broadcast')) {
    /**
     * Begin broadcasting an event.
     *
     * @param  mixed|null  $event
     * @return \Illuminate\Broadcasting\PendingBroadcast
     */
    function wpb_broadcast($event = null)
    {
        return wpb_app(BroadcastFactory::class)->event($event);
    }
}

if (! function_exists('wpb_cache')) {
    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed|\Illuminate\Cache\CacheManager
     *
     * @throws \Exception
     */
    function wpb_cache()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return wpb_app('cache');
        }

        if (is_string($arguments[0])) {
            return wpb_app('cache')->get($arguments[0], $arguments[1] ?? null);
        }

        if (! is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the cache, you must pass an array of key / value pairs.'
            );
        }

        if (! isset($arguments[1])) {
            throw new Exception(
                'You must specify an expiration time when setting a value in the cache.'
            );
        }

        return wpb_app('cache')->put(key($arguments[0]), reset($arguments[0]), $arguments[1]);
    }
}

if (! function_exists('wpb_config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_config_path($path = '')
    {
        return wpb_app()->make('path.config').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('wpb_cookie')) {
    /**
     * Create a new cookie instance.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  int  $minutes
     * @param  string  $path
     * @param  string  $domain
     * @param  bool  $secure
     * @param  bool  $httpOnly
     * @param  bool  $raw
     * @param  string|null  $sameSite
     * @return \Illuminate\Cookie\CookieJar|\Symfony\Component\HttpFoundation\Cookie
     */
    function wpb_cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true, $raw = false, $sameSite = null)
    {
        $cookie = wpb_app(CookieFactory::class);

        if (is_null($name)) {
            return $cookie;
        }

        return $cookie->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
    }
}

if (! function_exists('wpb_csrf_field')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function wpb_csrf_field()
    {
        return new HtmlString('<input type="hidden" name="_token" value="'.csrf_token().'">');
    }
}

if (! function_exists('wpb_database_path')) {
    /**
     * Get the database path.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_database_path($path = '')
    {
        return wpb_app()->databasePath($path);
    }
}

if (! function_exists('wpb_decrypt')) {
    /**
     * Decrypt the given value.
     *
     * @param  string  $value
     * @param  bool   $unserialize
     * @return mixed
     */
    function wpb_decrypt($value, $unserialize = true)
    {
        return wpb_app('encrypter')->decrypt($value, $unserialize);
    }
}

if (! function_exists('wpb_dispatch')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    function wpb_dispatch($job)
    {
        // return new PendingDispatch($job);
    }
}

if (! function_exists('wpb_dispatch_now')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed  $job
     * @param  mixed  $handler
     * @return mixed
     */
    function wpb_dispatch_now($job, $handler = null)
    {
        return wpb_app(Dispatcher::class)->dispatchNow($job, $handler);
    }
}

if (! function_exists('wpb_elixir')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param  string  $file
     * @param  string  $buildDirectory
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function wpb_elixir($file, $buildDirectory = 'build')
    {
        static $manifest = [];
        static $manifestPath;

        if (empty($manifest) || $manifestPath !== $buildDirectory) {
            $path = wpb_public_path($buildDirectory.'/rev-manifest.json');

            if (file_exists($path)) {
                $manifest = json_decode(file_get_contents($path), true);
                $manifestPath = $buildDirectory;
            }
        }

        $file = ltrim($file, '/');

        if (isset($manifest[$file])) {
            return '/'.trim($buildDirectory.'/'.$manifest[$file], '/');
        }

        $unversioned = wpb_public_path($file);

        if (file_exists($unversioned)) {
            return '/'.trim($file, '/');
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}

if (! function_exists('wpb_encrypt')) {
    /**
     * Encrypt the given value.
     *
     * @param  mixed  $value
     * @param  bool   $serialize
     * @return string
     */
    function wpb_encrypt($value, $serialize = true)
    {
        return wpb_app('encrypter')->encrypt($value, $serialize);
    }
}

if (! function_exists('wpb_event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param  string|object  $event
     * @param  mixed  $payload
     * @param  bool  $halt
     * @return array|null
     */
    function wpb_event(...$args)
    {
        return wpb_app('events')->dispatch(...$args);
    }
}

if (! function_exists('wpb_factory')) {
    /**
     * Create a model factory builder for a given class, name, and amount.
     *
     * @param  dynamic  class|class,name|class,amount|class,name,amount
     * @return \Illuminate\Database\Eloquent\FactoryBuilder
     */
    function wpb_factory()
    {
        $factory = wpb_app(EloquentFactory::class);

        $arguments = func_get_args();

        if (isset($arguments[1]) && is_string($arguments[1])) {
            return $factory->of($arguments[0], $arguments[1])->times($arguments[2] ?? null);
        } elseif (isset($arguments[1])) {
            return $factory->of($arguments[0])->times($arguments[1]);
        }

        return $factory->of($arguments[0]);
    }
}

if (! function_exists('wpb_info')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array   $context
     * @return void
     */
    function wpb_info($message, $context = [])
    {
        wpb_app('log')->info($message, $context);
    }
}

if (! function_exists('wpb_logger')) {
    /**
     * Log a debug message to the logs.
     *
     * @param  string  $message
     * @param  array  $context
     * @return \Illuminate\Log\LogManager|null
     */
    function wpb_logger($message = null, array $context = [])
    {
        if (is_null($message)) {
            return wpb_app('log');
        }

        return wpb_app('log')->debug($message, $context);
    }
}

if (! function_exists('wpb_logs')) {
    /**
     * Get a log driver instance.
     *
     * @param  string  $driver
     * @return \Illuminate\Log\LogManager|\Psr\Log\LoggerInterface
     */
    function wpb_logs($driver = null)
    {
        return $driver ? wpb_app('log')->driver($driver) : wpb_app('log');
    }
}

if (! function_exists('wpb_method_field')) {
    /**
     * Generate a form field to spoof the HTTP verb used by forms.
     *
     * @param  string  $method
     * @return \Illuminate\Support\HtmlString
     */
    function wpb_method_field($method)
    {
        return new HtmlString('<input type="hidden" name="_method" value="'.$method.'">');
    }
}

if (! function_exists('wpb_mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    function wpb_mix($path, $manifestDirectory = '')
    {
        static $manifests = [];

        if (! Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && ! Str::startsWith($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (file_exists(public_path($manifestDirectory.'/hot'))) {
            $url = file_get_contents(public_path($manifestDirectory.'/hot'));

            if (Str::startsWith($url, ['http://', 'https://'])) {
                return new HtmlString(Str::after($url, ':').$path);
            }

            return new HtmlString("//localhost:8080{$path}");
        }

        $manifestPath = wpb_public_path($manifestDirectory.'/mix-manifest.json');

        if (! isset($manifests[$manifestPath])) {
            if (! file_exists($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (! isset($manifest[$path])) {
            wpb_report(new Exception("Unable to locate Mix file: {$path}."));

            if (! wpb_app('config')->get('app.debug')) {
                return $path;
            }
        }

        return new HtmlString($manifestDirectory.$manifest[$path]);
    }
}

if (! function_exists('wpb_now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function wpb_wpb_now($tz = null)
    {
        return Carbon::now($tz);
    }
}

if (! function_exists('wpb_old')) {
    /**
     * Retrieve an old input item.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function wpb_old($key = null, $default = null)
    {
        return wpb_app('request')->old($key, $default);
    }
}

if (! function_exists('wpb_policy')) {
    /**
     * Get a policy instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    function wpb_policy($class)
    {
        return wpb_app(Gate::class)->getPolicyFor($class);
    }
}

if (! function_exists('wpb_public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_public_path($path = '')
    {
        return wpb_app()->make('path.public').($path ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (! function_exists('wpb_redirect')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $to
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function wpb_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return wpb_app('redirect');
        }

        return wpb_app('redirect')->to($to, $status, $headers, $secure);
    }
}

if (! function_exists('wpb_report')) {
    /**
     * Report an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    function wpb_report($exception)
    {
        if ($exception instanceof Throwable &&
            ! $exception instanceof Exception) {
            $exception = new FatalThrowableError($exception);
        }

        wpb_app(ExceptionHandler::class)->report($exception);
    }
}

if (! function_exists('wpb_request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string  $key
     * @param  mixed   $default
     * @return \Illuminate\Http\Request|string|array
     */
    function wpb_request($key = null, $default = null)
    {
        if (is_null($key)) {
            return wpb_app('request');
        }

        if (is_array($key)) {
            return wpb_app('request')->only($key);
        }

        $value = wpb_app('request')->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (! function_exists('wpb_rescue')) {
    /**
     * Catch a potential exception and return a default value.
     *
     * @param  callable  $callback
     * @param  mixed  $rescue
     * @return mixed
     */
    function wpb_rescue(callable $callback, $rescue = null)
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            wpb_report($e);

            return value($rescue);
        }
    }
}

if (! function_exists('wpb_resolve')) {
    /**
     * Resolve a service from the container.
     *
     * @param  string  $name
     * @return mixed
     */
    function wpb_resolve($name)
    {
        return wpb_app($name);
    }
}

if (! function_exists('wpb_resource_path')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_resource_path($path = '')
    {
        return wpb_app()->resourcePath($path);
    }
}

if (! function_exists('wpb_response')) {
    /**
     * Return a new response from the application.
     *
     * @param  \Illuminate\View\View|string|array|null  $content
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function wpb_response($content = '', $status = 200, array $headers = [])
    {
        $factory = wpb_app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (! function_exists('wpb_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function wpb_route($name, $parameters = [], $absolute = true)
    {
        return wpb_app('url')->route($name, $parameters, $absolute);
    }
}

if (! function_exists('wpb_secure_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_secure_asset($path)
    {
        return wpb_asset($path, true);
    }
}

if (! function_exists('wpb_secure_url')) {
    /**
     * Generate a HTTPS url for the application.
     *
     * @param  string  $path
     * @param  mixed   $parameters
     * @return string
     */
    function wpb_secure_url($path, $parameters = [])
    {
        return wpb_url($path, $parameters, true);
    }
}

if (! function_exists('wpb_session')) {
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager
     */
    function wpb_session($key = null, $default = null)
    {
        if (is_null($key)) {
            return wpb_app('session');
        }

        if (is_array($key)) {
            return wpb_app('session')->put($key);
        }

        return wpb_app('session')->get($key, $default);
    }
}

if (! function_exists('wpb_storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string  $path
     * @return string
     */
    function wpb_storage_path($path = '')
    {
        return wpb_app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('wpb_today')) {
    /**
     * Create a new Carbon instance for the current date.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function wpb_today($tz = null)
    {
        return Carbon::today($tz);
    }
}

if (! function_exists('wpb_trans')) {
    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function wpb_trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return wpb_app('translator');
        }

        return wpb_app('translator')->trans($key, $replace, $locale);
    }
}

if (! function_exists('wpb_trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $key
     * @param  int|array|\Countable  $number
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    function wpb_trans_choice($key, $number, array $replace = [], $locale = null)
    {
        return wpb_app('translator')->transChoice($key, $number, $replace, $locale);
    }
}

if (! function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string  $locale
     * @return string|array|null
     */
    function __($key, $replace = [], $locale = null)
    {
        return wpb_app('translator')->getFromJson($key, $replace, $locale);
    }
}

if (! function_exists('wpb_url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string  $path
     * @param  mixed   $parameters
     * @param  bool    $secure
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function wpb_url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return wpb_app(UrlGenerator::class);
        }

        return wpb_app(UrlGenerator::class)->to($path, $parameters, $secure);
    }
}

if (! function_exists('wpb_validator')) {
    /**
     * Create a new Validator instance.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function wpb_validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        $factory = wpb_app(ValidationFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($data, $rules, $messages, $customAttributes);
    }
}
