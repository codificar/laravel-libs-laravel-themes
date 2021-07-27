<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CheckCreateTheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('theme'))
        {
            Schema::create('theme', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('theme_color');
                $table->string('primary_color');
                $table->string('secondary_color');
                $table->string('hover_color');
                $table->string('logo');
                $table->string('favicon');
                $table->timestamps();
                $table->string('active_color');
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
