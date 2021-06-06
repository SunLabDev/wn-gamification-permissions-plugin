<?php namespace SunLab\GamificationPermissions\Tests\Unit\Facades;

use Illuminate\Support\Facades\DB;
use SunLab\GamificationPermissions\Models\BadgeConditionnedPermission;
use SunLab\GamificationPermissions\Tests\GamificationPermissionsPluginTestCase;

class GamificationPermissionsTest extends GamificationPermissionsPluginTestCase
{
    public function testPermissionsIsGrantedWhenBadgeIsAssigned()
    {
        $bcp = new BadgeConditionnedPermission;
        $bcp->badge_id = $this->badge->id;
        $bcp->save();

        $bcp->permissions()->attach([$this->permission->id]);

        $permissionsNeeded = $this->permission->code;

        // Update the model 5 times
        for ($i = 1; $i <= 5; $i++) {
            $this->user->email = "other-email${i}@test.com";
            $this->user->save();

            // On the 4th updates, asserts it doesn't have the badge and permission yet
            if ($i === 4) {
                $this->assertEmpty($this->user->badges->toArray());
                $this->assertFalse($this->user->hasUserPermission($permissionsNeeded));
            }
        }

        Db::flushDuplicateCache();

        $this->assertTrue($this->user->hasUserPermission($permissionsNeeded));
    }
}
