<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class MissingPerson extends EloquentModel
{
    protected $connection = 'mysql';
    protected $collection = 'missing_persons';

    protected $fillable = [
        'user_id',
        'user_email',
        'fullname',
        'date_of_birth',
        'gender',
        'permanent_address',
        'last_seen_location_description',
        'father_name',
        'mother_name',
        'contact_number',
        'email',
        'front_image',
        'additional_pictures',
        'missing_date',
        'status'
    ];

    // Add the relationship method
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function submittedInfos()
    {
        // return the total number of submitted information for a missing person
        return $this->hasMany(SubmittedInfo::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($missingPerson) {
            $missingPerson->user->increment('missing_reports_count');
        });

        static::deleted(function ($missingPerson) {
            $missingPerson->user->decrement('missing_reports_count');
        });
    }
}
