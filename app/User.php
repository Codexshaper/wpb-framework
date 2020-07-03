<?php
/**
 * The file handle user table.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/app
 */

namespace WPB\App;

use Illuminate\Database\Eloquent\Model;

/**
 * The user model class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/app
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class User extends Model {

	protected $primaryKey = 'ID';

	/**
	 * The fillable fields for mass assignment.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $fillable    The fillable fields.
	 */
	protected $fillable = array(
		'name',
		'email',
		'password',
	);

	/**
	 * The hidden fields.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $hidden    The hidden fields.
	 */
	protected $hidden = array(
		'password',
		'remember_token',
	);

	/**
	 * The field cast.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $casts    The field cast.
	 */
	protected $casts = array(
		'email_verified_at' => 'datetime',
	);
}
