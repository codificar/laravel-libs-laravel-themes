<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemeIdInProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('provider', 'theme_id')) {
            Schema::table('provider', function (Blueprint $table) {
                $table->integer('theme_id')->unsigned()->nullable()->index();
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
        if (Schema::hasColumn('provider', 'theme_id')) {
            Schema::table('provider', function (Blueprint $table) {
                $table->dropColumn('theme_id');
                $table->dropIndex('provider_theme_id_index');
            });
        }
    }
}
