<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['option'];

    public function questions() {
        return $this->belongsTo(Question::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
      public function answers() {
        return $this->hasMany(Answer::class);
      }
}
