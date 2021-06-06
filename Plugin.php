<?php namespace SunLab\GamificationPermissions;

use Backend;
use SunLab\GamificationPermissions\Models\BadgeConditionnedPermission;
use SunLab\Permissions\Models\Permission;
use System\Classes\PluginBase;
use Winter\Storm\Database\Builder;
use Winter\User\Models\User;

/**
 * GamificationPermissions Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['SunLab.Permissions', 'SunLab.Gamification'];
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
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Permission::extend(static function ($permission) {
            $permission->belongsToMany['badges'] = [
                BadgeConditionnedPermission::class,
                'table' => 'sunlab_gamificationpermissions_bcp_permissions'
            ];
        });

        User::extend(static function (User $user) {
            $user->bindEvent('model.relation.afterAttach', function (string $relationName, $ids) use ($user) {
                if ($relationName === 'badges') {
                    $correspondingPermissions =
                        Permission::query()
                                  ->whereHas('badges', static function (Builder $query) use ($ids) {
                                      return $query->whereIn('badge_id', $ids);
                                  })
                                  ->get();

                    if (!blank($correspondingPermissions)) {
                        $user->permissions()->syncWithoutDetaching($correspondingPermissions);
                    }
                }
            });
        });
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
