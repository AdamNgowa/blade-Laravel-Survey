<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCodeOrder extends Model
{
    protected $fillable = [
        'user_id',
        'quantity',
        'total_amount',
        'payment_status',
        'paypal_transaction_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function accessCodes(){
        return $this->hasMany(AccessCode::class);
    }
}
