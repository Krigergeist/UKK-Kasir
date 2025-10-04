<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{


    protected $table = 'products';
    protected $primaryKey = 'prd_id';

    protected $fillable = [
        'prd_usr_id',
        'prd_code',
        'prd_name',
        'prd_price',
        'prd_stock',
        'prd_description',
        'prd_img',
        'prd_created_by',
        'prd_updated_by',
        'prd_sys_note',
    ];

    protected $casts = [
        'prd_price' => 'integer',
        'prd_stock' => 'integer',
    ];

    protected $dates = [
        'prd_created_at',
        'prd_updated_at',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'prd_usr_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_Detail::class, 'tsnd_prod_id', 'prd_id');
    }
}
