<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClueProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
             Schema::create('clues_progress', function($t) {
                $t->increments("id");
                $t->integer('uid')->references('id')->on('users');
                $t->integer('cid')->references('id')->on('clues');
                $t->integer('end')->default(0);
                $t->boolean('resetted')->default(false);
                $t->integer('count')->default(0);        
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
            Schema::drop('clues_progress');
	}

}
