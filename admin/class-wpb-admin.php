<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class WPB_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->register_menus();
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPB_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPB_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/wpb-admin.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPB_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPB_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/wpb-admin.js', ['jquery'], $this->version, false);
    }

    /**
     * Register all menus here.
     *
     * @since    1.0.0
     */
    public function register_menus()
    {
        // Registerv root menu.
        $menu = new WPB_Admin_Menu($this->plugin_name);
        $menu->page_title = 'WPB';
        $menu->menu_title = 'WPB';
        $menu->capability = 'manage_options';
        $menu->slug = 'wpb';
        $menu->icon = 'dashicons-text';
        $menu->save();
        // Register submenu for root menu.
        $submenu = new WPB_Admin_SubMenu($this->plugin_name);
        $submenu->parent_slug = $menu->slug;
        $submenu->page_title = 'Settings';
        $submenu->menu_title = 'Settings';
        $submenu->capability = 'manage_options';
        $submenu->slug = 'admin.php?page='.$menu->slug.'#/settings';
        $submenu->save();
    }
}
