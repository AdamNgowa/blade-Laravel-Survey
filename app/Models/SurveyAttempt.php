<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyAttempt extends Model
{
    protected $fillable = [
        'access_code_id',
        'percentage',
        'recommendation',
        'completed_at',
    ];

    protected $casts = [
    'completed_at' => 'datetime'
    ];

    public function accessCode()
    {
        return $this->belongsTo(AccessCode::class);
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}