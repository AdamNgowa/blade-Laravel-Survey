<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    protected $fillable = [
        'purchase_id',
        'code',
        'is_used',
        'used_at',
        'used_by',
    ];

    protected $casts = [
        'is_used'=>'boolean',
        'used_at' => 'datetime'      
        ];


        // Relationships

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'used_by');
    }

    public function surveyAttempt(){
        return $this->hasOne(SurveyAttempt::class);
    }
    
}
