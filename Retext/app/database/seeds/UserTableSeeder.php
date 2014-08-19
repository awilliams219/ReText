<?php

/**
 * Reset user table with default admin credentials
 */
class UserTableSeeder extends Seeder {
    
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'administrator' => true,
            'can_delete' => true,
            'can_add' => true,
        ));
    }
}
