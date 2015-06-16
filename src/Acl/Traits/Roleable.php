<?php namespace Slynova\Acl\Traits;

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

trait Roleable
{
    /**
     * Checks if the user has the given role.
     *
     * @param  string|array  $slugs
     * @return bool
     */
    public function is($slugs)
    {
        $operator = 'and';

        if (! is_array($slugs)) {
            $operator = 'or';

            $slugs = explode('|', $slugs);
        }

        $roles = $this->roles();

        if ($operator === 'and') {
            foreach ($roles as $role) {
                if (! in_array($role->slug, $slugs)) {
                    return false;
                }
            }

            return true;
        }

        foreach ($roles as $role) {
            if (in_array($role->slug, $slugs)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the user has the given permission.
     *
     * @param  string  $permission
     * @param  mixed  $resource
     * @return bool
     */
    public function can($permission, $resource)
    {
        $permission = explode('.', $permission);

        if (count($permission) === 1 && $permission[0] !== 'delete') {
            $permissions = $this->getCachedPermissions($resource);

            if (isset($permissions['permissions'])) {
                foreach ($permissions['permissions'] as $p) {
                    if ($p['name'] == $permission[0]) {
                        return $this->checkConditions($p, $resource);
                    }
                }

                // throw Exception (UndefinedConditionException)
            }
        }

        switch ($permission[0]) {
            case 'view':
                return $this->canView($permission[1], $resource);
            case 'create':
                return $this->canCreate($permission[1], $resource);
            case 'update':
                return $this->canUpdate($permission[1], $resource);
            case 'delete':
                return $this->canDelete($resource);
        }

        return false;
    }

    /**
     * Checks if the user can view the field
     * for the given resource.
     *
     * @param  string  $field
     * @param  mixed  $resource
     * @return bool
     */
    public function canView($field, $resource)
    {
        $permissions = $this->getCachedPermissions($resource);

        return $this->checkPermission($field, $permissions['view'], $resource);
    }

    /**
     * Checks if the user can create the field
     * for the given resource.
     *
     * @param  string  $field
     * @param  mixed  $resource
     * @return bool
     */
    public function canCreate($field, $resource)
    {
        $permissions = $this->getCachedPermissions($resource);

        return $this->checkPermission($field, $permissions['create'], $resource);
    }

    /**
     * Checks if the user can update the field
     * for the given resource.
     *
     * @param  string  $permission
     * @param  mixed  $resource
     * @return bool
     */
    public function canUpdate($field, $resource)
    {
        $permissions = $this->getCachedPermissions($resource);

        if (is_array($permissions['update'])) {
            return $this->checkPermission($field, $permissions['update'], $resource);
        }

        return (bool) $permissions['update'];
    }

    protected function hasConditions($field)
    {
        return isset($field['conditions']);
    }

    protected function checkConditions($field, $resource)
    {
        $conditions = $field['conditions'];

        foreach ($conditions as $condition) {
            $allowed = (new $condition)->handle($resource);
        }

        return $allowed;
    }

    protected function checkPermission($field, $permissions, $resource)
    {
        foreach ($permissions as $allowedField) {
            if ($allowedField['name'] === $field) {
                if ($this->hasConditions($allowedField)) {
                    return $this->checkConditions($allowedField, $resource);
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the user can delete the given resource.
     *
     * @param  mixed  $resource
     * @return bool
     */
    public function canDelete($resource)
    {
        $permissions = $this->getCachedPermissions($resource);

        return (bool) $permissions['delete'];
    }

    /**
     * The roles that belong to the user.
     *
     * @codeCoverageIgnore
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $model = config('acl.models.role', \Slynova\Acl\Models\Role::class);

        return $this->belongsToMany($model);
    }

    /**
     * @return array
     */
    protected function getCachedPermissions($resource)
    {
        $roles = $this->roles();
        $className = explode('\\', get_class($resource));
        $resourceType = strtolower(array_pop($className));
        $accessParameters = [];

        foreach ($roles as $role) {
            $permission = $role->permission($resourceType);

            if ($permission) {
                $accessParameters[] = json_decode($permission->access_parameters, true);
            }
        }

        if (count($accessParameters) === 1) {
            return $accessParameters[0];
        }
    }
}
