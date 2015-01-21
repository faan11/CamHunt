<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClueDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('clues_data', function($t) {
                $t->integer('id')->references('id')->on('clues');
                $t->binary("qrcode");
                $t->binary("svgqrcode");
                $t->primary('id');
           });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop("clues_data");
	}

}
