<?php namespace SunLab\GamificationPermissions\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateBcpPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_gamificationpermissions_bcp_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('badge_conditioned_permission_id');
            $table->unsignedBigInteger('permission_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_gamificationpermissions_bcp_permissions');
    }
}
