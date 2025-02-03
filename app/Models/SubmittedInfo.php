<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedInfo extends Model
{
    protected $fillable = [
        'missing_person_id',
        'description',
        'latitude',
        'longitude',
        'user_id',
        'station_id',
        'submitted_by',
        'station_name',
        'role',
    ];

    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function station()
    {
        return $this->belongsTo(Stations::class);
    }
}
