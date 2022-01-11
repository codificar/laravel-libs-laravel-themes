<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameInThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('theme', 'theme_name')) {
            Schema::table('theme', function (Blueprint $table) {
                $table->string('theme_name')->nullable()->default('Tema');
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
        if (Schema::hasColumn('theme', 'theme_name')) {
            Schema::table('theme', function (Blueprint $table) {
                $table->dropColumn('theme_name');
            });
        }
    }
}
