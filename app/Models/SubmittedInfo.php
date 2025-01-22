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
        'user_id'
    ];

    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}