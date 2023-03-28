<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function survey(){
        return $this->belongsTo(Survey::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class, 'user_id', 'survey_id' , 'question_id' , 'id');
    }

}
