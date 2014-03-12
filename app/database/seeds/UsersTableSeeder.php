<?php 

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create( array(
            'email' => 'admin@admin.com',
            'password' => \Hash::make('testtest'),
        ));
    }

}