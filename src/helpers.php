<?php

if (function_exists('wp_enqueue_style') && function_exists('wp_enqueue_script')) {
    if (function_exists('add_shortcode')) {
        if(function_exists('wpb_render_frontend')) {
            add_shortcode('wpb-frontend', 'wpb_render_frontend');
        }

        if(function_exists('wpb_render_spa')) {
            add_shortcode('wpb-spa', 'wpb_render_spa');
        }
    }

    if( !function_exists('wpb_render_frontend')) {
        function wpb_render_frontend($atts, $content = '')
        {
            wp_enqueue_style('wpb-frontend');
            wp_enqueue_script('wpb-frontend');

            $content .= '<div id="wpb-frontend-app"></div>';

            return $content;
        }
    }

    if ( !function_exists('wpb_render_spa')) {
        function wpb_render_spa($atts, $content = '')
        {
            wp_enqueue_style('wpb-spa');
            wp_enqueue_script('wpb-spa');

            $content .= '<div id="wpb-spa-app"></div>';

            return $content;
        }
    }
}
