<?php namespace SunLab\GamificationPermissions;

use Backend\Facades\Backend;
use SunLab\GamificationPermissions\Models\BadgeConditionedPermission;
use SunLab\Permissions\Models\Permission;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
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
            'description' => 'sunlab.gamificationpermissions::lang.plugin.description',
            'author'      => 'SunLab',
            'icon'        => 'icon-hand-paper-o'
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
                BadgeConditionedPermission::class,
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
        return [
            'sunlab.gamificationpermissions.access_settings' => [
                'tab' => 'GamificationPermissions',
                'label' => 'sunlab.gamificationpermissions::lang.permission.label'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'bcp' => [
                'label'       => 'sunlab.gamificationpermissions::lang.settings.bcp.name',
                'description' => 'sunlab.gamificationpermissions::lang.settings.bcp.description',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-hand-paper-o',
                'url'         => Backend::url('sunlab/gamificationpermissions/badgeconditionedpermissions'),
                'order'       => 500,
                'permissions' => ['sunlab.gamificationpermissions.access_settings']
            ]
        ];
    }
}
