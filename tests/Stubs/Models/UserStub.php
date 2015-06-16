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

use Slynova\Acl\Traits\Roleable;
use Slynova\Acl\Tests\Stubs\Models\RoleStub;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UserStub extends Model
{
    use Roleable;

    protected $fillable = ['id'];

    public function roles()
    {
        return new Collection([
            new RoleStub(['slug' => 'developper']),
            new RoleStub(['slug' => 'admin']),
        ]);
    }
}
