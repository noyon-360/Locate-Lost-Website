<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingReports extends Model
{
    use HasFactory;

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
        'seen_at',
    ];

    /**
     * Get the user who submitted the information.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the station that submitted the information.
     */
    public function station()
    {
        return $this->belongsTo(Stations::class, 'station_id');
    }

    /**
     * Get the missing person this submission refers to.
     */
    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class, 'missing_person_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'missing_report_id');
    }

    
}
