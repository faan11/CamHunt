<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('config', function($t) {
                $t->increments("id");
                $t->boolean("registration_active")->default(false);
                $t->boolean("match_active")->default(false);
                $t->timestamps();
            });
            
            
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop("config");
//            Schema::drop("config_data");
	}

}
