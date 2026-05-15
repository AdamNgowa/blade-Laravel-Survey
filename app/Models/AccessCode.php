<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    protected $fillable = [
        'access_code_order_id',
        'code',
        'is_used',
        'used_at',
        'used_by',
    ];

    protected $casts = [
        'is_used'=>'boolean',
        'used_at'=>'datetime'
    ];

    public function order(){
        return $this->belongsTo(AccessCodeOrder::class,'access_code_order_id');
    }
}
