<?php namespace Slynova\Acl\Tests\Traits;

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

use Slynova\Acl\Tests\Stubs\Models\UserStub;
use Slynova\Acl\Tests\Stubs\Models\ArticleStub;

class RoleableTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->article = new ArticleStub(['id' => 1, 'title' => 'John', 'content' => 'Doe', 'creator_id' => 1]);
        $this->article2 = new ArticleStub(['id' => 2, 'title' => 'Jane', 'content' => 'Doe', 'creator_id' => 2]);
        $this->user = new UserStub(['id' => 2]);
        $this->model = new UserStub(['id' => 1]);
    }

    public function testIs()
    {
        $this->assertTrue($this->model->is('developper'));
        $this->assertTrue($this->model->is('developper|redactor'));
        $this->assertTrue($this->model->is(['developper', 'admin']));

        $this->assertFalse($this->model->is('redactor'));
        $this->assertFalse($this->model->is(['developper', 'redactor']));
    }

    public function testCan()
    {
        $this->assertTrue($this->model->can('UploadPicture', $this->article));
        $this->assertFalse($this->model->can('UploadPicture', $this->article2));

        $this->assertTrue($this->model->can('view.title', $this->article));
        $this->assertTrue($this->model->can('create.title', $this->article));
        $this->assertFalse($this->model->can('update.title', $this->article));
        $this->assertFalse($this->model->can('delete', $this->article));
    }

    public function testCanView()
    {
        $this->assertTrue($this->model->canView('title', $this->article));
        $this->assertFalse($this->model->canView('title', $this->article2));
        $this->assertFalse($this->model->canView('created_at', $this->article));

        $this->assertTrue($this->model->canView('birth_on', $this->model));
        $this->assertFalse($this->model->canView('birth_on', $this->user));
    }

    public function testCanCreate()
    {
        $this->assertTrue($this->model->canCreate('title', $this->article));
        $this->assertFalse($this->model->canCreate('content', $this->article));
    }

    public function testCanUpdate()
    {
        $this->assertFalse($this->model->canUpdate('title', $this->article));
    }

    public function testCanDelete()
    {
        $this->assertTrue($this->model->canDelete($this->user));
        $this->assertFalse($this->model->canDelete($this->article));
    }
}
