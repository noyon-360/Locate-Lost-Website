<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
        'phone_number',
        'station_name',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function station()
    {
        return $this->belongsTo(Stations::class, 'station_name', 'station_name');
    }

    public function missingPersons()
    {
        return $this->hasMany(MissingPerson::class);
    }

    // public function submittedInfos()
    // {
    //     return $this->hasMany(SubmittedInfo::class);
    // }

    public function reports()
    {
        return $this->hasMany(MissingReports::class, 'user_id');
    }



    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->missingPersons()->each(function ($missingPerson) {
                $missingPerson->delete();
            });

            $user->submittedInfos()->each(function ($submittedInfo) {
                $submittedInfo->delete();
            });
        });
    }
}
