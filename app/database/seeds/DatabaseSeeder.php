<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
                \Admin::truncate();
                \Configz::truncate();
		// $this->call('UserTableSeeder');
                $admin = new Admin;
                $admin->username = 'root@root.it';
                $admin->password = Hash::make('root');
                $admin->save();
                \Configz::truncate();
                $c = new Configz;
                $c->save();
                
                
	}

}
