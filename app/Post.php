<?php
/**
 * The file handle post table.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/app
 */

namespace WPB\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * The post model class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/app
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Post extends Model {

	protected $primaryKey = 'ID';

	/**
	 *  The post type scope.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The post type scope.
	 */
	protected static $type_scope = 'post';

	/**
	 * The post status scope.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $status_scope    The post status scope.
	 */
	protected static $status_scope = 'publish';

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $author_scope    The author scope..
	 */
	protected static $author_scope = null;

	/**
	 * The constant used to modify default created at fields.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    CREATED_AT    The constant used to modify default created at fields.
	 */
	const CREATED_AT = 'post_date';

	/**
	 * The constant used to modify default updated at fields.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    UPDATED_AT    The constant used to modify default updated at fields.
	 */
	const UPDATED_AT = 'post_modified';

	/**
	 * Boot the model.
	 *
	 * @since    1.0.0
	 * @access   protected
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();
		static::addGlobalScope(
			'type',
			function ( Builder $builder ) {
				$builder->where( 'post_type', '=', static::$type_scope );
			}
		);

	}

	/**
	 * Filter by post type.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder    The eloquent builder.
	 * @param string                                $type       The post type scope.
	 *
	 * @return mixed
	 */
	public function scopeType( Builder $builder, $type ) {
		self::$type_scope = $type;
		return $builder->where( 'post_type', '=', $type );
	}

	/**
	 * Filter by post status
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder    The eloquent builder.
	 * @param string                                $status     The post status scope.
	 *
	 * @return mixed
	 */
	public function scopeStatus( Builder $builder, $status ) {
		return $builder->where( 'post_status', '=', $status );
	}

	/**
	 * Filter by post author
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder    The eloquent builder.
	 * @param string|null                           $author     The post status scope.
	 *
	 * @return mixed
	 */
	public function scopeAuthor( Builder $builder, $author ) {
		if ( $author ) {
			return $builder->where( 'post_author', '=', $author );
		}
	}
}
