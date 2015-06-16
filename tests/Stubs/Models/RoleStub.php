<?php namespace Slynova\Acl\Tests\Stubs\Models;

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

use Slynova\Acl\Models\Role;
use Slynova\Acl\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class RoleStub extends Role
{
    public function permission($resourceType)
    {
        $permission1 = json_encode([
            'view' => [
                ['name' => 'title', 'conditions' => ['Slynova\Acl\Tests\Stubs\Conditions\Owner\ArticleOwnerStub']]
            ],
            'create' => [
                ['name' => 'title'],
            ],
            'update' => false,
            'delete' => false,
            'permissions' => [
                ['name' => 'UploadPicture', 'conditions' => ['Slynova\Acl\Tests\Stubs\Conditions\Owner\ArticleOwnerStub']]
            ]
        ]);

        $permission2 = json_encode([
            'view' => [
                ['name' => 'birth_on', 'conditions' => ['Slynova\Acl\Tests\Stubs\Conditions\Owner\UserOwnerStub']]
            ],
            'delete' => true
        ]);

        if ($resourceType == 'articlestub' && $this->slug == 'developper') {
            return new Permission(['resource_type' => 'articlestub', 'access_parameters' => $permission1]);
        }

        if ($resourceType == 'userstub' && $this->slug == 'developper') {
            return new Permission(['resource_type' => 'userstub', 'access_parameters' => $permission2]);
        }

        return;
    }
}
