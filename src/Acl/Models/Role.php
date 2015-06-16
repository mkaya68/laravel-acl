<?php namespace Slynova\Acl\Models;

/**
 * Part of the Laravel-ACL package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the MIT License.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 * It is also available at the following URL: http://opensource.org/licenses/MIT
 *
 * @package    Laravel-ACL
 * @version    1.0.0
 * @author     Slynova
 * @license    MIT
 * @copyright  (c) Slynova
 */

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * The users that belong to the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.model'));
    }

    /**
     * The permissions with the correct
     * resource type that has the role.
     *
     * @param  string  $resource
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permission($resource)
    {
        $model = config('acl.models.permission', \Slynova\Acl\Models\Permission::class);

        $className = explode('\\', get_class($resource));
        $resourceType = strtolower(array_pop($className));

        return $this->hasOne($model)->where('resource_type', $resourceType);
    }
}
