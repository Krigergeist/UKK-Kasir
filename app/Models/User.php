<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nama tabel
    protected $table = 'users';

    // Primary key
    protected $primaryKey = 'usr_id';

    // Jika primary key auto increment dan tipe bigInteger
    protected $keyType = 'integer';
    public $incrementing = true;

    // Timestamp custom
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Kolom yang bisa diisi
    protected $fillable = [
        'usr_email',
        'usr_password',
        'usr_name',
        'usr_shp_name',
        'usr_phone',
        'usr_img',
    ];

    // Hidden (misal password)
    protected $hidden = [
        'usr_password',
    ];

    // Override password untuk hash otomatis
    public function setUsrPasswordAttribute($value)
    {
        $this->attributes['usr_password'] = bcrypt($value);
    }
}
