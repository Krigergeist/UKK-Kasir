<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction_Detail extends Model
{
    use SoftDeletes;

    protected $table = 'transaction_details';
    protected $primaryKey = 'tsnd_id';

    protected $fillable = [
        'tsn_usr_id',
        'tsnd_tsn_id',
        'tsnd_prod_id',
        'tsnd_quantity',
        'tsnd_created_by',
        'tsnd_updated_by',
        'tsnd_deleted_by',
        'tsnd_sys_note',
    ];

    protected $casts = [
        'tsnd_quantity' => 'integer',
    ];

    protected $dates = [
        'tsnd_created_at',
        'tsnd_updated_at',
        'tsnd_deleted_at',
    ];

    // Relations
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'tsnd_tsn_id', 'tsn_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'tsnd_prod_id', 'prd_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'tsn_usr_id');
    }
}
