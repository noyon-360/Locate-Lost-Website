<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    use HasFactory;

    protected $fillable = [
        'found_date',
        'missing_person_id',
        'found_location',
        'recovery_details',
        'documents'
    ];

    protected $casts = [
        'documents' => 'array', // Convert JSON to array
    ];

    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class, 'missing_person_id');
    }
}
