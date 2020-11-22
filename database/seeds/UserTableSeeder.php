<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@g.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->attachRole('super_admin');

    }
}
