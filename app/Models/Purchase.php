<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'quantity',
        'amount',
        'paypal_order_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function accessCodes(){
        return $this->hasMany(AccessCode::class);
    }
    
}
