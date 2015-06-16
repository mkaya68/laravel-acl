<?php namespace Slynova\Acl;

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

use Illuminate\Support\ServiceProvider;
use Slynova\Acl\Commands\MakeConditionCommand;
use Slynova\Acl\Commands\PermissionCacheCommand;
use Slynova\Acl\Commands\PermissionClearCommand;

/**
 * @codeCoverageIgnore
 */
class AclServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPermissionCacheCommand();
        $this->registerPermissionClearCommand();
        $this->registerMakeConditionCommand();
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'command.acl.permission.cache',
            'command.acl.permission.clear',
            'command.acl.make.condition',
        ];
    }

    /**
     * Register the permission:cache command class.
     *
     * @return void
     */
    protected function registerPermissionCacheCommand()
    {
        $this->app->singleton('command.acl.permission.cache', function ($app) {
            return $app[PermissionCacheCommand::class];
        });

        $this->commands('command.acl.permission.cache');
    }

    /**
     * Register the permission:clear command class.
     *
     * @return void
     */
    protected function registerPermissionClearCommand()
    {
        $this->app->singleton('command.acl.permission.clear', function ($app) {
            return $app[PermissionClearCommand::class];
        });

        $this->commands('command.acl.permission.clear');
    }

    /**
     * Register the make:condition command class.
     *
     * @return void
     */

    protected function registerMakeConditionCommand()
    {
        $this->app->singleton('command.acl.make.condition', function ($app) {
            return $app[MakeConditionCommand::class];
        });

        $this->commands('command.acl.make.condition');
    }

    /**
     * Publish the configuration of this package.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/acl.php' => config_path('acl.php'),
        ], 'config');
    }

    /**
     * Publish migrations of this package.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
