<?php
/**
 * The post status scope.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src/Database/Eloquent/Scopes
 */

namespace CodexShaper\WP\Database\Eloquent\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * The Post Status Scope class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src/Database/Eloquent/Scopes
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class PostStatusScope implements Scope {

	/**
	 * Apply the scope to a given Eloquent query builder.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder $builder The eloquent builder.
	 * @param \Illuminate\Database\Eloquent\Model   $model $model The eloquent model.
	 *
	 * @return void
	 */
	public function apply( Builder $builder, Model $model ) {
		$builder->where( 'post_status', '=', 'publish' );
	}
}
