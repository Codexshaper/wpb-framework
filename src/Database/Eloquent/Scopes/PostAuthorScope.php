<?php
/**
 * The post author scope.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/src/Database/Eloquent/Scopes
 */

namespace WPB\Database\Eloquent\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * The Post Author Scope class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/src/Database/Eloquent/Scopes
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class PostAuthorScope implements Scope {

	/**
	 * Apply the scope to a given Eloquent query builder.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder The eloquent builder.
	 * @param \Illuminate\Database\Eloquent\Model   $model The eloquent model.
	 *
	 * @return void
	 */
	public function apply( Builder $builder, Model $model ) {
		$builder->whereNull( 'post_author' );
	}
}
