<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ["content", "classification_id", "feedback_id"];

    public function feedback()
    {
    	return $this->belongsTo(Feedback::class);
    }
}
