<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ["content", "classification", "feedback_id"];
}
