<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'usr_id';
    public $incrementing = true;

    protected $fillable = [
        'usr_email',
        'usr_password',
        'usr_name',
        'usr_shp_name',
        'usr_phone',
        'usr_img',
    ];

    protected $hidden = ['usr_password'];

    public function getAuthPassword()
    {
        return $this->usr_password;
    }

    public function setUsrPasswordAttribute($value)
    {
        if (is_string($value) && Str::startsWith($value, ['$2y$', '$2a$', '$argon2i$', '$argon2id$'])) {
            $this->attributes['usr_password'] = $value; // diasumsikan sudah hash valid
        } else {
            $this->attributes['usr_password'] = Hash::make($value);
        }
    }
}
