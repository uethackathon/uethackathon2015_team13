<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["title", "name", "email", "content", "probability_positive", "probability_negative", "probability_neutral", "status_id", "visibility_id"];

    public function sentences()
    {
    	return $this->hasMany(Sentence::class);
    }
}
