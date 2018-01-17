<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Carbon\Carbon;
use App\Events\PayPeriodWasCreated;
use App\Events\PayPeriodWasUpdated;

class PayPeriod extends BaseModel
{
    use UuidModelTrait;

    protected $dates = ['start','end'];
    
    protected $defaults = [
        'normal_hours' => 0,
        'overtime_hours' => 0,
        'normal_rate'   => 0,
        'overtime_rate' => 0,
        'gross' => 0,
        'tax'   => 0,
        'national_insurance' => 0,
        'net'   => 0,
    ];
    
    protected $fillable = ['user_id'];
    protected $guarded = [];
    
    public static function boot()
    {

        parent::boot();

        static::created(function ($payPeriod) {
            event(new PayPeriodWasCreated($payPeriod));
        });

        static::updated(function ($payPeriod) {
            event(new PayPeriodWasUpdated($payPeriod));
        });
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function workPeriods()
    {
        return $this->hasMany(\App\Models\WorkPeriod::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('start', Carbon::now()->startOfWeek())
            ->where('end', Carbon::now()->endOfWeek());
    }

        public function getNormalHoursAttribute($value)
    {
        return round($value, 2);
    }

    public function getOvertimeHoursAttribute($value)
    {
        return round($value, 2);
    }

    public function getNormalRateAttribute($value)
    {
        return round($value, 2);
    }

    public function getOvertimeRateAttribute($value)
    {
        return round($value, 2);
    }

    public function getGrossAttribute($value)
    {
        return round($value, 2);
    }
    
    public function getTaxAttribute($value)
    {
        return round($value, 2);
    }
    
    public function getNationalInsuranceAttribute($value)
    {
        return round($value, 2);
    }
    
    public function getNetAttribute($value)
    {
        return round($value, 2);
    }
}