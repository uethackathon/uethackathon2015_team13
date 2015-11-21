<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["feedback_id", "user_id", "content", "visibility_id"];
}
