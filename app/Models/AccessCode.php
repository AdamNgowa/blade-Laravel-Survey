<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    protected $fillable = [
        'purchase_id',
        'code',
        'is_used',
        
    ];

    protected $casts = [
        'is_used'=>'boolean',        
        ];

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
