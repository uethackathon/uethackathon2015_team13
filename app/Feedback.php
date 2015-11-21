<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["title", "name", "email", "content", "probability", "status_id", "visibility_id"];

    public function sentences()
    {
    	return $this->hasMany(Sentence::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function visibility()
    {
    	return $this->belongsTo(Visibility::class);
    }


}
