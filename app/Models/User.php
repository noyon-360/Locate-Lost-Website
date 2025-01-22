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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function missingPersons()
    {
        return $this->hasMany(MissingPerson::class);
    }

    public function submittedInfos()
    {
        return $this->hasMany(SubmittedInfo::class);
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
