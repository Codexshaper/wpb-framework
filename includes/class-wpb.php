<?php
/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class WPB
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     *
     * @var WPB_Loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->define_constants();

        if (defined('WPB_VERSION')) {
            $this->version = WPB_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'wpb';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->register_assets();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - WPB_Loader. Orchestrates the hooks of the plugin.
     * - WPB_i18n. Defines internationalization functionality.
     * - WPB_Admin. Defines all hooks for the admin area.
     * - WPB_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-wpb-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-wpb-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-wpb-admin.php';

        /**
         * The class responsible for defining all menu actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-wpb-admin-menu.php';

        /**
         * The class responsible for defining all submenu actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-wpb-admin-submenu.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'public/class-wpb-public.php';

        $this->loader = new WPB_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the WPB_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function set_locale()
    {
        $plugin_i18n = new WPB_I18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new WPB_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_public_hooks()
    {
        $plugin_public = new WPB_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     *
     * @return string The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     *
     * @return WPB_Loader Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     *
     * @return string The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Define the constants.
     *
     * @return void
     */
    public function define_constants()
    {
        define('WPB_VERSION', $this->version);
    }

    /**
     * Register our app scripts and styles.
     *
     * @return void
     */
    public function register_assets()
    {
        $this->register_scripts($this->get_scripts());
        $this->register_styles($this->get_styles());
    }

    /**
     * Register scripts.
     *
     * @param array $scripts All Scripts as an array.
     *
     * @return void
     */
    private function register_scripts($scripts)
    {
        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;
            $in_footer = isset($script['in_footer']) ? $script['in_footer'] : false;
            $version = isset($script['version']) ? $script['version'] : WPB_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, $in_footer);
        }
    }

    /**
     * Register styles.
     *
     * @param array $styles All styles as an array.
     *
     * @return void
     */
    public function register_styles($styles)
    {
        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, WPB_VERSION);
        }
    }

    /**
     * Get all registered scripts.
     *
     * @return array
     */
    public function get_scripts()
    {
        $prefix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.min' : '';

        $scripts = [
            'wpb-runtime'  => [
                'src'       => WPB_ASSETS.'/js/runtime.js',
                'version'   => filemtime(WPB_PATH.'/public/js/runtime.js'),
                'in_footer' => true,
            ],
            'wpb-vendor'   => [
                'src'       => WPB_ASSETS.'/js/vendors.js',
                'version'   => filemtime(WPB_PATH.'/public/js/vendors.js'),
                'in_footer' => true,
            ],
            'wpb-frontend' => [
                'src'       => WPB_ASSETS.'/js/frontend.js',
                'deps'      => ['jquery', 'wpb-vendor', 'wpb-runtime'],
                'version'   => filemtime(WPB_PATH.'/public/js/frontend.js'),
                'in_footer' => true,
            ],
            'wpb-admin'    => [
                'src'       => WPB_ASSETS.'/js/admin.js',
                'deps'      => ['jquery', 'wpb-vendor', 'wpb-runtime'],
                'version'   => filemtime(WPB_PATH.'/public/js/admin.js'),
                'in_footer' => true,
            ],
            'wpb-spa'      => [
                'src'       => WPB_ASSETS.'/js/spa.js',
                'deps'      => ['jquery', 'wpb-vendor', 'wpb-runtime'],
                'version'   => filemtime(WPB_PATH.'/public/js/spa.js'),
                'in_footer' => true,
            ],
        ];

        return $scripts;
    }

    /**
     * Get registered styles.
     *
     * @return array
     */
    public function get_styles()
    {
        $styles = [
            'wpb-style'    => [
                'src' => WPB_ASSETS.'/css/style.css',
            ],
            'wpb-frontend' => [
                'src' => WPB_ASSETS.'/css/frontend.css',
            ],
            'wpb-admin'    => [
                'src' => WPB_ASSETS.'/css/admin.css',
            ],
            'wpb-spa'      => [
                'src' => WPB_ASSETS.'/css/spa.css',
            ],
            'wpb-vendors'  => [
                'src' => WPB_ASSETS.'/css/vendors.css',
            ],
        ];

        return $styles;
    }
}
