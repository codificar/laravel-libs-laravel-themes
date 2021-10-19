<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppImageInThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('theme', ['app_image_icon', 'is_visible_in_app'])) {
            Schema::table('theme', function (Blueprint $table) {
                $table->string('app_image_icon')->nullable();
                $table->boolean('is_visible_in_app')->default(0)->nullable();
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
        if (Schema::hasColumns('theme', ['app_image_icon', 'is_visible_in_app'])) {
            Schema::table('theme', function (Blueprint $table) {
                $table->dropColumn('app_image_icon');
                $table->dropColumn('is_visible_in_app');
            });
        }
    }
}
