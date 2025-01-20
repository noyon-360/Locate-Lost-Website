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

    

    public function missingReports()
    {
        return $this->hasMany(MissingPerson::class, 'user_email', 'email');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->missingReports()->delete();
        });
    }
}
