<?php
/**
 * This is the example of database migration.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/database/migrations
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use CodexShaper\Database\Facades\Schema;

/**
 * Create customers table.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/database/migrations
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Create_Customers_Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'customers',
			function ( Blueprint $table ) {
				$table->id();
				$table->string( 'name' );
				$table->string( 'email' )->unique();
				$table->timestamp( 'email_verified_at' )->nullable();
				$table->string( 'password' );
				$table->rememberToken();
				$table->timestamps();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'customers' );
	}
}
