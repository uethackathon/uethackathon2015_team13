<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public static $visibilityName = "Visibility";
    public static $classificationName = "Classification";
    public static $statusName = "Status";

    protected $fillable = ["name"];

    public function categories()
    {
    	return $this->hasMany(Category::class);
    }
}
