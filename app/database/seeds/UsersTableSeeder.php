<?php 

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create( array(
            'email' => 'admin@admin.com',
            'password' => \Hash::make('testtest'),
            'role' => User::ROLE_ADMIN
        ));

        User::create( array(
            'email' => 'user@user.com',
            'password' => \Hash::make('useruser'),
            'role' => User::ROLE_USER
        ));
    }

}