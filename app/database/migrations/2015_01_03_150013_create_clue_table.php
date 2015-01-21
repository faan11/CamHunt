<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('clues', function($t) {
                $t->increments('id');
                $t->string('title', 30);
                $t->longText('description');
                $t->float("gpsx");
                $t->float("gpsy");
                $t->string('hash', 64)->unique();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop("clues");
	}

}
