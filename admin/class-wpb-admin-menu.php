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
class WPB_Admin_Menu
{
    /**
     * The menu page title.
     *
     * @since    1.0.0
     *
     * @var string The string used to set menu page title.
     */
    public $page_title;

    /**
     * The menu title.
     *
     * @since    1.0.0
     *
     * @var string The string used to set menu title.
     */
    public $menu_title;

    /**
     * The menu capability.
     *
     * @since    1.0.0
     *
     * @var string The string used to set menu capability.
     */
    public $capability;

    /**
     * The menu slug.
     *
     * @since    1.0.0
     *
     * @var string The string used to set menu slug.
     */
    public $slug;

    /**
     * The callback to render content.
     *
     * @since    1.0.0
     *
     * @var callback The callback used to render content.
     */
    public $callback = null;

    /**
     * The menu icon.
     *
     * @since    1.0.0
     *
     * @var string The string used to set menu icon.
     */
    public $icon;

    /**
     * The menu position.
     *
     * @since    1.0.0
     *
     * @var int The string used to set menu position.
     */
    public $position;

    /**
     * The menu plugin name.
     *
     * @since    1.0.0
     *
     * @var string The string used to uniquely identify this plugin.
     */
    private $plugin_name;

    /**
     * Boot Menu.
     *
     * @param string $plugin_name The string used to uniquely identify this plugin.
     *
     * @since    1.0.0
     */
    public function __construct($plugin_name)
    {
        $this->plugin_name = $plugin_name;
    }

    /**
     * Create a new menu page.
     *
     * @since    1.0.0
     */
    public function save()
    {
        add_action('admin_menu', [$this, 'create_menu']);
    }

    /**
     * Create a new menu page.
     *
     * @since    1.0.0
     *
     * @param array $options Pass proprties as an array.
     */
    public function make($options = [])
    {
        foreach ($options as $property => $value) {
            if (property_exists(get_called_class(), $property)) {
                $this->{$property} = $value;
            }
        }
        add_action('admin_menu', [$this, 'create_menu']);
    }

    /**
     * Register new menu page.
     *
     * @return void
     */
    public function create_menu()
    {
        $callback = $this->callback ?? [$this, 'render_content'];
        $hook = add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->slug,
            $callback,
            $this->icon
        );

        add_action('load-'.$hook, [$this, 'init_hooks']);
    }

    /**
     * Initialize hooks for the admin page.
     *
     * @return void
     */
    public function init_hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Load scripts and styles for the current menu page.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_enqueue_style($this->plugin_name.'-vendors');
        wp_enqueue_style($this->plugin_name.'-admin');
        wp_enqueue_script($this->plugin_name.'-admin');
    }

    /**
     * Render app content.
     *
     * @return void
     */
    public function render_content()
    {
        echo '<div class="wrap"><div id="wpb-admin" base-url="'.esc_attr(get_site_url()).'" csrf-token="'.esc_attr(wpb_csrf_token()).'"></div></div>';
    }
}
