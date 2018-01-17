<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class PayPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user){

        	//create a bunch of historical PayPeriods
            for ($i=0; $i < 30; $i++) { 
                

                //create historical pay periods for user
        		factory(App\Models\PayPeriod::class)->create([

        			'user_id' => $user->id,
        			'start'	=> Carbon::now()->subWeeks($i)->startOfWeek(),
        			'end'	=> Carbon::now()->subWeeks($i)->endOfWeek(),
                    'normal_rate' => $user->normal_rate,
                    'overtime_rate' => $user->overtime_rate,

        		]);
            }
        });
            
    }
}
