<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['answer' , 'user_id' , 'survey_id'];

    public function question() {
      return $this->belongsTo(Question::class);
    }

    public function responses() {
      return $this->hasMany(SurveyResponse::class);
    }

    public function users() {
      return $this->belongsTo(User::class);
    }
}
