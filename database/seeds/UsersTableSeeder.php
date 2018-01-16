<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create an admin user

        factory(App\User::class)->create([
            'email'     => 'prbowen@gmail.com',
            'name'      => 'Peter Bowen',
            'password'  => Hash::make('password'),
            'admin'     => 1
            ]);

        //create a bunch of employee users
        factory(App\User::class, 50)->create();
    }
}
