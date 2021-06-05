<?php namespace SunLab\GamificationPermissions\Updates;

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

class CreateBadgeConditionnedPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_gamificationpermissions_bcp', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('badge_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_gamificationpermissions_bcp');
    }
}
