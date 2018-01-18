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
            'email'         => 'boss@timecard.com',
            'first_name'    => 'Peter',
            'last_name'     => 'Boss',
            'password'      => Hash::make('password'),
            'admin'         => 1
            ]);

        //create an employee user
        factory(App\User::class)->create([
            'email'         => 'employee@timecard.com',
            'first_name'    => 'Peter',
            'last_name'     => 'Employee',
            'password'      => Hash::make('password'),
            'admin'         => 0
            ]);

        //create a bunch of employee users
        factory(App\User::class, 10)->create();
    }
}
