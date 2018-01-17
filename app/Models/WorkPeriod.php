<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Carbon\Carbon;
use App\Events\WorkPeriodWasUpdated;

class WorkPeriod extends Model
{
    use UuidModelTrait;

    protected $dates = ['work_date'];
    protected $fillable = ['start','end'];

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

    public function getHoursWorkedAttribute()
    {
        //can't calculate without start or end being set
        if(!$this->start){
            return 0;
        }
        if(!$this->end){
            return 0;
        }

        $start = $this->work_date->addHours(substr($this->start, 0, 2));

        $start->addMinutes(substr($this->start, 3,2));
        
        $end = $this->work_date->addHours(substr($this->end, 0, 2));
        $end->addMinutes(substr($this->end, 3,2));
        
        return round(($start->diffInMinutes($end) / 60), 2);//to get it into a decimal
    }
}