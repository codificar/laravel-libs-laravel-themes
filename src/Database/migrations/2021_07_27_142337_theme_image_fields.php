<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThemeImageFields extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasColumn('theme', 'background_image_provider_signup'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_provider_signup');
            });
        }

		if (!Schema::hasColumn('theme', 'background_image_admin_signup'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_admin_signup')->nullable();
            });
        }

		if (!Schema::hasColumn('theme', 'background_image_corp_signup'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_corp_signup')->nullable();
            });
        }

		if (!Schema::hasColumn('theme', 'background_image_user_signup'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_user_signup')->nullable();
            });
        }

		if (!Schema::hasColumn('theme', 'background_image_home_signup'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_home_signup')->nullable();
            });
        }

		if (!Schema::hasColumn('theme', 'background_image_icon_app'))
        {
            Schema::table('theme', function (Blueprint $table)
            {
                $table->string('background_image_icon_app')->nullable();
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
		//
	}
}
