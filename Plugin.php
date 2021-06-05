<?php namespace SunLab\GamificationPermissions;

use Backend;
use System\Classes\PluginBase;

/**
 * GamificationPermissions Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'GamificationPermissions',
            'description' => 'No description provided yet...',
            'author'      => 'SunLab',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'SunLab\GamificationPermissions\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'sunlab.gamificationpermissions.some_permission' => [
                'tab' => 'GamificationPermissions',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'gamificationpermissions' => [
                'label'       => 'GamificationPermissions',
                'url'         => Backend::url('sunlab/gamificationpermissions/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['sunlab.gamificationpermissions.*'],
                'order'       => 500,
            ],
        ];
    }
}
