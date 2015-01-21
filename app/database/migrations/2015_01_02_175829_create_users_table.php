<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function($t) {
            $t->increments('id');
            $t->string('username', 40)->unique();
            $t->string('password', 64);
            $t->string('name', 100);
            $t->string('surname', 104);
            $t->boolean('ban')->default(false);
            $t->timestamps();
            $t->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
