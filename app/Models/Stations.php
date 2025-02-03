<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Stations extends Authenticatable
{

    use Notifiable;

    protected $guard = 'stations';

    protected $fillable = [
        'station_name',
        'email',
        'password',
        'station_picture',
        'last_login_at',
        'status',
        'role',
    ];

    protected $hidden = [
        'remember_token',
    ];


    // app/Models/Station.php
    public function users()
    {
        return $this->hasMany(User::class, 'station_name', 'station_name');
    }

    public function missingPersons()
    {
        return $this->hasMany(MissingPerson::class, 'submitted_by', 'email');
    }

    public function submittedInfos()
    {
        return $this->hasMany(SubmittedInfo::class);
    }

    public function reports()
    {
        return $this->hasMany(MissingReports::class, 'station_id');
    }
}
