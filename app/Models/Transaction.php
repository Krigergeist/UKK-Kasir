<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'tsn_id';

    protected $fillable = [
        'tsn_usr_id',
        'tsn_csm_name',
        'tsn_date',
        'tsn_metode',
        'tsn_total',
        'tsn_created_by',
        'tsn_updated_by',
        'tsn_deleted_by',
        'tsn_sys_note',
    ];

    protected $casts = [
        'tsn_date' => 'date',
        'tsn_total' => 'integer',
    ];

    protected $dates = [
        'tsn_created_at',
        'tsn_updated_at',
        'tsn_deleted_at',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'tsn_usr_id', 'usr_id');
    }

    public function details()
    {
        return $this->hasMany(Transaction_Detail::class, 'tsnd_tsn_id', 'tsn_id');
    }
}
