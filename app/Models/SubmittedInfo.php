<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedInfo extends Model
{
    protected $fillable = [
        'missing_person_id',
        'location',
        'description'
    ];

    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class);
    }
}