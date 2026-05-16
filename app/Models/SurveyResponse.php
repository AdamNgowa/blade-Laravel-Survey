<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'survey_attempt_id',
        'question_id',
        'answer_id',
    ];

    public function attempt()
    {
        return $this->belongsTo(SurveyAttempt::class, 'survey_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}