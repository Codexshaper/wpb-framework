<?php
/**
 * The post type scope.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace CodexShaper\WP\Database\Eloquent\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * The Post Type Scope class.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class PostTypeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder $builder The eloquent builder.
     * @param \Illuminate\Database\Eloquent\Model   $model   $model The eloquent model.
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('post_type', '=', 'post');
    }
}
