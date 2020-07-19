<?php
/**
 * The file handle the config.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\Support\Facades;

/**
 * The config class.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Config
{
    /**
     * The config.
     *
     * @since    1.0.0
     *
     * @var array The config array.
     */
    protected $config = [];

    /**
     * Factory class.
     *
     * @since    1.0.0
     *
     * @param array $options The defaut configuration option.
     *
     * @return void
     */
    public function __construct($options = [])
    {
        $dir = __DIR__.'/../../../../../../';

        if (!empty($options) && isset($options['paths']['root'])) {
            $dir = rtrim($options['paths']['root'], '/').'/';
        }

        foreach (glob($dir.'config/*.php') as $file) {
            $index = pathinfo($file)['filename'];
            $this->config[$index] = require_once $file;
        }
    }

    /**
     * Get the config value.
     *
     * @since    1.0.0
     *
     * @param string $config  The config key.
     * @param string $default The default config value.
     *
     * @return null|string
     */
    public function get($config, $default = null)
    {
        $keys = explode('.', $config);
        $filename = array_shift($keys);
        $data = $this->config[$filename];

        foreach ($keys as $key) {
            if (is_array($data) && array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                $data = null;
            }
        }

        if (!$data) {
            $data = $default;
        }

        return $data;
    }
}
