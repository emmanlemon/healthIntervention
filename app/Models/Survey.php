<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'description', 'user_id'];
    protected $dates = ['deleted_at'];
  
    public function questions() {
      return $this->hasMany(Question::class);
    }
  
    public function user() {
      return $this->belongsTo(User::class);
    }
    
    public function answers() {
      return $this->hasMany(Answer::class);
    }
}
