<?php namespace Slynova\Acl\Commands;

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

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore
 */
class PermissionCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:permission:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache user\'s permissions';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
