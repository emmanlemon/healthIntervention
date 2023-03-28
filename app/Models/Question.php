<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

      // protected $casts = [
      //     'question' => 'array',
      // ];
    // protected $fillable = ['title', 'question_type', 'option_name', 'user_id'];
    protected $fillable = ['question'];

    public function survey() {
      return $this->belongsTo(Survey::class);
    }
  
    public function user() {
      return $this->belongsTo(User::class);
    }
    
    public function answers() {
      return $this->hasMany(Answer::class);
    }
}
