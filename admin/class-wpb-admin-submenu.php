<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WPB
 * @subpackage WPB/admin
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class WPB_Admin_SubMenu {

	public $parent_slug;

    public $page_title;

    public $menu_title;

    public $capability;

    public $slug;

    public $callback;

    public $position;

    public $plugin_name;

    public function save()
    {
        add_action('admin_menu', [$this, 'create_submenu']);
    }

    public function make($options = [])
    {
        foreach ($options as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
        add_action('admin_menu', [$this, 'create_submenu']);
    }

    /**
     * Register our menu page.
     *
     * @return void
     */
    public function create_submenu()
    {
        if (current_user_can($this->capability)) {
            $hook = add_submenu_page(
                $this->parent_slug,
                $this->page_title,
                $this->menu_title,
                $this->capability,
                $this->slug,
                $this->callback,
                $this->icon
            );
        }

        add_action('load-'.$hook, [$this, 'init_hooks']);
    }

    /**
     * Initialize our hooks for the admin page.
     *
     * @return void
     */
    public function init_hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Load scripts and styles for the app.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_enqueue_style($this->plugin_name . '-vendors');
        wp_enqueue_style($this->plugin_name . '-admin');
        wp_enqueue_script($this->plugin_name . '-admin');
    }

    /**
     * Render our admin page.
     *
     * @return void
     */
    public function plugin_page()
    {
        echo '<div class="wrap"><div id="'. $this->plugin_name .'-admin" csrf-token="'.csrf_token().'"></div></div>';
    }

}
