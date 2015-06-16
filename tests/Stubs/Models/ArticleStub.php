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

use Illuminate\Database\Eloquent\Model;

class ArticleStub extends Model
{
    protected $fillable = ['id', 'title', 'content', 'creator_id'];

}
