<?php namespace SunLab\GamificationPermissions\Tests;

use System\Tests\Bootstrap\PluginTestCase;
use SunLab\Gamification\Models\Badge;
use SunLab\Measures\Models\ListenedEvent;
use SunLab\Permissions\Models\Permission;
use Winter\User\Facades\Auth;

abstract class GamificationPermissionsPluginTestCase extends PluginTestCase
{
    protected $user;
    protected $badge;
    /**
     * @var Permission
     */
    protected $permission;

    public function setUp(): void
    {
        parent::setUp();

        // Create a base listened event, badge and permissions for the tests
        $this->listenedEvent = new ListenedEvent;
        $this->listenedEvent->event_name = 'model.afterUpdate';
        $this->listenedEvent->measure_name = 'user_updated';
        $this->listenedEvent->model_to_watch = \Winter\User\Models\User::class;
        $this->listenedEvent->save();

        $this->getPluginObject('SunLab.Measures')->boot();
        $this->getPluginObject('SunLab.Gamification')->boot();
        $this->getPluginObject('SunLab.Permissions')->boot();

        $this->badge = new Badge;
        $this->badge->name = 'Undecided';
        $this->badge->measure_name = $this->listenedEvent->measure_name;
        $this->badge->amount_needed = 5;
        $this->badge->save();

        // Create base permission models for the tests
        $this->permission = new Permission;
        $this->permission->label = 'Base permission';
        $this->permission->code = 'base-permission';
        $this->permission->tab = 'tab';
        $this->permission->save();

        $this->getPluginObject()->boot();

        // Create a base use model for the tests
        $this->user = Auth::register([
            'username' => 'username',
            'email' => 'user@user.com',
            'password' => 'abcd1234',
            'password_confirmation' => 'abcd1234'
        ], true);

        // Reset measure: the register methods already updated the model twice
        $this->user->resetMeasure('user_updated');
    }
}
