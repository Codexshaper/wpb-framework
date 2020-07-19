<?php
/**
 * The file that defines all app configurations.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

return [
    'debug'     => true,
    'env'       => 'production',
    'providers' => [
        '\Illuminate\Filesystem\FilesystemServiceProvider',
        '\Illuminate\Events\EventServiceProvider',
        '\CodexShaper\Routing\RoutingServiceProvider',
        'Illuminate\View\ViewServiceProvider',
    ],
];
