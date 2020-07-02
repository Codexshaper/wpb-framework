<?php
/**
 * The file that defines all app configurations.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/config
 */

return array(
	'debug'     => true,
	'env'       => 'production',
	'providers' => array(
		'\Illuminate\Filesystem\FilesystemServiceProvider',
		'\Illuminate\Events\EventServiceProvider',
		'\CodexShaper\Routing\RoutingServiceProvider',
		'Illuminate\View\ViewServiceProvider',
	),
);
