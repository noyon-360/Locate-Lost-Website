<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class MissingPerson extends EloquentModel
{
    protected $connection = 'mysql';
    protected $collection = 'missing_persons';

    protected $fillable = [
        'user_id',
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
        'status',
        'submitted_by'
    ];

    // Add the relationship method
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function station()
    {
        return $this->belongsTo(Stations::class, 'submitted_by', 'email');
    }

    public function submitter()
    {
        return $this->belongsTo(Stations::class);
    }

    public function submittedInfos()
    {
        return $this->hasMany(MissingReports::class);
    }

    public function reports()
    {
        return $this->hasMany(MissingReports::class, 'missing_person_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'missing_report_id');
    }

    public function completions()
    {
        return $this->hasMany(Completion::class, 'missing_person_id');
    }

    public function lastLocation()
    {
        return $this->hasOne(MissingReports::class, 'missing_person_id')
            ->latest() // Gets the most recent report
            ->withDefault(); // Returns empty model if no relationship exists
    }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($missingPerson) {
    //         $missingPerson->user->increment('missing_reports_count');
    //     });

    //     static::deleted(function ($missingPerson) {
    //         $missingPerson->user->decrement('missing_reports_count');
    //     });
    // }
}
