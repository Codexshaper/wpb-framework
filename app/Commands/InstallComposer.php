<?php
/**
 * Install composer.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/app/Commands
 */

 /**
  * Register all actions and filters for the plugin.
  *
  * Maintain a list of all hooks that are registered throughout
  * the plugin, and register them with the WordPress API. Call the
  * run function to execute the list of actions and filters.
  *
  * @package    WPB
  * @subpackage WPB/app/Commands
  * @author     Md Abu Ahsan basir <maab.career@gmail.com>
  */
class InstallComposer {

	/**
	 * Install composer factory.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( ! file_exists( __DIR__ . '/../vendor/autoload.php' ) ) {

			require_once __DIR__ . '/../vendor/autoload.php';

			$composer = 'composer';

			try {
				$process = \Symfony\Component\Process\Process::fromShellCommandline( $composer . ' install' );
				$process->setEnv(
					array(
						'COMPOSER_HOME' => __DIR__ . '/../vendor/bin/composer',
					)
				);
				$process->setTimeout( null ); // Setting timeout to null to prevent installation from stopping at a certain point in time.
				$process->setWorkingDirectory( __DIR__ )->mustRun();
			} catch ( \Exception $ex ) {
				echo $ex->getMessage();
			}
		}
	}
}
