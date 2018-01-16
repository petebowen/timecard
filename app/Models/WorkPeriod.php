<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Carbon\Carbon;
use App\Events\WorkPeriodWasUpdated;

class WorkPeriod extends BaseModel
{
    use UuidModelTrait;

    protected $dates = ['work_date'];
    protected $defaults = [   
            'start' => '00:00',
            'end'   => '00:00',
    ];

    public static function boot()
    {
        parent::boot();

        static::updated(function ($workPeriod) {
            event(new WorkPeriodWasUpdated($workPeriod));
        });
    }
    
    public function payPeriod()
    {
        return $this->belongsTo(\App\Models\PayPeriod::class);
    }
}