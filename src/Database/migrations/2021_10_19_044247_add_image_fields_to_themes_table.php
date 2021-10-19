<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFieldsToThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('theme', ['background_image_admin_signup', 'background_image_corp_signup', 'background_image_user_signup', 'background_image_home_signup'])) {
            Schema::table('theme', function (Blueprint $table) {
                $table->string('background_image_admin_signup')->nullable();
                $table->string('background_image_corp_signup')->nullable();
                $table->string('background_image_user_signup')->nullable();
                $table->string('background_image_home_signup')->nullable();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('theme', ['background_image_admin_signup', 'background_image_corp_signup', 'background_image_user_signup', 'background_image_home_signup'])) {
            Schema::table('theme', function (Blueprint $table) {
                $table->dropColumn('background_image_admin_signup');
                $table->dropColumn('background_image_corp_signup');
                $table->dropColumn('background_image_user_signup');
                $table->dropColumn('background_image_home_signup');
            });
        }
    }
}
