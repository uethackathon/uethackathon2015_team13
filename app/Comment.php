<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["feedback_id", "user_id", "content", "visibility_id"];

    public function feedback()
    {
    	return $this->belongsTo(Feedback::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function visibility()
    {
    	return $this->belongsTo(Visibility::class);
    }
}
