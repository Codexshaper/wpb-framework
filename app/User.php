<?php
/**
 * The file handle user table.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\App;

use Illuminate\Database\Eloquent\Model;

/**
 * The user model class.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class User extends Model
{
    protected $primaryKey = 'ID';

    /**
     * The fillable fields for mass assignment.
     *
     * @since    1.0.0
     *
     * @var array The fillable fields.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The hidden fields.
     *
     * @since    1.0.0
     *
     * @var array The hidden fields.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The field cast.
     *
     * @since    1.0.0
     *
     * @var array The field cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
