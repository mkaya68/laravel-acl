<?php namespace Slynova\Acl\Contracts;

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

interface Condition
{
    /**
     * Handle the condition.
     *
     * @param  mixed  $userResource
     * @param  mixed  $databaseResource
     * @return void
     */
    public function handle($userResource, $databaseResource = null);
}
