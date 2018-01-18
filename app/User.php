<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Alsofronie\Uuid\UuidModelTrait;

class User extends Authenticatable
{
    use Notifiable;
    use UuidModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'tax_code',
        'normal_rate',
        'overtime_rate',
        'contracted_hours'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isAdmin()
    {
        return $this->admin;
    }

    public function payPeriods()
    {
        return $this->hasMany(\App\Models\PayPeriod::class)->orderBy('start','desc');
    }

    public function getNormalRateAttribute($value)
    {
        return round($value, 2);
    }

    public function getOvertimeRateAttribute($value)
    {
        return round($value, 2);
    }

    public function getContractedHoursAttribute($value)
    {
        return round($value, 2);
    }

    public function getTotalHoursAttribute($value)
    {
        return round($value, 2);
    }

    public function getTotalPayAttribute($value)
    {
        return round($value, 2);
    }
}
