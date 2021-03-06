<?php
/**
 * The file that defines to modify files after install the project.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace CodexShaper\Composer;

use Composer\Script\Event;
use Illuminate\Filesystem\Filesystem;

/**
 * The composer script class.
 *
 * Here set all the logic that implement after install the project.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class ComposerScripts
{
    /**
     * Handle the post-install Composer event.
     *
     * @param \Composer\Script\Event $event The composer event.
     *
     * @return void
     */
    public static function post_install(Event $event)
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php';
    }

    /**
     * Handle the post-update Composer event.
     *
     * @param \Composer\Script\Event $event The composer event.
     *
     * @return void
     */
    public static function post_update(Event $event)
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php';
    }

    /**
     * Handle the post-autoload-dump Composer event.
     *
     * @param \Composer\Script\Event $event The composer event.
     *
     * @return void
     */
    public static function post_autoload_dump(Event $event)
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php';

        $dir = $event->getComposer()->getConfig()->get('vendor-dir').'/../';
        $root = dirname($event->getComposer()->getConfig()->get('vendor-dir'));

        $vendor_name = strtolower(basename($root));
        $partials = explode('-', $vendor_name);
        $camel_case_partials = [];
        foreach ($partials as $partial) {
            $camel_case_partials[] = ucfirst(strtolower($partial));
        }
        $camel_case = implode('_', $camel_case_partials);
        $snake_case = implode('_', $partials);

        $files = [
            '/admin/class-wpb-admin.php',
            '/admin/class-wpb-admin-menu.php',
            '/admin/class-wpb-admin-submenu.php',
            '/admin/partials/wpb-admin-display.php',
            '/admin/css/wpb-admin.css',
            '/admin/js/wpb-admin.js',
            '/app/Exceptions/Handler.php',
            '/app/Http/Controllers/ProductController.php',
            '/app/Http/Middleware/AuthMiddleware.php',
            '/app/Http/Middleware/VerifyCsrfToken.php',
            '/app/Http/Kernel.php',
            '/app/User.php',
            '/app/Post.php',
            '/bootstrap/app.php',
            '/config/app.php',
            '/config/database.php',
            '/config/view.php',
            '/database/migrations/class-create-customers-table.php',
            '/database/seeds/class-customers-table.php',
            '/includes/class-wpb-activator.php',
            '/includes/class-wpb-deactivator.php',
            '/includes/class-wpb-i18n.php',
            '/includes/class-wpb-loader.php',
            '/includes/class-wpb.php',
            '/public/class-wpb-public.php',
            '/public/partials/wpb-public-display.php',
            '/public/css/wpb-public.css',
            '/public/js/wpb-public.js',
            '/resources/js/admin/main.js',
            '/resources/js/admin/router/index.js',
            '/resources/js/frontend/main.js',
            '/resources/js/spa/main.js',
            '/routes/web.php',
            '/routes/api.php',
            '/src/Contracts/Http/Kernel.php',
            '/src/Contracts/ExceptionHandler.php',
            '/src/Database/Eloquent/Scopes/PostAuthorScope.php',
            '/src/Database/Eloquent/Scopes/PostStatusScope.php',
            '/src/Database/Eloquent/Scopes/PostTypeScope.php',
            '/src/Database/DB.php',
            '/src/Exceptions/Handler.php',
            '/src/Http/Events/RequestHandled.php',
            '/src/Http/Kernel.php',
            '/src/helpers.php',
            '/src/Support/Facades/Config.php',
            '/src/Support/Facades/Route.php',
            '/src/Application.php',
            '/tests/Application.php',
            '/wpb.php',
        ];

        foreach ($files as $file) {
            $file = $root.$file;
            if (file_exists($file)) {
                $filesystem = new Filesystem();

                $contents = $filesystem->get($file);
                $contents = str_replace('wpb_', $snake_case.'_', $contents);
                $contents = str_replace('wpb', $vendor_name, $contents);
                $contents = str_replace('WPB_APP_ROOT', strtoupper($camel_case).'_APP_ROOT', $contents);
                $contents = str_replace('WPB_FILE', strtoupper($camel_case).'_FILE', $contents);
                $contents = str_replace('WPB_PATH', strtoupper($camel_case).'_PATH', $contents);
                $contents = str_replace('WPB_INCLUDES', strtoupper($camel_case).'_INCLUDES', $contents);
                $contents = str_replace('WPB_URL', strtoupper($camel_case).'_URL', $contents);
                $contents = str_replace('WPB_ASSETS', strtoupper($camel_case).'_ASSETS', $contents);
                $contents = str_replace('WPB_VERSION', strtoupper($camel_case).'_VERSION', $contents);
                $contents = str_replace('WPB', $camel_case, $contents);
                $filesystem->put(
                    $file,
                    $contents
                );

                $dir = dirname($file);
                $file_name = basename($file);
                $new_file_name = str_replace('wpb', $vendor_name, $file_name);

                if ($file_name !== $new_file_name) {
                    rename($file, $dir.'/'.$new_file_name);
                }
            }
        }

        static::update_composer($filesystem, $root, $camel_case);
    }

    /**
     * Replace bootstrap file.
     *
     * @since    1.0.0
     *
     * @param Illuminate\Filesystem\Filesystem $filesystem The illuminate filesystem.
     * @param string                           $root       The string is unique root path for each plugin.
     * @param string                           $camel_case This string is camel case of project name.
     *
     * @return void
     */
    protected static function update_bootstrap($filesystem, $root, $camel_case)
    {
        $file = $root.'/bootstrap/app.php';
        if (file_exists($file)) {
            $contents = $filesystem->get($file);
            $contents = str_replace('WPB_APP_ROOT', strtoupper($camel_case).'_APP_ROOT', $contents);
            $filesystem->put(
                $file,
                $contents
            );
        }
    }

    /**
     * Update composer.
     *
     * @param Illuminate\Filesystem\Filesystem $filesystem The illuminate filesystem.
     * @param string                           $root       The app root.
     * @param string                           $camel_case The composer event.
     *
     * @return void
     */
    protected static function update_composer($filesystem, $root, $camel_case)
    {
        $file = $root.'/composer.json';
        if (file_exists($file)) {
            $contents = $filesystem->get($file);
            $contents = str_replace('WPB', $camel_case, $contents);
            $filesystem->put(
                $file,
                $contents
            );
        }
    }
}
